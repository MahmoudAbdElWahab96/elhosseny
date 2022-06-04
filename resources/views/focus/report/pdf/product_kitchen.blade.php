@extends ('focus.report.pdf.statement')
@section('statement_body')
    <table class="plist" cellpadding="0" cellspacing="0">
        <tr class="heading">
            <td>{{trans('general.date')}}</td>
            <td>{{trans('products.product')}}</td>
            <td>{{trans('products.qty')}}</td>
        </tr>
        @foreach ($account_details as $row) {
            @foreach($row->variation->product->contains as $item)
            <tr>
                <td>{{dateFormat($row->created_at)}}</td>
                <td>{{$item->parent->name}}</td>
                <td>{{$item->qty}}</td>
            </tr>
            @endforeach
        @endforeach    
    </table>
    <br>
@endsection
