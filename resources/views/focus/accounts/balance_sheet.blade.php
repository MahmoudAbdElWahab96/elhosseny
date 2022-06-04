@extends ('core.layouts.app')
@section ('title', trans('accounts.balance_sheet').' | ' . trans('labels.backend.accounts.management'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.accounts.management') }}
        <small>{{ trans('labels.backend.accounts.create') }}</small>
    </h1>
@endsection
@section('after-styles')
    {!! Html::style('core/assets/css/tree.css') !!}
    <style>
        .tree {
            width:100%;
            min-height:100%;
            padding:19px;
            margin-bottom:20px;
            background-color:#fbfbfb;
            border:1px solid #999;
            -webkit-border-radius:4px;
            -moz-border-radius:4px;
            border-radius:4px;
            -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
            -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
            box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
        }
        .tree .ul-parent li {
            list-style-type: none;
            margin: 9px;
            padding: 3px 14px 4px 5px;
            position: relative;
            border:0.5px solid #ddd !important;
            border-radius: 5px;
        }
        .tree .ul-parent li::before, .tree .ul-parent li::after {
            content:'';
            left:-20px;
            position:absolute;
            right:auto
        }
        .tree .ul-parent li::before {
            border-left:1px solid #999;
            bottom:50px;
            height:100%;
            top:0;
            width:1px
        }
        .tree .ul-parent li::after {
            border-top:1px solid #999;
            height:20px;
            top:25px;
            width:25px
        }
        .tree .ul-parent li span {
            border-radius: 5px;
            display: inline-block;
            text-decoration: none;
        }
        .tree .ul-parent li.parent_li>span {
            cursor:pointer
        }
        .tree>ul>li::before, .tree>ul>li::after {
            border:0
        }
        .tree .ul-parent li:last-child::before {
            height:30px
        }
        .balance{
            float: left;
            margin-left: 25px;
        }
    </style>
@endsection
@section('content')
    <div class="">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="mb-0"> {{trans('accounts.balance_sheet')}} <a class="btn btn-success btn-sm"
                                                                             href="{{ route( 'biller.accounts.balance_sheet',['p']) }}">
                            <i class="fa fa-print"></i> {{ trans('general.print') }}</a></h3>

                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="media width-250 float-right">

                        <div class="media-body media-right text-right">
                            @include('focus.accounts.partials.accounts-header-buttons')
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="content-body">
                <div class="row">
                    <div class="tree well">
                        <ul class="ul-parent">
                            <li>
                                <span><i class="fa fa-minus"></i> </span>
                                <span class="balance">--------------</span> 
                                <span class="balance">مدين</span> 
                                <span class="balance">--</span> 
                                <span class="balance">دائن</span> 
                            </li>    
                            <li>
                                <span><i class="fa fa-minus"></i>الدليل المحاسبي  </span>
                                <span class="balance">--------------</span> 
                                <span class="balance">{{ $total_debit }}</span> 
                                <span class="balance">--</span> 
                                <span class="balance">{{ $total_credit }}</span> 
                            </li>
                            
                            @foreach($accounts as $account)
                                <li>
                                    @if($level == $account->level)
                                        <a class=""
                                            href="{{route('biller.transactions.index')}}?rel_type=9&rel_id={{$account['id']}}"
                                            title="List"><i class="fa fa-leaf"></i> 
                                            {{ $account->holder }}
                                        </a>
                                    @else
                                        <span><i class="fa fa-minus"></i> {{ $account->holder }}</span>
                                    @endif
                                    @if($account->balance < 0)
                                        <span class="balance">(-){{ amountFormat(abs($account->balance)) }}</span> 
                                    @else
                                        <span class="balance">{{ amountFormat($account->balance) }}</span> 
                                    @endif
                                    @if($account->debit < 0)
                                        <span class="balance">{{ amountFormat($account->balance) }}</span> 
                                    @else
                                        <span class="balance">{{ amountFormat($account->debit) }}</span> 
                                    @endif
                                    @if($account->credit < 0)
                                        <span class="balance">(-){{ amountFormat(abs($account->credit)) }}</span> 
                                    @else
                                        <span class="balance">{{ amountFormat($account->credit) }}</span> 
                                    @endif
                                    <ul class="sub-parent">
                                    @foreach($account->subAccounts as $sub_two)
                                        <li>
                                            @if($level == $sub_two->level)
                                                <a class=""
                                                    href="{{route('biller.transactions.index')}}?rel_type=9&rel_id={{$sub_two['id']}}"
                                                    title="List"><i class="fa fa-leaf"></i> 
                                                    {{ $sub_two->holder }}
                                                </a>
                                            @else
                                                <span><i class="fa fa-minus"></i> {{ $sub_two->holder }}</span>
                                            @endif
                                            @if($sub_two->balance < 0)
                                                <span class="balance">(-){{ amountFormat(abs($sub_two->balance)) }}</span> 
                                            @else
                                                <span class="balance">{{ amountFormat($sub_two->balance) }}</span> 
                                            @endif
                                            @if($sub_two->debit < 0)
                                                <span class="balance">{{ amountFormat($sub_two->balance) }}</span> 
                                            @else
                                                <span class="balance">{{ amountFormat($sub_two->debit) }}</span> 
                                            @endif
                                            @if($sub_two->credit < 0)
                                                <span class="balance">(-){{ amountFormat(abs($sub_two->credit)) }}</span> 
                                            @else
                                                <span class="balance">{{ amountFormat($sub_two->credit) }}</span> 
                                            @endif
                                            <ul class="sub-parent">
                                            @foreach($sub_two->subAccounts as $sub_three)
                                                <li>
                                                    @if($level == $sub_three->level)
                                                        <a class=""
                                                            href="{{route('biller.transactions.index')}}?rel_type=9&rel_id={{$sub_three['id']}}"
                                                            title="List"><i class="fa fa-leaf"></i> 
                                                            {{ $sub_three->holder }}
                                                        </a>
                                                    @else
                                                        <span><i class="fa fa-minus"></i> {{ $sub_three->holder }}</span>
                                                    @endif
                                                    @if($sub_three->balance < 0)
                                                        <span class="balance">(-){{ amountFormat(abs($sub_three->balance)) }}</span> 
                                                    @else
                                                        <span class="balance">{{ amountFormat($sub_three->balance) }}</span> 
                                                    @endif
                                                    @if($sub_three->debit < 0)
                                                        <span class="balance">{{ amountFormat($sub_three->balance) }}</span> 
                                                    @else
                                                        <span class="balance">{{ amountFormat($sub_three->debit) }}</span> 
                                                    @endif
                                                    @if($sub_three->credit < 0)
                                                        <span class="balance">(-){{ amountFormat(abs($sub_three->credit)) }}</span> 
                                                    @else
                                                        <span class="balance">{{ amountFormat($sub_three->credit) }}</span> 
                                                    @endif
                                                    <ul class="sub-parent">
                                                    @foreach($sub_three->subAccounts as $sub_four)
                                                        <li>
                                                            @if($level == $sub_four->level)
                                                                <a class=""
                                                                    href="{{route('biller.transactions.index')}}?rel_type=9&rel_id={{$sub_four['id']}}"
                                                                    title="List"><i class="fa fa-leaf"></i> 
                                                                    {{ $sub_four->holder }}
                                                                </a>
                                                            @else
                                                                <span><i class="fa fa-minus"></i> {{ $sub_four->holder }}</span>
                                                            @endif
                                                            @if($sub_four->balance < 0)
                                                                <span class="balance">(-){{ amountFormat(abs($sub_four->balance)) }}</span> 
                                                            @else
                                                                <span class="balance">{{ amountFormat($sub_four->balance) }}</span> 
                                                            @endif
                                                            @if($sub_four->debit < 0)
                                                                <span class="balance">{{ amountFormat($sub_four->balance) }}</span> 
                                                            @else
                                                                <span class="balance">{{ amountFormat($sub_four->debit) }}</span> 
                                                            @endif
                                                            @if($sub_four->credit < 0)
                                                                <span class="balance">(-){{ amountFormat(abs($sub_four->credit)) }}</span> 
                                                            @else
                                                                <span class="balance">{{ amountFormat($sub_four->credit) }}</span> 
                                                            @endif
                                                            <ul class="sub-parent">
                                                            @foreach($sub_four->subAccounts as $sub_five)
                                                                <li>
                                                                    @if($level == $sub_five->level)
                                                                        <a class=""
                                                                            href="{{route('biller.transactions.index')}}?rel_type=9&rel_id={{$sub_five['id']}}"
                                                                            title="List"><i class="fa fa-leaf"></i> 
                                                                            {{ $sub_five->holder }}
                                                                        </a>
                                                                    @else
                                                                        <span><i class="fa fa-minus"></i> {{ $sub_five->holder }}</span>
                                                                    @endif
                                                                    @if($sub_five->balance < 0)
                                                                        <span class="balance">(-){{ amountFormat(abs($sub_five->balance)) }}</span> 
                                                                    @else
                                                                        <span class="balance">{{ amountFormat($sub_five->balance) }}</span> 
                                                                    @endif
                                                                    @if($sub_five->debit < 0)
                                                                        <span class="balance">{{ amountFormat($sub_five->balance) }}</span> 
                                                                    @else
                                                                        <span class="balance">{{ amountFormat($sub_five->debit) }}</span> 
                                                                    @endif
                                                                    @if($sub_five->credit < 0)
                                                                        <span class="balance">(-){{ amountFormat(abs($sub_five->credit)) }}</span> 
                                                                    @else
                                                                        <span class="balance">{{ amountFormat($sub_five->credit) }}</span> 
                                                                    @endif
                                                                    <ul class="sub-parent">
                                                                    @foreach($sub_five->subAccounts as $sub_six)
                                                                        <li>
                                                                            @if($level == $sub_six->level)
                                                                                <a class=""
                                                                                    href="{{route('biller.transactions.index')}}?rel_type=9&rel_id={{$sub_six['id']}}"
                                                                                    title="List"><i class="fa fa-leaf"></i> 
                                                                                    {{ $sub_six->holder }}
                                                                                </a>
                                                                            @else
                                                                                <span><i class="fa fa-minus"></i> {{ $sub_six->holder }}</span>
                                                                            @endif
                                                                            @if($sub_six->balance < 0)
                                                                                <span class="balance">(-){{ amountFormat(abs($sub_six->balance)) }}</span> 
                                                                            @else
                                                                                <span class="balance">{{ amountFormat($sub_six->balance) }}</span> 
                                                                            @endif
                                                                            @if($sub_six->debit < 0)
                                                                                <span class="balance">(-){{ amountFormat(abs($sub_six->debit)) }}</span> 
                                                                            @else
                                                                                <span class="balance">{{ amountFormat($sub_six->debit) }}</span> 
                                                                            @endif
                                                                            @if($sub_six->credit < 0)
                                                                                <span class="balance">(-){{ amountFormat(abs($sub_six->credit)) }}</span> 
                                                                            @else
                                                                                <span class="balance">{{ amountFormat($sub_six->credit) }}</span> 
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('after-scripts')

        <script>
            var toggler = document.getElementsByClassName("caret");
            var i;

            for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
            }

            $(function () {
                $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
                $('.tree li.parent_li > span').on('click', function (e) {
                    var children = $(this).parent('li.parent_li').find(' > ul > li');
                    if (children.is(":visible")) {
                        children.hide('fast');
                        $(this).attr('title', 'Expand this branch').find(' > i').addClass('fa icon-plus').removeClass('fa icon-minus');
                    } else {
                        children.show('fast');
                        $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa icon-minus').removeClass('fa icon-plus');
                    }
                    e.stopPropagation();
                });
            });
        </script>

@endsection