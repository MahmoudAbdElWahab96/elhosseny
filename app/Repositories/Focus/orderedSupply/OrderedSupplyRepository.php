<?php

namespace App\Repositories\Focus\orderedSupply;

use App\Models\account\Account;
use App\Models\Company\ConfigMeta;
use App\Models\orderedSupply\Draft;
use App\Models\items\CustomEntry;
use App\Models\items\DraftItem;
use App\Exceptions\GeneralException;
use App\Models\items\OrderedSupplyItem;
use App\Models\items\Register;
use App\Models\orderedSupply\OrderedSupply;
use App\Models\product\ProductMeta;
use App\Models\product\ProductVariation;
use App\Models\project\ProjectRelations;
use App\Models\transaction\Transaction;
use App\Models\transaction\TransactionHistory;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mavinoo\Batch\BatchFacade as Batch;

/**
 * Class OrderedSupplyRepository.
 */
class OrderedSupplyRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = OrderedSupply::class;

    /**
     * This method is used by Table Controller
     * For getting the table data to show in
     * the grid
     * @return mixed
     */
    public function getForDataTable()
    {
        $q = $this->query();
        $q->when(request('i_rel_type') == 1, function ($q) {
            return $q->where('customer_id', '=', request('i_rel_id', 0));
        });

        if (request('project_id')) {
            $q->whereHas('project', function ($s) {
                return $s->where('project_id', '=', request('project_id', 0));
            });
        }

        if (request('sub') == 1) {
            $q->where('i_class', '>', 1);
        } elseif (request('sub') == 2) {
            $q->where('i_class', '=', 1);
        } else {
            $q->where('i_class', '<', 1);
        }

        if (request('start_date')) {
            $q->whereBetween('orderedSupplydate', [date_for_database(request('start_date')), date_for_database(request('end_date'))]);
        }


        return
            $q->get(['id', 'tid', 'order_id', 'customer_id', 'orderedSupplydate', 'total']);
    }

    public function getSelfDataTable($self_id = false)
    {
        if ($self_id) {
            $q = $this->query()->withoutGlobalScopes();
            $q->where('customer_id', '=', $self_id);

            return
                $q->get(['id', 'tid', 'customer_id', 'orderedSupplydate', 'total']);
        }
    }

    /**
     * For Creating the respective model in storage
     *
     * @param array $input
     * @return bool
     * @throws GeneralException
     */
    public function create(array $input)
    {
        $extra_discount = numberClean($input['orderedSupply']['after_disc']);
        $input['orderedSupply']['subtotal'] = numberClean($input['orderedSupply']['subtotal']);
        $input['orderedSupply']['shipping'] = numberClean($input['orderedSupply']['shipping']);
        $input['orderedSupply']['discount_rate'] = numberClean($input['orderedSupply']['discount_rate']);
        $input['orderedSupply']['after_disc'] = numberClean($input['orderedSupply']['after_disc']);
        $input['orderedSupply']['total'] = numberClean($input['orderedSupply']['total']);

        $total_discount = $extra_discount;
        if ($input['orderedSupply']['sub']) {
            $input['orderedSupply']['i_class'] = 2;
            $input['orderedSupply']['r_time'] = $input['orderedSupply']['recur_after'];
            unset($input['orderedSupply']['recur_after']);
        }
        $p = @$input['orderedSupply']['p'];
        unset($input['orderedSupply']['after_disc']);
        unset($input['orderedSupply']['ship_rate']);
        unset($input['orderedSupply']['sub']);
        unset($input['orderedSupply']['p']);

        if (!isset($input['orderedSupply_items']['product_id'])) {
            return false;
        }

        DB::beginTransaction();
        $status=feature(10)['value2'];
        $input['orderedSupply'] = array_map('strip_tags', $input['orderedSupply']);
        if($status)$input['orderedSupply']['status']=$status;
        $result = OrderedSupply::create($input['orderedSupply']);
        if ($result) {
            $products = array();
            $subtotal = 0;
            $total_qty = 0;
            $total_tax = 0;
            $stock_update = array();
            $serial_track = array();
            foreach ($input['orderedSupply_items']['product_id'] as $key => $value) {

                $subtotal += numberClean(@$input['orderedSupply_items']['product_price'][$key]) * numberClean(@$input['orderedSupply_items']['product_qty'][$key]);
                $total_qty += numberClean(@$input['orderedSupply_items']['product_qty'][$key]);
                $total_tax += numberClean(@$input['orderedSupply_items']['total_tax'][$key]);
                $total_discount += numberClean(@$input['orderedSupply_items']['total_discount'][$key]);
                if ($input['orderedSupply_items']['serial'][$key]) $serial_track[] = array('rel_type' => 2, 'rel_id' => 1, 'ref_id' => $input['orderedSupply_items']['product_id'][$key], 'value' => strip_tags($input['orderedSupply_items']['serial'][$key]), 'value2' => $result->id);
                if ($input['orderedSupply_items']['unit_m'][$key] > 1) {
                    $unit_val = $input['orderedSupply_items']['unit_m'][$key];
                    $qty = $unit_val * numberClean($input['orderedSupply_items']['product_qty'][$key]);
                } else {
                    $unit_val = 1;
                    $qty = numberClean($input['orderedSupply_items']['product_qty'][$key]);
                }
                $products[] = array('ordered_supply_id' => $result->id,
                    'product_id' => $input['orderedSupply_items']['product_id'][$key],
                    'product_name' => strip_tags(@$input['orderedSupply_items']['product_name'][$key]),
                    'code' => @$input['orderedSupply_items']['code'][$key],
                    'product_qty' => numberClean(@$input['orderedSupply_items']['product_qty'][$key]),
                    'product_price' => numberClean(@$input['orderedSupply_items']['product_price'][$key]),
                    'product_tax' => numberClean(@$input['orderedSupply_items']['product_tax'][$key]),
                    'product_discount' => numberClean(@$input['orderedSupply_items']['product_discount'][$key]),
                    'product_subtotal' => numberClean(@$input['orderedSupply_items']['product_subtotal'][$key]),
                    'total_tax' => numberClean(@$input['orderedSupply_items']['total_tax'][$key]),
                    'total_discount' => numberClean(@$input['orderedSupply_items']['total_discount'][$key]),
                    'product_des' => strip_tags(@$input['orderedSupply_items']['product_description'][$key], config('general.allowed')),
                    'unit_value' => $unit_val,
                    'serial' => @$input['orderedSupply_items']['serial'][$key],
                    'i_class' => 0,
                    'unit' => $input['orderedSupply_items']['unit'][$key], 'ins' => $result->ins);
                $stock_update[] = array('id' => $input['orderedSupply_items']['product_id'][$key], 'qty' => $qty);
            }

            OrderedSupplyItem::insert($products);
            $orderedSupply_d = OrderedSupply::find($result->id);
            $orderedSupply_d->subtotal = $subtotal;
            $orderedSupply_d->tax = $total_tax;
            $orderedSupply_d->discount = $total_discount;
            $orderedSupply_d->items = $total_qty;
            $orderedSupply_d->save();
            if (@$result->id) {
                $fields = array();
                if (isset($input['data2']['custom_field'])) {
                    foreach ($input['data2']['custom_field'] as $key => $value) {
                        $fields[] = array('custom_field_id' => $key, 'rid' => $result->id, 'module' => 2, 'data' => strip_tags($value), 'ins' => $input['data2']['ins']);
                    }
                    CustomEntry::insert($fields);
                }
            }
            $update_variation = new ProductVariation;
            $index = 'id';
            Batch::update($update_variation, $stock_update, $index, true);
            $update_variation = new ProductMeta;
            $index = 'value';
            $index2 = 'ref_id';
            $out_s = $this->update_dual($update_variation, $serial_track, $index, $index2);
            if ($p > 0) {
                ProjectRelations::create(array('project_id' => $p, 'related' => 7, 'rid' => $result->id));
                $result['p'] = $p;
            }
            DB::commit();
            return $result;
        }
        throw new GeneralException(trans('exceptions.backend.orderedSupply.create_error'));
    }

    private function update_dual(Model $table, array $values, string $index = null, $index2 = null)
    {
        $final = [];

        if (!count($values)) {
            return false;
        }

        $whr = '';
        foreach ($values as $key => $val) {

            $q = '';
            $i = 0;
            foreach (array_keys($val) as $field) {
                if ($field != $index and $field != $index2) {

                    if ($i < 2) $q .= $field . '=' . $val[$field] . ',';
                    if ($i == 2) $q .= $field . '=' . $val[$field] . ' ';

                    $i++;
                }
            }
            $whr .= "UPDATE `" . $table->getTable() . "` SET $q";
            $whr .= 'WHERE (`' . $index . '` = "' . $val[$index] . '" AND `' . $index2 . '` = "' . $val[$index2] . '"  AND `value2` IS NULL);';
        }

        return DB::statement($whr);

    }


    /**
     * For updating the respective Model in storage
     *
     * @param OrderedSupply $orderedSupply
     * @param  $input
     * @throws GeneralException
     * return bool
     */
    public function update(OrderedSupply $orderedSupply, array $input)
    {
        $p = @$input['orderedSupply']['p'];

        $id = $input['orderedSupply']['id'];
        $extra_discount = numberClean($input['orderedSupply']['after_disc']);
        $input['orderedSupply']['subtotal'] = numberClean($input['orderedSupply']['subtotal']);
        $input['orderedSupply']['shipping'] = numberClean($input['orderedSupply']['shipping']);
        $input['orderedSupply']['discount_rate'] = numberClean($input['orderedSupply']['discount_rate']);
        $input['orderedSupply']['after_disc'] = numberClean($input['orderedSupply']['after_disc']);
        $input['orderedSupply']['total'] = numberClean($input['orderedSupply']['total']);
        $input['orderedSupply']['ship_tax_rate'] = numberClean($input['orderedSupply']['ship_rate']);
        $input['orderedSupply']['ship_tax'] = numberClean($input['orderedSupply']['ship_tax']);
        $input['orderedSupply']['extra_discount'] = $extra_discount;
        $total_discount = $extra_discount;
        $re_stock = @$input['orderedSupply']['restock'];
        unset($input['orderedSupply']['after_disc']);
        unset($input['orderedSupply']['ship_rate']);
        unset($input['orderedSupply']['id']);
        unset($input['orderedSupply']['restock']);
        unset($input['orderedSupply']['sub']);
        unset($input['orderedSupply']['p']);

        DB::beginTransaction();
        $result = OrderedSupply::find($id);
        if ($result->status == 'canceled') return false;
        if ($result->i_class > 1) {
            $input['orderedSupply']['r_time'] = $input['orderedSupply']['recur_after'];
            unset($input['orderedSupply']['recur_after']);
        }
        $input['orderedSupply'] = array_map('strip_tags', $input['orderedSupply']);
        $result->update($input['orderedSupply']);

        if ($result) {
            OrderedSupplyItem::where('ordered_supply_id', $id)->delete();
            $products = array();
            $subtotal = 0;
            $total_qty = 0;
            $total_tax = 0;
            foreach ($input['orderedSupply_items']['product_id'] as $key => $value) {

                if ($input['orderedSupply_items']['unit_m'][$key] > 1) {
                    $unit_val = $input['orderedSupply_items']['unit_m'][$key];
                    $qty = $unit_val * numberClean($input['orderedSupply_items']['product_qty'][$key]);
                    $old_qty = $unit_val * numberClean(@$input['orderedSupply_items']['old_product_qty'][$key]);
                } else {
                    $unit_val = 1;
                    $qty = numberClean($input['orderedSupply_items']['product_qty'][$key]);
                    $old_qty = numberClean(@$input['orderedSupply_items']['old_product_qty'][$key]);
                }

                $subtotal += numberClean(@$input['orderedSupply_items']['product_price'][$key]) * numberClean(@$input['orderedSupply_items']['product_qty'][$key]);
                //$qty = numberClean($input['orderedSupply_items']['product_qty'][$key]);

                $total_qty += $qty;
                $total_tax += numberClean(@$input['orderedSupply_items']['total_tax'][$key]);
                $total_discount += numberClean(@$input['orderedSupply_items']['total_discount'][$key]);
                $products[] = array('ordered_supply_id' => $id,
                    'product_id' => $input['orderedSupply_items']['product_id'][$key],
                    'product_name' => strip_tags(@$input['orderedSupply_items']['product_name'][$key]),
                    'code' => @$input['orderedSupply_items']['code'][$key],
                    'product_qty' => numberClean(@$input['orderedSupply_items']['product_qty'][$key]),
                    'product_price' => numberClean(@$input['orderedSupply_items']['product_price'][$key]),
                    'product_tax' => numberClean(@$input['orderedSupply_items']['product_tax'][$key]),
                    'product_discount' => numberClean(@$input['orderedSupply_items']['product_discount'][$key]),
                    'product_subtotal' => numberClean(@$input['orderedSupply_items']['product_subtotal'][$key]),
                    'total_tax' => numberClean(@$input['orderedSupply_items']['total_tax'][$key]),
                    'total_discount' => numberClean(@$input['orderedSupply_items']['total_discount'][$key]),
                    'product_des' => strip_tags(@$input['orderedSupply_items']['product_description'][$key], config('general.allowed')),
                    'unit_value' => $unit_val,
                    'i_class' => 0,
                    'unit' => $input['orderedSupply_items']['unit'][$key], 'ins' => $input['orderedSupply']['ins']);

                if ($old_qty > 0) {
                    $stock_update[] = array('id' => $input['orderedSupply_items']['product_id'][$key], 'qty' => $qty - $old_qty);
                } else {
                    $stock_update[] = array('id' => $input['orderedSupply_items']['product_id'][$key], 'qty' => $qty);
                }

            }
            OrderedSupplyItem::insert($products);
            $orderedSupply_d = OrderedSupply::find($id);
            $orderedSupply_d->subtotal = $subtotal;
            $orderedSupply_d->tax = $total_tax;
            $orderedSupply_d->discount = $total_discount;
            $orderedSupply_d->items = $total_qty;
            $orderedSupply_d->save();

            if (isset($input['data2']['custom_field'])) {
                foreach ($input['data2']['custom_field'] as $key => $value) {
                    $fields[] = array('custom_field_id' => $key, 'rid' => $id, 'module' => 2, 'data' => strip_tags($value), 'ins' => $input['orderedSupply']['ins']);
                    CustomEntry::where('custom_field_id', '=', $key)->where('rid', '=', $id)->delete();
                }
                CustomEntry::insert($fields);
            }
            $update_variation = new ProductVariation;
            $index = 'id';
            Batch::update($update_variation, $stock_update, $index, true, '-');

            if (is_array($re_stock)) {
                $stock_update_one = array();
                foreach ($re_stock as $key => $value) {
                    $myArray = explode('-', $value);
                    $s_id = $myArray[0];
                    $s_qty = numberClean($myArray[1]);
                    if ($s_id) $stock_update_one[] = array('id' => $s_id, 'qty' => $s_qty);
                }

                Batch::update($update_variation, $stock_update_one, $index, true, '+');
            }


            DB::commit();


            return $result;
        }


        throw new GeneralException(trans('exceptions.backend.orderedSupply.update_error'));
    }

    /**
     * For deleting the respective model from storage
     *
     * @param OrderedSupply $orderedSupply
     * @return bool
     * @throws GeneralException
     */
    public function delete(OrderedSupply $orderedSupply)
    {
        $transactions = $orderedSupply->transactions;
        if (count($transactions)) {
            foreach ($transactions as $transaction) {
                $account = Account::find($transaction->account_id);
                $account->balance += $transaction->debit;
                $account->balance -= $transaction->credit;
                $account->save();
                $transaction->delete();
            }
        }
        if ($orderedSupply->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.orderedSupply.delete_error'));
    }

    public function convert(array $input)
    {

        $last_orderedSupply = OrderedSupply::orderBy('id', 'desc')->where('i_class', '=', 0)->first();

        $extra_discount = numberClean($input['orderedSupply']['after_disc']);
        $input['orderedSupply']['tid'] = @$last_orderedSupply->tid + 1;
        $input['orderedSupply']['extra_discount'] = $extra_discount;
        $total_discount = $extra_discount;
        unset($input['orderedSupply']['after_disc']);
        unset($input['orderedSupply']['ship_rate']);

        //   DB::beginTransaction();

        $result = OrderedSupply::create($input['orderedSupply']);
        if ($result) {


            $products = array();
            $subtotal = 0;
            $total_qty = 0;
            $total_tax = 0;
            $stock_update = array();


            foreach ($input['orderedSupply_items'] as $row) {
                $subtotal += (@$row['product_price']) * (@$row['product_qty']);
                $total_qty += (@$row['product_qty']);
                $total_tax += (@$row['total_tax']);
                $total_discount += (@$row['total_discount']);
                $products[] = array('ordered_supply_id' => $result->id,
                    'product_id' => @$row['product_id'],
                    'product_name' => @$row['product_name'],
                    'code' => @$row['code'],
                    'product_qty' => (@$row['product_qty']),
                    'product_price' => (@$row['product_price']),
                    'product_tax' => (@$row['product_tax']),
                    'product_discount' => (@$row['product_discount']),
                    'product_subtotal' => (@$row['product_subtotal']),
                    'total_tax' => (@$row['total_tax']),
                    'total_discount' => (@$row['total_discount']),
                    'product_des' => @$row['product_des'],
                    'i_class' => 0,
                    'unit' => $row['unit'], 'ins' => $result->ins);
            }

            $stock_update[] = array('id' => $row['product_id'], 'qty' => $row['product_qty']);
            OrderedSupplyItem::insert($products);
            $orderedSupply_d = OrderedSupply::find($result->id);
            $orderedSupply_d->subtotal = $subtotal;
            $orderedSupply_d->tax = $total_tax;
            $orderedSupply_d->discount = $total_discount;
            $orderedSupply_d->items = $total_qty;
            $orderedSupply_d->save();


            if (@$result->id) {
                $fields = array();
                if (isset($input['data2']['custom_field'])) {
                    foreach ($input['data2']['custom_field'] as $key => $value) {
                        $fields[] = array('custom_field_id' => $key, 'rid' => $result->id, 'module' => 2, 'data' => $value, 'ins' => $input['data2']['ins']);
                    }
                    CustomEntry::insert($fields);
                }
            }

            $update_variation = new ProductVariation;
            $index = 'id';
            Batch::update($update_variation, $stock_update, $index, true);


            //     DB::commit();
            return $result;
        }
        throw new GeneralException(trans('exceptions.backend.orderedSupply.create_error'));
    }

    public function payment($orderedSupply, $payment)
    {
        DB::beginTransaction();
        $payments = array();
        $default_category = ConfigMeta::withoutGlobalScopes()->where('feature_id', '=', 8)->first('feature_value');
        $words['prefix'] = prefix(1);
        $total_amount = 0;
        $register_update = array();
        foreach ($payment['p_amount'] as $key => $amount) {
            $pay_method = $payment['p_method'][$key];
            $amount = numberClean($amount);

            if (!isset($register_update[$pay_method])) {
                $register_update[$pay_method] = $amount;
            } else {
                $register_update[$pay_method] = $register_update[$pay_method] + $amount;
            }

            if ($pay_method == 'Wallet') {
                $available_balance = $orderedSupply->customer->balance;
                if ($available_balance >= $amount) {
                    $r_wallet = $available_balance - $amount;
                    $orderedSupply->customer->balance = $r_wallet;
                    $orderedSupply->customer->save();
                } else {
                    $amount = 0;
                }
            }
            $transaction = array();
            if ($amount > 0) {

                $transaction['ins'] = auth()->user()->ins;
                $transaction['user_id'] = auth()->user()->id;
                $transaction['credit'] = $amount;
                $transaction['debit'] = 0;
                $transaction['payment_date'] = $orderedSupply->orderedSupplydate;
                $transaction['credit'] = $amount;
                $transaction['payer_id'] = $orderedSupply->customer_id;
                $transaction['payer'] = $orderedSupply->customer->name;
                $transaction['trans_category_id'] = $default_category['feature_value'];
                $transaction['method'] = $pay_method;
                $transaction['account_id'] = $payment['p_account'];
                $transaction['note'] = trans('orderedSupply.payment_for_orderedSupply') . ' ' . $words['prefix'] . '#' . $orderedSupply->tid;
                $transaction['bill_id'] = $orderedSupply->id;
                $transaction['relation_id'] = 0;
                $payments[] = $transaction;
                $total_amount += $amount;
            }

        }

        try {
            if (count($transaction) > 0) {

                $result = Transaction::insert($payments);
                $note = trans('payments.paid_amount') . ' ' . amountFormat($total_amount);
                TransactionHistory::create(array('party_id' => $orderedSupply->customer->id, 'user_id' => auth()->user()->id, 'note' => strip_tags($note), 'relation_id' => 11, 'ins' => auth()->user()->ins));
                $new_data = array();
                $register = Register::orderBy('id', 'desc')->where('user_id', '=', auth()->user()->id)->whereNull('closed_at')->first();
                $items = json_decode($register->data, true);
                $register_update['Change'] = numberClean($payment['b_change']);

                foreach ($items as $key => $reg) {

                    if (isset($register_update[$key])) $new_data[$key] = $register_update[$key] + $reg; else $new_data[$key] = $reg;

                }
                $register->data = json_encode($new_data);
                $register->save();
            }

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            echo json_encode(array('status' => 'Error', 'message' => trans('exceptions.valid_entry_account') . $e->getCode()));
            return false;
        }

        $dual_entry = ConfigMeta::withoutGlobalScopes()->where('feature_id', '=', 13)->first();
        if ($dual_entry['feature_value']) {
            $payments2 = array();
            foreach ($payments as $payment_row) {
                $payment_row['debit'] = $payment_row['credit'];
                $payment_row['credit'] = 0;
                $payments2[] = $payment_row;
            }
            Transaction::insert($payments2);
        }

        if (isset($result)) {

            $account = Account::find($payment['p_account']);
            $account->balance = $account->balance + $total_amount;
            $account->save();
            if ($dual_entry['feature_value']) {
                $account = Account::find($dual_entry['value1']);
                $account->balance = $account->balance - $total_amount;
                $account->save();
            }
            $due = $orderedSupply->total - ($total_amount + $orderedSupply->pamnt);
            $orderedSupply->pmethod = $transaction['method'];

            if ($due <= 0) {

                $orderedSupply->pamnt = $orderedSupply->total;
                $orderedSupply->status = 'paid';

            } elseif ($total_amount < $orderedSupply->total and $total_amount > 0) {

                $orderedSupply->pamnt = $orderedSupply->pamnt + $total_amount;

                $orderedSupply->status = 'partial';
            }
            $orderedSupply->save();
        } elseif ($orderedSupply->pamnt >= $orderedSupply->total) {
            $orderedSupply->status = 'paid';
            $orderedSupply->pamnt = $orderedSupply->total;

            $orderedSupply->save();
        } elseif ($orderedSupply->pamnt > 0) {
            $orderedSupply->status = 'partial';

            $orderedSupply->save();
        }
        if (isset(auth()->valid)) DB::commit(); else  DB::rollBack();

        return true;
    }

    public function create_draft(array $input)
    {
        $extra_discount = numberClean($input['orderedSupply']['after_disc']);
        $input['orderedSupply']['orderedSupplydate'] = date_for_database($input['orderedSupply']['orderedSupplydate']);
        $input['orderedSupply']['subtotal'] = numberClean($input['orderedSupply']['subtotal']);
        $input['orderedSupply']['shipping'] = numberClean($input['orderedSupply']['shipping']);
        $input['orderedSupply']['discount_rate'] = numberClean($input['orderedSupply']['discount_rate']);
        $input['orderedSupply']['after_disc'] = numberClean($input['orderedSupply']['after_disc']);
        $input['orderedSupply']['total'] = numberClean($input['orderedSupply']['total']);
        $input['orderedSupply']['ship_tax_rate'] = numberClean($input['orderedSupply']['ship_rate']);
        $input['orderedSupply']['ship_tax'] = numberClean($input['orderedSupply']['ship_tax']);
        $input['orderedSupply']['extra_discount'] = $extra_discount;
        $input['orderedSupply']['i_class'] = 1;
        $total_discount = $extra_discount;
        if ($input['orderedSupply']['sub']) {
            $input['orderedSupply']['i_class'] = 2;
            $input['orderedSupply']['r_time'] = $input['orderedSupply']['recur_after'];
            unset($input['orderedSupply']['recur_after']);
        }
        $p = @$input['orderedSupply']['p'];
        unset($input['orderedSupply']['after_disc']);
        unset($input['orderedSupply']['ship_rate']);
        unset($input['orderedSupply']['sub']);
        unset($input['orderedSupply']['p']);


        DB::beginTransaction();

        $result = Draft::create($input['orderedSupply']);
        if ($result) {
            $products = array();
            $subtotal = 0;
            $total_qty = 0;
            $total_tax = 0;
            $stock_update = array();
            $serial_track = array();
            foreach ($input['orderedSupply_items']['product_id'] as $key => $value) {

                $subtotal += numberClean(@$input['orderedSupply_items']['product_price'][$key]) * numberClean(@$input['orderedSupply_items']['product_qty'][$key]);
                $total_qty += numberClean(@$input['orderedSupply_items']['product_qty'][$key]);
                $total_tax += numberClean(@$input['orderedSupply_items']['total_tax'][$key]);
                $total_discount += numberClean(@$input['orderedSupply_items']['total_discount'][$key]);
                if ($input['orderedSupply_items']['serial'][$key]) $serial_track[] = array('rel_type' => 2, 'rel_id' => 1, 'ref_id' => $input['orderedSupply_items']['product_id'][$key], 'value' => $input['orderedSupply_items']['serial'][$key], 'value2' => $result->id);
                if ($input['orderedSupply_items']['unit_m'][$key] > 1) {
                    $unit_val = $input['orderedSupply_items']['unit_m'][$key];
                    $qty = $unit_val * numberClean($input['orderedSupply_items']['product_qty'][$key]);
                } else {
                    $unit_val = 1;
                    $qty = numberClean($input['orderedSupply_items']['product_qty'][$key]);
                }
                $products[] = array('ordered_supply_id' => $result->id,
                    'product_id' => $input['orderedSupply_items']['product_id'][$key],
                    'product_name' => @$input['orderedSupply_items']['product_name'][$key],
                    'code' => @$input['orderedSupply_items']['code'][$key],
                    'product_qty' => numberClean(@$input['orderedSupply_items']['product_qty'][$key]),
                    'product_price' => numberClean(@$input['orderedSupply_items']['product_price'][$key]),
                    'product_tax' => numberClean(@$input['orderedSupply_items']['product_tax'][$key]),
                    'product_discount' => numberClean(@$input['orderedSupply_items']['product_discount'][$key]),
                    'product_subtotal' => numberClean(@$input['orderedSupply_items']['product_subtotal'][$key]),
                    'total_tax' => numberClean(@$input['orderedSupply_items']['total_tax'][$key]),
                    'total_discount' => numberClean(@$input['orderedSupply_items']['total_discount'][$key]),
                    'product_des' => @$input['orderedSupply_items']['product_description'][$key],
                    'unit_value' => $unit_val,
                    'serial' => @$input['orderedSupply_items']['serial'][$key],
                    'i_class' => 0,
                    'unit' => $input['orderedSupply_items']['unit'][$key], 'ins' => $result->ins);
                $stock_update[] = array('id' => $input['orderedSupply_items']['product_id'][$key], 'qty' => $qty);
            }

            DraftItem::insert($products);
            $orderedSupply_d = Draft::find($result->id);
            $orderedSupply_d->subtotal = $subtotal;
            $orderedSupply_d->tax = $total_tax;
            $orderedSupply_d->discount = $total_discount;
            $orderedSupply_d->items = $total_qty;
            $orderedSupply_d->save();


            DB::commit();
            return $result;
        }
        throw new GeneralException(trans('exceptions.backend.orderedSupply.create_error'));
    }
}
