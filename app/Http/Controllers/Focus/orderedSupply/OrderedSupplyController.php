<?php
/*
 * Business Mind - Accounting, CRM and POS Software
 * Copyright (c) tarwiga.com. All Rights Reserved
 * ***********************************************************************
 *
 *  Email: support@tarwiga.com
 *  Website: https://www.tarwiga.com
 */

namespace App\Http\Controllers\Focus\orderedSupply;

use App\Http\Controllers\Focus\printer\PrinterController;
use App\Http\Controllers\Focus\printer\RegistersController;
use App\Http\Requests\Focus\orderedSupply\ManagePosRequest;
use App\Http\Responses\RedirectResponse;
use App\Models\account\Account;
use App\Models\Company\ConfigMeta;
use App\Models\customer\Customer;
use App\Models\hrm\Hrm;
use App\Models\orderedSupply\Draft;
use App\Models\product\Product;
use App\Models\product\ProductContains;
use App\Models\product\ProductVariation;
use App\Models\subtax\SubTax;
use App\Models\template\Template;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\ViewResponse;
use App\Http\Responses\Focus\orderedSupply\CreateResponse;
use App\Http\Responses\Focus\orderedSupply\EditResponse;
use App\Http\Requests\Focus\orderedSupply\CreateOrderedSupplyRequest;
use App\Http\Requests\Focus\orderedSupply\DeleteOrderedSupplyRequest;
use App\Http\Requests\Focus\orderedSupply\EditOrderedSupplyRequest;
use App\Http\Requests\Focus\orderedSupply\ManageOrderedSupplyRequest;
use App\Models\items\OrderedSupplyItem;
use App\Models\orderedSupply\OrderedSupply;
use App\Repositories\Focus\orderedSupply\OrderedSupplyRepository;
use Illuminate\Support\Facades\Response;
use mPDF;
use Bitly;

/**
 * InvoicesController
 */
class OrderedSupplyController extends Controller
{
    /**
     * variable to store the repository object
     * @var OrderedSupplyRepository
     */
    protected $repository;

    /**
     * contructor to initialize repository object
     * @param OrderedSupplyRepository $repository ;
     */
    public function __construct(OrderedSupplyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param App\Http\Requests\Focus\orderedSupply\ManageOrderedSupplyRequest $request
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageOrderedSupplyRequest $request)
    {
        $input = $request->only('rel_type', 'rel_id', 'md');
        $segment = false;
        $words = array();

        if (isset($input['rel_id']) and isset($input['rel_type'])) {
            switch ($input['rel_type']) {
                case 1 :
                    $segment = Customer::find($input['rel_id']);
                    $words['name'] = trans('customers.title');
                    $words['name_data'] = $segment->name;
                    break;
                case 2 :
                    $segment = Hrm::find($input['rel_id']);
                    $words['name'] = trans('hrms.employee');
                    $words['name_data'] = $segment->first_name . ' ' . $segment->last_name;
                    break;

            }
        }

        if (isset($input['md'])) {
            if ($input['md'] == 'sub') {
                $input['sub_json'] = "sub: 1";
                $input['sub_url'] = '?md=sub';
                $input['title'] = trans('orderSupply.subscriptions');
                $input['meta'] = 'sub';
                $input['pre'] = 6;
            } elseif ($input['md'] == 'pos') {
                $input['sub_json'] = "sub: 2";
                $input['sub_url'] = '?md=pos';
                $input['title'] = trans('orderSupply.pos');
                $input['meta'] = 'pos';
                $input['pre'] = 10;
            }
        } else {

            $input['sub_json'] = "sub: 0";
            $input['sub_url'] = '';
            $input['title'] = trans('labels.backend.orderedSupply.management');
            $input['meta'] = 'sub';
            $input['pre'] = 1;
        }

        return new ViewResponse('focus.orderedSupply.index', compact('input', 'segment', 'words'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateOrderedSupplyRequestNamespace $request
     * @return \App\Http\Responses\Focus\OrderedSupply\CreateResponse
     */
    public function create(CreateOrderedSupplyRequest $request)
    {
        return new CreateResponse('focus.orderedSupply.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderedSupplyRequestNamespace $request
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(CreateOrderedSupplyRequest $request)
    {
        //Input received from the request
        $orderedSupply = $request->only(['customer_id', 'tid', 'refer',
            'orderedSupplyduedate', 'recur_after', 'sub',
            'notes', 'subtotal', 'shipping',
            'discount_rate', 'after_disc', 'currency', 'total',
            'ship_rate', 'term_id', 'tax_id', 'p']);

        $orderedSupply_items = $request->only(['product_id', 'product_name',
            'code', 'product_qty', 'product_price', 'product_tax',
            'product_discount', 'product_subtotal',
            'product_subtotal', 'total_tax', 'total_discount',
            'product_description', 'unit', 'serial', 'unit_m']);
        $data2 = $request->only(['custom_field']);
        $data2['ins'] = auth()->user()->ins;
        //dd($orderedSupply_items);
        $orderedSupply['ins'] = auth()->user()->ins;
        if(feature(1)['value1']!='yes') $orderedSupply['user_id'] = auth()->user()->id;
        $orderedSupply_items['ins'] = auth()->user()->ins;
        //Create the model using repository create method
        $orderedSupply['i_class'] = 0;
        $result = $this->repository->create(compact('orderedSupply', 'orderedSupply_items', 'data2'));
        $feature = feature(9);

        if($feature['value2']=='yes') $this->repository->due_payment($result);

        //return with successfull message
        if ($result) {
            $valid_token = token_validator('', 'i' . $result['id'] . $result['tid'], true);
            $link = route('biller.print_bill', [$result['id'], 1, $valid_token, 1]);
            $kitchenLink = route('biller.print_bill_kitchen', [$result['id'], 1, $valid_token, 1]);
            $link_download = route('biller.print_bill', [$result['id'], 1, $valid_token, 2]);
            $link_preview = route('biller.view_bill', [$result['id'], 1, $valid_token, 0]);
            $lk = '';
            record_log(trans('orderedSupply.orderedSupply'),$result->id,trans('alerts.backend.orderedSupply.created') . ' #' . $result->tid);
            if (isset($result['p'])) $lk .= '<a href="' . route('biller.projects.show', [$result['p']]) . '" class="btn btn-info btn-md"><span class="fa fa-repeat" aria-hidden="true"></span> ' . trans('orderedSupply.return_project') . '  </a> ';
            echo json_encode(array('status' => 'Success', 'message' => trans('alerts.backend.orderedSupply.created') . ' <a href="' . route('biller.orderedSupply.show', [$result->id]) . '" class="btn btn-info btn-md"><span class="fa fa-eye" aria-hidden="true"></span> ' . trans('general.view') . '  </a> <a href="' . $link . '" target="_blank" class="btn btn-purple btn-md"><span class="fa fa-print" aria-hidden="true"></span> ' . trans('general.print') . '  </a><a href="' . $kitchenLink . '" style="margin-left:5px" target="_blank" class="btn btn-purple btn-md"><span class="fa fa-print" aria-hidden="true"></span> ' . trans('general.print_kitchen') . '  </a> <a href="' . $link_download . '" class="btn btn-warning btn-md"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> ' . trans('general.pdf') . '  </a> <a href="' . $link_preview . '" class="btn btn-purple btn-md"><span class="fa fa-globe" aria-hidden="true"></span> ' . trans('general.preview') . '  </a> <a href="' . route('biller.orderedSupply.create') . '" class="btn btn-blue-grey btn-md"><span class="fa fa-plus-circle" aria-hidden="true"></span> ' . trans('general.create') . '  </a> ' . $lk . ' &nbsp; &nbsp;'));
            $config = \App\Models\Company\ConfigMeta::where('feature_id', '=', 11)->first();


            $feature = feature(11);
            $alert = json_decode($feature->value2, true);
            if ($alert['new_orderedSupply'] or $alert['cust_new_orderedSupply']) {
                $template = Template::all()->where('category', '=', 1)->where('other', '=', 1)->first();
                $valid_token = token_validator('', 'i' . $result['id'] . $result['tid'], true);
                $link = route('biller.view_bill', [$result->id, 1, $valid_token, 0]);
                $data = array(
                    'Company' => config('core.cname'),
                    'BillNumber' => $result->tid,
                    'BillType' => trans('orderedSupply.orderedSupply'),
                    'URL' => "<a href='$link'>$link</a>",
                    'Name' => $result->customer->name,
                    'CompanyDetails' => '<h6><strong>' . config('core.cname') . ',</strong></h6>
                        <address>' . config('core.address') . '<br>' . config('core.city') . '</address>
                        ' . config('core.region') . ' : ' . config('core.country') . '<br>  ' . trans('general.email') . ' : ' . config('core.email'),
                    'DueDate' => dateFormat(date('Y-m-d')),
                    'Amount' => amountFormat($result->total)
                );
                $replaced_body = parse($template['body'], $data, true);
                $subject = parse($template['title'], $data, true);
                $mail = array();
                if ($alert['new_orderedSupply'] and !$alert['cust_new_orderedSupply']) {
                    $mail['mail_to'] = $feature->value1;
                } elseif ($alert['cust_new_orderedSupply'] and !$alert['new_orderedSupply']) {
                    $mail['mail_to'] = $result->customer->email;
                } else {
                    $mail['mail_to'][] = $result->customer->email;
                    $mail['mail_to'][] = $feature->value1;
                }
                $mail['customer_name'] = trans('transactions.transaction');
                $mail['subject'] = $subject;
                $mail['text'] = $replaced_body;
                business_alerts($mail);
            }
            if ($alert['sms_new_orderedSupply']) {
                $template = Template::all()->where('category', '=', 2)->where('other', '=', 11)->first();
                $valid_token = token_validator('', 'i' . $result['id'] . $result['tid'], true);
                $link = route('biller.view_bill', [$result->id, 1, $valid_token, 0]);
                $short_url = ConfigMeta::where('feature_id', '=', 7)->first(array('feature_value', 'value2'));
                $data['URL'] = $link;
                if ($short_url['feature_value']) {
                    config([
                        'bitly.accesstoken' => $short_url['value2']]);
                    $data['URL'] = Bitly::getUrl($link);
                }
                $replaced_body = parse($template['body'], $data, true);
                $mailer = new \App\Repositories\Focus\general\RosesmsRepository;
                return $mailer->send_bill_sms($result->customer->phone, $replaced_body, false);
            }
        } else {
            echo json_encode(array('status' => 'Error', 'message' => trans('exceptions.backend.orderedSupply.create_error')));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param App\Models\orderedSupply\OrderedSupply $orderedSupply
     * @param EditOrderedSupplyRequestNamespace $request
     * @return \App\Http\Responses\Focus\orderedSupply\EditResponse
     */
    public function edit(OrderedSupply $orderedSupply, EditOrderedSupplyRequest $request)
    {
        return new EditResponse($orderedSupply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderedSupplyRequestNamespace $request
     * @param App\Models\orderedSupply\OrderedSupply $orderedSupply
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(EditOrderedSupplyRequest $request, OrderedSupply $orderedSupply_r)
    {

        //Input received from the request
        $orderedSupply = $request->only(['customer_id', 'id', 'refer', 'orderedSupplydate', 'orderedSupplyduedate', 'notes', 'subtotal', 'shipping', 'tax', 'discount', 'discount_rate', 'after_disc', 'currency', 'total', 'tax_format', 'discount_format', 'ship_tax', 'ship_tax_type', 'ship_rate', 'ship_tax', 'term_id', 'tax_id', 'restock', 'recur_after']);
        $orderedSupply_items = $request->only(['product_id', 'product_name', 'code', 'product_qty', 'product_price', 'product_tax', 'product_discount', 'product_subtotal', 'product_subtotal', 'total_tax', 'total_discount', 'product_description', 'unit', 'old_product_qty', 'unit_m']);
        //dd($request->id);
        $orderedSupply['ins'] = auth()->user()->ins;
        //$orderedSupply['user_id']=auth()->user()->id;
        $orderedSupply_items['ins'] = auth()->user()->ins;
        //Create the model using repository create method
        $data2 = $request->only(['custom_field']);
        $data2['ins'] = auth()->user()->ins;
        $result = $this->repository->update($orderedSupply_r, compact('orderedSupply', 'orderedSupply_items', 'data2'));
        if($result)   record_log(trans('orderedSupply.orderedSupply'),$result->id,trans('alerts.backend.orderedSupply.updated') . ' #' . $result->tid);

        $valid_token = token_validator('', 'i' . $result['id'] . $result['tid'], true);
        $link = route('biller.print_bill', [$result['id'], 1, $valid_token, 1]);
        $link_download = route('biller.print_bill', [$result['id'], 1, $valid_token, 2]);
        $link_preview = route('biller.view_bill', [$result['id'], 1, $valid_token, 0]);
        echo json_encode(array('status' => 'Success', 'message' => trans('alerts.backend.orderedSupply.updated') . ' <a href="' . route('biller.orderedSupply.show', [$result->id]) . '" class="btn btn-info btn-md"><span class="fa fa-eye" aria-hidden="true"></span> ' . trans('general.view') . '  </a> <a href="' . $link . '" class="btn btn-purple btn-md"><span class="fa fa-print" aria-hidden="true"></span> ' . trans('general.print') . '  </a> <a href="' . $link_download . '" class="btn btn-warning btn-md"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> ' . trans('general.pdf') . '  </a> <a href="' . $link_preview . '" class="btn btn-purple btn-md"><span class="fa fa-globe" aria-hidden="true"></span> ' . trans('general.preview') . '  </a> <a href="' . route('biller.orderedSupply.create') . '" class="btn btn-blue-grey btn-md"><span class="fa fa-plus-circle" aria-hidden="true"></span> ' . trans('general.create') . '  </a> &nbsp; &nbsp;'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteOrderedSupplyRequestNamespace $request
     * @param App\Models\orderedSupply\OrderedSupply $orderedSupply
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(OrderedSupply $orderedSupply, DeleteOrderedSupplyRequest $request)
    {
        $feature = feature(11);
        $alert = json_decode($feature->value2, true);
        if ($alert['del_orderedSupply']) {

            $mail = array();
            $mail['mail_to'][] = $feature->value1;
            $mail['customer_name'] = $orderedSupply->customer->name;
            $mail['subject'] = trans('meta.delete_orderedSupply_alert') . ' #' . $orderedSupply->tid;
            $mail['text'] = trans('orderedSupply.orderedSupply') . ' #' . $orderedSupply->tid . '<br>' . trans('orderedSupply.orderedSupply_date') . ' : ' . dateFormat($orderedSupply->orderedSupplydate) . '<br>' . trans('general.amount') . ' : ' . amountFormat($orderedSupply->total) . '<br>' . trans('general.employee') . ' : ' . $orderedSupply->user->first_name . ' ' . $orderedSupply->user->last_name;
            business_alerts($mail);
        }
        //Calling the delete method on repository
        $this->repository->delete($orderedSupply);
        if($this->repository->delete($orderedSupply)){
            record_log(trans('orderedSupply.orderedSupply'),$orderedSupply->id,trans('meta.delete_orderedSupply_alert') . ' #' . $orderedSupply->tid);
        }

        //returning with successfull message
        return json_encode(array('status' => 'Success', 'message' => trans('alerts.backend.orderedSupply.deleted')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteOrderedSupplyRequestNamespace $request
     * @param App\Models\orderedSupply\OrderedSupply $orderedSupply
     * @return \App\Http\Responses\RedirectResponse
     */
    public function show(OrderedSupply $orderedSupply, ManageOrderedSupplyRequest $request)
    {
        $accounts = Account::all();
        $features = ConfigMeta::where('feature_id', 9)->first();
        if ($orderedSupply->i_class < 2) {
            $words['prefix'] = prefix(1);
        } else {
            $words['prefix'] = prefix(6);
        }
        //returning with successfull message
        $orderedSupply['bill_type'] = 1;
        $words['pay_note'] = trans('orderedSupply.payment_for_orderedSupply') . ' ' . $words['prefix'] . '#' . $orderedSupply->tid;

        return new ViewResponse('focus.orderedSupply.view', compact('orderedSupply', 'accounts', 'features', 'words'));
    }

    public function print_document(OrderedSupply $orderedSupply, ManageOrderedSupplyRequest $request)
    {
        $orderedSupply = $this->repository->find($request->id);
        switch ($request->type) {
            case 1:
                //delivery note
                $general = array('bill_type' => trans('orderedSupply.delivery_note'),
                    'lang_bill_number' => trans('orderedSupply.delivery_note'),
                    'lang_bill_date' => trans('orderedSupply.orderedSupply_date'),
                    'lang_bill_due_date' => trans('orderedSupply.orderedSupply_due_date'
                    ), 'direction' => 'rtl',
                    'person' => trans('customers.customer'),
                    'person_address' => trans('customers.address'),
                    'prefix' => 1);
                $html = view('focus.bill.delivery', compact('orderedSupply', 'general'))->render();
                $name = 'delivery_note_' . $orderedSupply->tid . '.pdf';
                break;
            case 2:
                //delivery note
                $general = array('bill_type' => trans('orderedSupply.delivery_note'),
                    'lang_bill_number' => trans('orderedSupply.delivery_note'),
                    'lang_bill_date' => trans('orderedSupply.orderedSupply_date'),
                    'lang_bill_due_date' => trans('orderedSupply.orderedSupply_due_date'
                    ), 'direction' => 'rtl',
                    'person' => trans('customers.customer'),
                    'person_address' => trans('customers.address'),
                    'prefix' => 2);

                $html = view('focus.bill.proforma', compact('orderedSupply', 'general'))->render();
                $name = 'delivery_note_' . $orderedSupply->tid . '.pdf';
                break;
        }
        $pdf = new \Mpdf\Mpdf(config('pdf'));
        $pdf->autoLangToFont  = true;
        $pdf->autoScriptToLang = true;
        $pdf->WriteHTML($html);
        $headers = array(
            "Content-type" => "application/pdf",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        return Response::stream($pdf->Output($name, 'I'), 200, $headers);

    }

    public function update_status(Request $request)
    {
        switch ($request->bill_type) {
            case 1:
                $result = OrderedSupply::where('id', $request->bill_id)->update(array('status' => $request->status));
                if ($result) echo json_encode(array('status' => 'Success', 'message' => trans('alerts.bills.updated'), 'bill_status' => trans('payments.' . $request->status)));
                break;
            case 2:
                $result = OrderedSupply::where('id', $request->bill_id)->update(array('i_class' => $request->status));
                if ($result) echo json_encode(array('status' => 'Success', 'message' => trans('alerts.bills.updated'), 'bill_status' => trans('payments.' . $request->status)));
                break;
        }
    }

    public function pos(ManagePosRequest $request, RegistersController $register)
    {
        if ($register->status()) {
            $input = $request->only(['sub', 'p']);
            $customer = Customer::first();
            $accounts = Account::all();

            $input['sub'] = false;
            $last_orderedSupply = Invoice::where('i_class', '=', 1)->latest('id')->first();
            $employee='';
            if(feature(1)['value1']=='yes') $employee=Hrm::all();

            return view('focus.orderedSupply.pos.create')->with(array('last_orderedSupply' => $last_orderedSupply, 'sub' => $input['sub'], 'p' => $request->p, 'accounts' => $accounts, 'customer' => $customer,'employees'=>$employee))->with(bill_helper(1, 2))->with(product_helper());
        } else {
            return view('focus.orderedSupply.pos.open_register');
        }

    }


    public function pos_store(ManagePosRequest $request, PrinterController $printer)
    {

        //Input received from the request
        $orderedSupply = $request->only(['customer_id', 'tid', 'refer', 'orderedSupplydate', 'orderedSupplyduedate', 'recur_after', 'sub', 'notes', 'subtotal', 'shipping', 'tax', 'discount', 'discount_rate', 'after_disc', 'currency', 'total', 'tax_format', 'discount_format', 'ship_tax', 'ship_tax_type', 'ship_rate', 'term_id', 'tax_id', 'p']);

        $orderedSupply_items = $request->only(['product_id', 'product_name', 'code', 'product_qty', 'product_price', 'product_tax', 'product_discount', 'product_subtotal', 'product_subtotal', 'total_tax', 'total_discount', 'product_description', 'unit', 'serial', 'unit_m']);


        if(feature(1)['value1']!='yes')  $orderedSupply['user_id'] = auth()->user()->id;

        $orderedSupply_payment = $request->only(['p_amount', 'p_method', 'p_account', 'b_change']);
        $data2 = $request->only(['custom_field']);
        $data2['ins'] = auth()->user()->ins;
        $orderedSupply['ins'] = auth()->user()->ins;
        $orderedSupply['user_id'] = auth()->user()->id;
        $orderedSupply_items['ins'] = auth()->user()->ins;
        //Create the model using repository create method
        $orderedSupply['i_class'] = 1;
        $result = $this->repository->create(compact('orderedSupply', 'orderedSupply_items', 'data2'));
        if ($result) {
            foreach ($orderedSupply_items['product_id'] as $id) {
                $product_id = ProductVariation::find($id)->product_id;
                $product = Product::find($product_id);
                if ($product->stock_type == 2) {
                    $contains = $product->contains;
                    foreach ($contains as $con) {
                        $updateProductVariantion = ProductVariation::where('product_id', $con->contain_id)->where('warehouse_id', config('constants.warehouse_contains_id'))->first();
                        $updateProductVariantion->qty = $updateProductVariantion->qty - $con->qty;
                        $updateProductVariantion->save();
                    }
                }
            }
            if (isset($result['id'])) $pay = $this->repository->payment($result, $orderedSupply_payment);
            //return with successfull message
            $valid_token = token_validator('', 'i' . $result['id'] . $result['tid'], true);
            $link = route('biller.print_bill', [$result['id'], 1, $valid_token, 1]);
            $link_download = route('biller.print_bill', [$result['id'], 1, $valid_token, 2]);
            $link_preview = route('biller.view_bill', [$result['id'], 1, $valid_token, 0]);
            $link_pos = route('biller.print_compact',[$result['id'],1,$valid_token,1]);

            $lk = '';
            $out = '';
            $printAllow=feature(19);
            $postData = '';
            if ($printAllow->feature_value == 1) $out = $printer->thermal_print($result);
            if ($printAllow->feature_value == 2)  {
                //print background
                $sets=json_decode($printAllow->value1,true);
                $data=$result;
                $postData= array ('orderedSupply' => array ('tid' => $data->tid, 'orderedSupplydate' => dateFormat($data->orderedSupplydate), 'orderedSupplyduedate' =>  dateFormat($data->orderedSupplyduedate), 'subtotal' => numberFormat($data->subtotal), 'shipping' =>numberFormat($data->shipping), 'ship_tax' => numberFormat($data->ship_tax), 'ship_tax_type' => 'incl', 'discount' => numberFormat($data->discount), 'discount_rate' =>numberFormat($data->discount_rate), 'tax' =>numberFormat($data->tax), 'total' => numberFormat($data->total), 'pmethod' => $data->pmethod, 'notes' => $data->notes, 'status' => trans('payments.'.$data->status),'paid' => amountFormat($data->pamnt), 'items' => $data->items, 'taxstatus' => $data->taxstatus, 'discstatus' => $data->discstatus, 'format_discount' => $data->format_discount, 'refer' => $data->refer,  'name' => $data->customer->name, 'phone' => $data->customer->phone, 'address' => $data->customer->address, 'city' => $data->customer->city, 'region' => $data->customer->city, 'country' => $data->customer->country, 'postbox' => $data->customer->postbox, 'email' => $data->customer->email, 'company' => $data->customer->company, 'taxid' => $data->customer->taxid,'termtit' => $data->term->title, 'terms' => $data->term->terms), 'company' => array ( 'cname' => config('core.cname'), 'address' => config('core.address'), 'city' => config('core.city'), 'region' => config('core.region'), 'country' => config('core.country'), 'postbox' => config('core.postbox'), 'phone' => config('core.phone'), 'email' => config('core.email'), 'taxid' => config('core.taxid')), 'items' => $data->products->toArray(), 'currency' => config('core.currency'), );
                // 'product' => ']Suite - Accounting, CRM and POS Software-', 'code' => '', 'qty' => '1.00', 'price' => '50.00', 'tax' => '0.00', 'discount' => '0.00'
                //->pluck('product_name','product_qty','product_price','product_subtotal')
            }
            if (session('d_id')) {
                Draft::find(session('d_id'))->delete();
                session()->forget('d_id');

            }
            if (isset($result['p'])) $lk .= '<a href="' . route('biller.projects.show', [$result['p']]) . '" class="btn btn-info btn-md"><span class="fa fa-repeat" aria-hidden="true"></span> ' . trans('orderedSupply.return_project') . '  </a> ';
            if ($pay) echo json_encode(array('status' => 'Success', 'message' => trans('alerts.backend.orderedSupply.created')
                . ' <a href="' . route('biller.orderedSupply.show', [$result->id]) .
                '" class="btn btn-info btn-md"><span class="fa fa-eye" aria-hidden="true"></span> ' .
                trans('general.view') . '</a><button onclick="printmyorderedSupply()" class="btn btn-purple btn-md"><span class="fa fa-print" aria-hidden="true"></span> الفاتورة  </button>  <button onclick="print('.
                $result->id.')" class="btn btn-purple btn-md"><span class="fa fa-print" aria-hidden="true"></span> ' .
                trans('general.print') . '  </button><button style="margin-left:5px" onclick="printInKitchen('.$result->id.
                ')" class="btn btn-purple btn-md"><span class="fa fa-print"  aria-hidden="true"></span> ' .
                trans('general.print_kitchen') . '  </button> <a href="' . $link_download .
                '" class="btn btn-warning btn-md"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> ' .
                trans('general.pdf') . '  </a> <a href="' . $link_preview .
                '" class="btn btn-purple btn-md"><span class="fa fa-globe" aria-hidden="true"></span> ' .
                trans('general.preview') . '  </a> <a href="' . route('biller.orderedSupply.pos') .
                '" class="btn btn-blue-grey btn-md"><span class="fa fa-plus-circle" aria-hidden="true"></span> ' .
                trans('general.create') . '  </a> ' . $lk . ' &nbsp; &nbsp;<br>' . $out, 'd_id' => $result['id']));
            $feature = feature(11);
            $alert = json_decode($feature->value2, true);
            if ($alert['new_orderedSupply'] or $alert['cust_new_orderedSupply']) {
                $template = Template::all()->where('category', '=', 1)->where('other', '=', 1)->first();
                $valid_token = token_validator('', 'i' . $result['id'] . $result['tid'], true);
                $link = route('biller.view_bill', [$result->id, 1, $valid_token, 0]);
                $data = array(
                    'Company' => config('core.cname'),
                    'BillNumber' => $result->tid,
                    'BillType' => trans('orderedSupply.orderedSupply'),
                    'URL' => "<a href='$link'>$link</a>",
                    'Name' => $result->customer->name,
                    'CompanyDetails' => '<h6><strong>' . config('core.cname') . ',</strong></h6>
                    <address>' . config('core.address') . '<br>' . config('core.city') . '</address>
                    ' . config('core.region') . ' : ' . config('core.country') . '<br>  ' . trans('general.email') . ' : ' . config('core.email'),
                    'DueDate' => dateFormat(date('Y-m-d')),
                    'Amount' => amountFormat($result->total)
                );
                $replaced_body = parse($template['body'], $data, true);
                $subject = parse($template['title'], $data, true);
                $mail = array();
                if ($alert['new_orderedSupplu'] and !$alert['cust_new_orderedSupplu']) {
                    $mail['mail_to'] = $feature->value1;
                } elseif ($alert['cust_new_orderedSupplu'] and !$alert['new_orderedSupplu']) {
                    $mail['mail_to'] = $result->customer->email;
                } else {
                    $mail['mail_to'][] = $result->customer->email;
                    $mail['mail_to'][] = $feature->value1;
                }
                $mail['customer_name'] = trans('transactions.transaction');
                $mail['subject'] = $subject;
                $mail['text'] = $replaced_body;
                business_alerts($mail);
            }
            if ($alert['sms_new_orderedSupply']) {
                $template = Template::all()->where('category', '=', 2)->where('other', '=', 11)->first();
                $valid_token = token_validator('', 'i' . $result['id'] . $result['tid'], true);
                $link = route('biller.view_bill', [$result->id, 1, $valid_token, 0]);
                $short_url = ConfigMeta::where('feature_id', '=', 7)->first(array('feature_value', 'value2'));
                $data['URL'] = $link;
                if ($short_url['feature_value']) {
                    config([
                        'bitly.accesstoken' => $short_url['value2']]);
                    $data['URL'] = Bitly::getUrl($link);
                }
                $replaced_body = parse($template['body'], $data, true);
                $mailer = new \App\Repositories\Focus\general\RosesmsRepository();
                return $mailer->send_bill_sms($result->customer->phone, $replaced_body, false);
            }
        } else {
            echo json_encode(array('status' => 'Error', 'message' => trans('exceptions.backend.orderedSupply.create_error')));
        }

    }

    public function pos_update(ManagePosRequest $request, PrinterController $printer)
    {

        //Input received from the request
        $orderedSupply = $request->only(['customer_id', 'tid', 'refer', 'orderedSupplydate', 'orderedSupplyduedate', 'recur_after', 'sub', 'notes', 'subtotal', 'shipping', 'tax', 'discount', 'discount_rate', 'after_disc', 'currency', 'total', 'tax_format', 'discount_format', 'ship_tax', 'ship_tax_type', 'ship_rate', 'term_id', 'tax_id', 'p', 'id']);

        $orderedSupply_items = $request->only(['product_id', 'product_name', 'code', 'product_qty', 'product_price', 'product_tax', 'product_discount', 'product_subtotal', 'product_subtotal', 'total_tax', 'total_discount', 'product_description', 'unit', 'serial', 'unit_m']);

        $orderedSupply_payment = $request->only(['p_amount', 'p_method', 'p_account', 'b_change']);
        $data2 = $request->only(['custom_field']);
        $data2['ins'] = auth()->user()->ins;
        //dd($orderedSupply_items);
        $orderedSupply['ins'] = auth()->user()->ins;
        $orderedSupply['user_id'] = auth()->user()->id;
        $orderedSupply_items['ins'] = auth()->user()->ins;
        //Create the model using repository create method
        $orderedSupply_ins = OrderedSupply::find($orderedSupply['id']);
        $result = $this->repository->update($orderedSupply_ins, compact('orderedSupply', 'orderedSupply_items', 'data2'));
        if (isset($result['id'])) $pay = $this->repository->payment($result, $orderedSupply_payment);
        //return with successfull message
        $valid_token = token_validator('', 'i' . $result['id'] . $result['tid'], true);
        $link = route('biller.print_bill', [$result['id'], 1, $valid_token, 1]);
        $link_download = route('biller.print_bill', [$result['id'], 1, $valid_token, 2]);
        $link_preview = route('biller.view_bill', [$result['id'], 1, $valid_token, 0]);
        $lk = '';
        $out = '';
        if (feature(19)->feature_value == 1) $out = $printer->thermal_print($result);
        if (isset($result['p'])) $lk .= '<a href="' . route('biller.projects.show', [$result['p']]) . '" class="btn btn-info btn-md"><span class="fa fa-repeat" aria-hidden="true"></span> ' . trans('orderedSupply.return_project') . '  </a> ';
        if ($pay) echo json_encode(array('status' => 'Success', 'message' => trans('alerts.backend.orderedSupply.created') . ' <a href="' . route('biller.orderedSupply.show', [$result->id]) . '" class="btn btn-info btn-md"><span class="fa fa-eye" aria-hidden="true"></span> ' . trans('general.view') . '  </a> <a href="' . $link . '" class="btn btn-purple btn-md"><span class="fa fa-print" aria-hidden="true"></span> ' . trans('general.print') . '  </a> <a href="' . $link_download . '" class="btn btn-warning btn-md"><span class="fa fa-file-pdf-o" aria-hidden="true"></span> ' . trans('general.pdf') . '  </a> <a href="' . $link_preview . '" class="btn btn-purple btn-md"><span class="fa fa-globe" aria-hidden="true"></span> ' . trans('general.preview') . '  </a> <a href="' . route('biller.orderedSupply.pos') . '" class="btn btn-blue-grey btn-md"><span class="fa fa-plus-circle" aria-hidden="true"></span> ' . trans('general.create') . '  </a> ' . $lk . ' &nbsp; &nbsp;<br>' . $out, 'd_id' => $result['id']));

    }

    public function delivery(ManagePosRequest $request, RegistersController $register)
    {
        $input = $request->only(['sub', 'p']);
        $customer = Customer::first();
        $accounts = Account::all();
        $input['sub'] = true;
        $last_orderedSupply = OrderedSupply::where('i_class', '=', 2)->latest()->first();
        return view('focus.orderedSupply.delivery.create')->with(array('last_orderedSupply' => $last_orderedSupply, 'sub' => $input['sub'], 'p' => $request->p, 'accounts' => $accounts, 'customer' => $customer))->with(bill_helper(1, 2))->with(product_helper());
    }

    public function draft_store(ManagePosRequest $request)
    {

        //Input received from the request
        $orderedSupply= $request->only(['customer_id', 'tid', 'refer', 'orderedSupplyate', 'orderedSupplyuedate', 'recur_after', 'sub', 'notes', 'subtotal', 'shipping', 'tax', 'discount', 'discount_rate', 'after_disc', 'currency', 'total', 'tax_format', 'discount_format', 'ship_tax', 'ship_tax_type', 'ship_rate', 'term_id', 'tax_id', 'p']);

        $orderedSupplyitems = $request->only(['product_id', 'product_name', 'code', 'product_qty', 'product_price', 'product_tax', 'product_discount', 'product_subtotal', 'product_subtotal', 'total_tax', 'total_discount', 'product_description', 'unit', 'serial', 'unit_m']);


        $data2 = $request->only(['custom_field']);
        $data2['ins'] = auth()->user()->ins;
        //dd($orderedSupplyitems);
        $orderedSupply['ins'] = auth()->user()->ins;
        $orderedSupply['user_id'] = auth()->user()->id;
        $orderedSupplyitems['ins'] = auth()->user()->ins;
        //Create the model using repository create method
        $result = $this->repository->create_draft(compact('orderedSupply', 'orderedSupplyitems', 'data2'));

        //return with successfull message
        $valid_token = token_validator('', 'i' . $result['id'] . $result['tid'], true);
        $link = route('biller.print_bill', [$result['id'], 1, $valid_token, 1]);
        $link_download = route('biller.print_bill', [$result['id'], 1, $valid_token, 2]);
        $link_preview = route('biller.view_bill', [$result['id'], 1, $valid_token, 0]);
        $lk = '';
        $out = '';

        echo json_encode(array('status' => 'Done', 'message' => trans('alerts.backend.orderedSupply.draft_created')));

    }

    public function drafts_load(ManagePosRequest $request)
    {
        $drafts = Draft::where('user_id', '=', auth()->user()->id)->orderBy('id', 'desc')->take(20)->get();
        foreach ($drafts as $draft) {
            echo '<tr><td>' . $draft->tid . '#' . $draft->id . '<a href="' . route('biller.orderedSupply.draft_view', [$draft->id]) . '"><i class="fa fa-eye" </a></td><td>' . dateTimeFormat($draft->created_at) . '</td><td>' . $draft->user->first_name . '</td></tr>';
        }
    }

    public function draft_view(ManagePosRequest $request)
    {

        $orderedSupply = Draft::find($request->id);
        $customer = Customer::first();
        $accounts = Account::all();

        $input['sub'] = false;
        $last_orderedSupply = OrderedSupply::orderBy('id', 'desc')->where('i_class', '=', 1)->first();
        $orderedSupply['tid'] = $last_orderedSupply['tid'] + 1;
        $action = route('biller.orderedSupply.pos_store');
        session(['d_id' => $orderedSupply['id']]);
        return view('focus.orderedSupply.pos.edit')->with(array('last_orderedSupply' => $last_orderedSupply, 'sub' => $input['sub'], 'p' => $request->p, 'accounts' => $accounts, 'customer' => $customer, 'orderedSupply' => $orderedSupply, 'action' => $action))->with(bill_helper(1, 2));

    }

    public function getSubTaxes(Request $request)
    {
        if (app()->getLocale() == 'ar') {

            $data = SubTax::where('tax_id', $request->tax_id)->pluck('Desc_ar');
        }else{

            $data = SubTax::where('tax_id', $request->tax_id)->pluck('Desc_en');
        }

        return response($data);
    }

    public function duplicate_orderedSupply(CreateOrderedSupplyRequest $request)
    {
        $status=feature(10)['value2'];
        $orderedSupply = OrderedSupply::find($request->id);
        if($status)$orderedSupply->status=$status;
        $orderedSupply->pamnt=0;
        $orderedSupply->pmethod='';
        $orderedSupply->ins = auth()->user()->ins;
        $orderedSupply->notes=trans('en.duplicate_orderedSupply').' '.dateTimeFormat(date('Y-m-d H:i:s'));
        $neworderedSupply = $orderedSupply->replicate();
        $neworderedSupply->created_at = Carbon::now();
        $neworderedSupply->save();

        $products=array();

        foreach($orderedSupply->products->toArray() as $product){
            $product['ordered_supply_id']=$neworderedSupply->id;
            unset($product['id']);
            $products[]=$product;
        }

        OrderedSupplyItem::insert($products);

        return new RedirectResponse(route('biller.orderedSupply.show', [$neworderedSupply->id]), '');
    }

    public function backgroundPrint($id=null,$url=null){
        //PrintCommand
        //ManageOrderedSupplyRequest $request
        $data=OrderedSupply::find($id);
        $postData= array ('orderedSupply' => array ( 'id' => '1', 'tid' => '1001', 'orderedSupplydate' => dateFormat($data->orderedSupplydate), 'orderedSupplyduedate' =>  dateFormat($data->orderedSupplyduedate), 'subtotal' => numberFormat($data->subtotal), 'shipping' =>numberFormat($data->shipping), 'ship_tax' => numberFormat($data->ship_tax), 'ship_tax_type' => 'incl', 'discount' => numberFormat($data->discount), 'discount_rate' =>numberFormat($data->discount_rate), 'tax' =>numberFormat($data->tax), 'total' => numberFormat($data->total), 'pmethod' => $data->pmethod, 'notes' => $data->notes, 'status' => trans('payments.'.$data->status),'paid' => amountFormat($data->pamnt), 'items' => $data->items, 'taxstatus' => $data->taxstatus, 'discstatus' => $data->discstatus, 'format_discount' => $data->format_discount, 'refer' => $data->refer,  'name' => $data->customer->name, 'phone' => $data->customer->phone, 'address' => $data->customer->address, 'city' => $data->customer->city, 'region' => $data->customer->city, 'country' => $data->customer->country, 'postbox' => $data->customer->postbox, 'email' => $data->customer->email, 'company' => $data->customer->company, 'taxid' => $data->customer->taxid,'termtit' => $data->term->title, 'terms' => $data->term->terms), 'company' => array ( 'cname' => config('core.cname'), 'address' => config('core.address'), 'city' => config('core.city'), 'region' => config('core.region'), 'country' => config('core.country'), 'postbox' => config('core.postbox'), 'phone' => config('core.phone'), 'email' => config('core.email'), 'taxid' => config('core.taxid')), 'items' => $data->products->toArray(), 'currency' => config('core.currency'), );

        // $response = Http::post('http://localhost/rose_print_server/print.php', [$postData]);
        //

        $post = array();
        $this->http_build_query_for_multiDim($postData, $post);
        $post['check'] =true;

        //open connection
        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($post));
        curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($post));

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);


        dd($result);

    }
    private function http_build_query_for_multiDim( $arrays, &$new = array(), $prefix = null ) {

        if ( is_object( $arrays ) ) {
            $arrays = get_object_vars( $arrays );
        }

        foreach ( $arrays AS $key => $value ) {
            $k = isset( $prefix ) ? $prefix . '[' . $key . ']' : $key;
            if ( is_array( $value ) OR is_object( $value )  ) {
                $this->http_build_query_for_multiDim( $value, $new, $k );
            } else {
                $new[$k] = $value;
            }
        }
    }
}
