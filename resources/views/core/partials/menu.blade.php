@php
    $screens = [];
        $data = \App\Models\screen\Screen::all();
        if (count($data) > 0) {
            foreach ($data as $screen) {
                array_push($screens, [
                    'id' => $screen->id,
                    'name' => $screen->LocaleName()
                ]);
            }

        }
        $shared ['screens'] = $screens;
        $shared ['is_screens'] = count($screens) > 0 ;

        use App\Models\settings\SettingsRequiredFields;
        use App\Models\orderedSupply\OrderedSupply;

        $orderedSupply_show = SettingsRequiredFields::where('model_type', OrderedSupply::class)->where('field', 'show')->select(['is_require'])->first();
@endphp
<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top navbar-dark bg-gradient-x-grey-blue navbar-border navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                {{--                <li class="nav-item"><a class="navbar-brand" href="{{route('biller.dashboard')}}"><img--}}
                {{--                                class="brand-logo"--}}
                {{--                                alt="Brand Logo"--}}
                {{--                                src="{{ Storage::disk('public')->url('app/public/img/company/theme/' . config('core.theme_logo')) }}">--}}

                {{--                    </a></li>--}}
                <li class="nav-item"><a class="navbar-brand" href="{{route('biller.dashboard')}}"><img
                                class="brand-logo"
                                alt="Brand Logo"
                                src="{{ asset('/images/logo.jpg') }}">

                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                                                  data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">

                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                                              href="#"><i class="ft-menu"></i></a></li>
                    @permission('business_settings')
                    <li class="dropdown nav-item mega-dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                   data-toggle="dropdown">{{trans('business.business_admin')}}</a>
                        <ul class="mega-dropdown-menu dropdown-menu row">
                            <li class="col-md-3 col-sm-6">
                                <h6 class="dropdown-menu-header text-uppercase mb-1"><i
                                            class="fa fa-building-o"></i> {{trans('business.general_preference')}}</h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>
                                            <li><a class="dropdown-item" href="{{route('biller.business.settings')}}"><i
                                                            class="ft-feather"></i>{{trans('business.company_settings')}}
                                                </a></li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.settings.localization')}}"><i
                                                            class="fa fa-globe"></i> {{trans('business.business_localization')}}
                                                </a></li>

                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.transactioncategories.index')}}"><i
                                                            class="ft-align-center"></i> {{trans('transactioncategories.transactioncategories')}}
                                                </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.settings.status')}}"><i
                                                            class="fa fa-flag-o"></i> {{trans('meta.default_status')}}
                                                </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.countries.index')}}"><i
                                                            class="fa fa-flag-o"></i> {{trans('meta.countries')}}
                                                </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.taxes.index')}}"><i
                                                            class="fa fa-flag-o"></i> {{trans('meta.taxes')}}
                                                </a></li>
                                            <!-- <li><a class="dropdown-item" href="{{route('biller.subtaxes.index')}}"><i
                                                            class="fa fa-flag-o"></i> {{trans('meta.subtaxes')}}
                                                </a></li> -->
                                            <!-- <li><a class="dropdown-item" href="{{route('biller.units.index')}}"><i
                                                            class="fa fa-flag-o"></i> {{trans('meta.units')}}
                                                </a></li> -->
                                            <li><a class="dropdown-item" href="{{route('biller.markets.index')}}"><i
                                                                            class="fa fa-vcard"></i> {{trans('sales_channel.sales_channels')}}
                                                                    </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.settings.business_goals')}}"><i
                                                        class="fa fa-bullseye"></i> {{trans('en.goal_settings')}}
                                                </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-md-3 col-sm-6">
                                <h6 class="dropdown-menu-header text-uppercase"><i
                                            class="fa fa-random"></i> {{trans('business.billing_settings')}}</h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.settings.billing_preference')}}"><i
                                                            class="fa fa-files-o"></i> {{trans('business.billing_settings_preference')}}
                                                </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.additionals.index')}}"><i
                                                            class="fa fa-floppy-o"></i> {{trans('business.tax_management')}}
                                                </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.discounts.index')}}"><i
                                                        class="fa fa-floppy-o"></i> {{trans('business.discount_management')}}
                                                </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.prefixes.index')}}"><i
                                                            class="fa fa-bookmark-o"></i> {{trans('business.prefix_management')}}
                                                </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.terms.index')}}"><i
                                                            class="fa fa-gavel"></i> {{trans('business.terms_management')}}
                                                </a></li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.settings.pos_preference')}}"><i
                                                            class="fa fa-shopping-cart"></i> {{trans('pos.preference')}}
                                                </a></li>

                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="col-md-3 col-sm-6">
                                <h6 class="dropdown-menu-header text-uppercase mb-1"><i
                                            class="fa fa-building-o"></i> {{trans('business.settings')}}</h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>
                                            <li><a class="dropdown-item" href="{{route('biller.settings.all')}}"><i
                                                            class="ft-feather"></i>{{trans('business.all')}}
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{route('biller.role.index')}}"><i
                                                            class="ft-feather"></i>{{trans('hrms.roles')}}
                                                </a>
                                            </li>

                                            <li><a class="dropdown-item" href="{{route('biller.hrms.get.roles')}}"><i
                                                            class="ft-feather"></i>{{trans('hrms.permissions')}}
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="col-md-3 col-sm-6">
                                <h6 class="dropdown-menu-header text-uppercase"><i
                                            class="fa fa-money"></i> {{trans('business.payment_account_settings')}}
                                </h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.settings.payment_preference')}}"><i
                                                            class="fa fa-credit-card"></i> {{trans('business.payment_preferences')}}
                                                </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.currencies.index')}}"><i
                                                            class="fa fa-money"></i> {{trans('business.currency_management')}}
                                                </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.banks.index')}}"><i
                                                            class="ft-server"></i> {{trans('business.bank_accounts')}}
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.usergatewayentries.index')}}"><i
                                                            class="fa fa-server"></i> {{trans('usergatewayentries.usergatewayentries')}}
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{route('biller.settings.accounts')}}"><i
                                                            class="ft-compass"></i> {{trans('business.accounts_settings')}}
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{route('biller.screens.index')}}"><i
                                                            class="ft-compass"></i> {{trans('business.create_screens')}}
                                                </a>
                                            </li>

                                            <li>&nbsp;</li>

                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-md-3 col-sm-6">
                                <h6 class="dropdown-menu-header text-uppercase"><i
                                            class="ft-at-sign"></i> {{trans('business.communication_settings')}}</h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.business.email_sms_settings')}}"><i
                                                            class="ft-minimize-2"></i> {{trans('meta.email_sms_settings')}}
                                                </a></li>

                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.settings.notification_email')}}"><i
                                                            class="ft-activity"></i> {{trans('meta.notification_email')}}
                                                </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.templates.index')}}"><i
                                                            class="fa fa-comments"></i> {{trans('templates.manage')}}
                                                </a></li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.settings.currency_exchange')}}"><i
                                                            class="fa fa-retweet"></i> {{trans('currencies.currency_exchange')}}
                                                </a></li>


                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-md-3 col-sm-6">
                                <h6 class="dropdown-menu-header text-uppercase"><i
                                            class="fa fa-random"></i> {{trans('business.miscellaneous_settings')}}</h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.customfields.index')}}"><i
                                                            class="ft-anchor"></i> {{trans('customfields.customfields')}}
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.productvariables.index')}}"><i
                                                            class="ft-package"></i> {{trans('business.product_units')}}
                                                </a></li>
                                                <li><a class="dropdown-item" href="{{route('biller.settings.security_settings')}}"><i
                                                        class="fa fa-user-secret"></i> {{trans('en.security_and_setting')}}
                                                </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-md-3 col-sm-6">
                                <h6 class="dropdown-menu-header text-uppercase"><i
                                            class="fa fa-cogs"></i> {{trans('business.advanced_settings')}}</h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>
                                        <li><a class="dropdown-item" href="{{route('biller.settings.manage_api')}}"><i
                                                    class="fa fa-bullseye"></i> API Integration
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{route('biller.cron')}}"><i
                                                        class="fa fa-terminal"></i> {{trans('meta.cron')}}
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{route('biller.settings.activities')}}"><i
                                                class="fa fa-list-ol"></i> {{trans('en.application_log')}}
                                            </a>
                                        </li>
<!-- {{--                                            <li><a class="dropdown-item" href="{{route('biller.web_update_wizard')}}"><i--}}
{{--                                                            class="fa fa-magic"></i> {{trans('update.web_updater')}}--}}
{{--                                                </a></li>--}} -->

                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-md-3 col-sm-6">
                                <h6 class="dropdown-menu-header text-uppercase"><i
                                            class="fa fa-asterisk"></i> {{trans('business.crm_hrm_settings')}}</h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>

                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.settings.crm_hrm_section')}}"><i
                                                            class="fa fa-indent"></i> {{trans('meta.self_attendance')}}
                                                </a></li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.settings.crm_hrm_section')}}"><i
                                                            class="fa fa-key"></i> {{trans('meta.customer_login')}}
                                                </a>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-md-3 col-sm-6">
                                <h6 class="dropdown-menu-header text-uppercase"><i
                                            class="fa fa-camera-retro"></i> {{trans('business.visual_settings')}}</h6>
                                <ul>
                                    <li class="menu-list">
                                        <ul>


                                            <li><a class="dropdown-item" href="{{route('biller.settings.theme')}}"><i
                                                            class="fa fa-columns"></i> {{trans('meta.employee_panel_theme')}}
                                                </a></li>
                                            <li><a class="dropdown-item" href="{{route('biller.about')}}"><i
                                                            class="fa fa-info-circle"></i> {{trans('update.about_system')}}
                                                </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            </li>
                                <li class="col-md-3 col-sm-6">
                                        <h6 class="dropdown-menu-header text-uppercase"><i
                                                class="fa fa-plug"></i> Plugins</h6>
                                        <ul>
                                            <li class="menu-list">
                                                <ul>

                            {{rose_plugins_checker()}}

                                                </ul>
                                            </li>
                                        </ul>
                            </li>
                        </ul>
                    </li>
                    @endauth
                    @permission('pos')
                    <li class="nav-item ">
                        <a href="{{route('biller.invoices.pos')}}" class="btn  btn-success round mt_6">
                            <i class="ficon ft-shopping-cart"></i>{{trans('pos.pos')}} </a></li>
                    <li class="nav-item ">
                        <a href="{{route('biller.invoices.delivery')}}" class="btn  btn-success round mt_6">
                            <i class="ficon ft-shopping-cart"></i>{{trans('delivery.delivery')}} </a></li>
                    @endauth
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                    class="ficon ft-maximize"></i></a></li>

                    <li class="dropdown">
                        <a href="#" class="nav-link " data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            <i class="ficon ft-toggle-left"></i> </a>
                        <ul class="dropdown-menu lang-menu" role="menu">
                            <li class="dropdown-item"><a href="{{route('direction',['ltr'])}}"><i
                                            class="ficon ft-layout"></i> {{trans('meta.ltr')}}</a></li>
                            <li class="dropdown-item"><a href="{{route('direction',['rtl'])}}"><i
                                            class="ficon ft-layout"></i> {{trans('meta.rtl')}}</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav float-right">
                    @if (config('locale.status') && count(config('locale.languages')) > 1)
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ trans('menus.language-picker.language') }}
                                <span class="caret"></span>
                            </a>


                            @include('includes.partials.lang_focus')
                        </li>
                    @endif

                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                                                                           data-toggle="dropdown"
                                                                           onclick="loadNotifications()"><i
                                    class="ficon ft-bell"></i><span
                                    class="badge badge-pill badge-danger badge-up"
                                    id="n_count">{{ auth()->user()->unreadNotifications->count() }}</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" id="user_notifications">

                        </ul>
                    </li>
                    <li class="dropdown dropdown-notification nav-item">
                        {{--                        <a class="nav-link nav-link-label" href="#"--}}
                        {{--                                                                           data-toggle="dropdown">@if(session('clock', false))--}}
                        {{--                                <i--}}
                        {{--                                        class="ficon ft-clock spinner"></i>--}}
                        {{--                                <span--}}
                        {{--                                        class="badge badge-pill badge-info badge-up">{{trans('general.on') }}</span>--}}
                        {{--                            @else--}}
                        {{--                                <i--}}
                        {{--                                        class="ficon ft-clock"></i>--}}
                        {{--                                <span--}}
                        {{--                                        class="badge badge-pill badge-danger badge-up"> {{trans('general.off') }}</span>--}}
                        {{--                            @endif--}}
                        {{--                        </a>--}}
                        {{--                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">--}}

                        {{--                            <li class="scrollable-container media-list">--}}
                        {{--                                <div class="media">--}}

                        {{--                                    <div class="media-body text-center">--}}
                        {{--                                        @if(!session('clock', false)) <a href="{{route('biller.clock')}}"--}}
                        {{--                                                                         class="btn btn-success"><i--}}
                        {{--                                                    class="ficon ft-clock spinner"></i> {{trans('hrms.clock_in') }}</a>--}}
                        {{--                                        @else--}}
                        {{--                                            <a href="{{route('biller.clock')}}" class="btn btn-secondary"><i--}}
                        {{--                                                        class="ficon ft-clock"></i> {{trans('hrms.clock_out') }}</a>--}}
                        {{--                                        @endif--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            </li>--}}

                        {{--                        </ul>--}}
                        <a href="{{route('biller.hrms.attendanceView')}}">
                            <!-- <img src="" alt="Girl in a jacket" > -->

                            <span style="position: relative;
    display: inline-block;
    width: 30px;
     margin: 7px;
    white-space: nowrap;"><img style="width: 100%;max-width: 100%;height: auto;border: 0 none;border-radius: 1000px;"
                               src="{{ asset('/images/attendance.jfif') }}"
                               alt=""><i></i></span>
                            {{--    {{ trans('hrms.attendance_and_eparture') }}  --}}

                        </a>
                        {{--                        @include("focus.modal.pos_attendance_modal")--}}

                    </li>
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label"
                                                                           href="{{route('biller.messages')}}"><i
                                    class="ficon ft-mail"></i><span
                                    class="badge badge-pill badge-warning badge-up">{{Auth::user()->newThreadsCount()}}</span></a>

                    </li>
                    @php $branches = App\Models\Company\Branch::where('id', '<>', auth()->user()->branch_id)->get(); @endphp
                    <li class="dropdown dropdown-user nav-item">
                        <div class="dropdown">

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($branches as $branch)
                                <form action="{{route('biller.update.user.branch', $branch->id)}}" method="POST">
                                    {{csrf_token()}}

                                    <input type="hidden" name="branch_id" value="{{$branch->id}}">

                                    <a href="#branch" data-toggle="modal" data-remote="false"
                                               class="dropdown-item branch" style="padding:5px"
                                               >{{$branch->name}}</a>
                                    <input type="submit">
                                </form>
                        @endforeach

                            </div>
                        </div>
                    </li>


                <div class="dropdown">
                    <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                        <span class="avatar avatar-online">
                        </span>
                        <span class="user-name">الفروع</span>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        @foreach($branches as $branch)
                            <li role="presentation" style="padding: 10px 20px;width: auto;font-weight: bold;cursor: pointer;"><a role="menuitem" tabindex="-1" href="{{ route('biller.update.user.branch', $branch->id) }}">{{ $branch->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link"
                                                                   href="#" data-toggle="dropdown"><span
                                        class="avatar avatar-online">
                                    <img
                                        src="{{ Storage::disk('public')->url('app/public/img/users/' . @$logged_in_user->picture) }}"
                                        alt="">
                                        <i></i>
                                    </span>
                                    <span class="user-name">{{ $logged_in_user->name }}</span>
                                </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item"
                                                                          href="{{ route('biller.profile') }}"><i
                                        class="ft-user"></i> {{ trans('navs.frontend.user.account')}}</a><a
                                    class="dropdown-item" href="{{route('biller.messages')}}"><i class="ft-mail"></i> My
                                Inbox</a>
                                <a
                                    class="dropdown-item" href="{{route('biller.todo')}}"><i
                                        class="ft-check-square"></i>
                                {{ trans('general.tasks')}}</a>

                                <a class="dropdown-item" href="{{route('biller.attendance')}}">
                                    <i class="ft-activity"></i>
                                    {{ trans('hrms.attendance')}}
                                </a>


                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('biller.logout') }}"><i
                                        class="ft-power"></i> {{  trans('navs.general.logout') }}</a>


                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border"
     role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <!-- include ../../../includes/mixins-->
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="dropdown nav-item"><a
                        class="nav-link {{ (strpos(Route::currentRouteName(), 'biller.dashboard') === 0) ? 'active' : '' }}"
                        href="{{route('biller.dashboard')}}"><i
                            class="ft-home"></i><span>{{  trans('navs.frontend.dashboard') }}</span></a>
            </li>
            @if(access()->allow('invoice-manage') || access()->allow('quote-quote'))
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="icon-basket"></i><span>{{trans('features.sales')}}</span></a>
                    <ul class="dropdown-menu">
                        @permission('invoice-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-layout"></i> {{ trans('invoices.management') }}</a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="{{route( 'biller.invoices.index' ) }}"
                                       data-toggle="dropdown"><i
                                                class="ft-file-text"></i> {{ trans('labels.backend.invoices.management') }}
                                    </a>
                                </li>
                                @permission('invoice-create')
                                <li><a class="dropdown-item" href="{{ route( 'biller.invoices.create' ) }}"
                                       data-toggle="dropdown"><i
                                                class="fa fa-plus-circle"></i> {{ trans('labels.backend.invoices.create') }}
                                    </a>
                                </li> @endauth
                                <li><a class="dropdown-item" href="{{route( 'biller.invoices.index' ) }}?md=pos"
                                       data-toggle="dropdown"><i
                                                class="ft-zap"></i> {{ trans('labels.backend.invoices.pos_management') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endauth
                        @permission('quote-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-phone-outgoing"></i> {{ trans('quotes.management') }}</a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="{{ route( 'biller.quotes.index' ) }}"
                                       data-toggle="dropdown"><i
                                                class="ft-file-text"></i> {{ trans('quotes.management') }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route( 'biller.quotes.create' ) }}"
                                       data-toggle="dropdown"><i
                                                class="fa fa-plus-circle"></i> {{ trans('labels.backend.quotes.create') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endauth
                        @permission('invoice-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-umbrella"></i> {{ trans('invoices.subscriptions') }}</a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="{{route( 'biller.invoices.index')}}?md=sub"
                                       data-toggle="dropdown"><i
                                                class="ft-file-text"></i> {{ trans('invoices.subscriptions')}}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route( 'biller.invoices.create' ) }}?sub=true"
                                       data-toggle="dropdown"><i
                                                class="fa fa-plus-circle"></i> {{ trans('invoices.create_subscription') }}
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endauth

                        @permission('creditnote-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-phone-outgoing"></i> {{ trans('orders.credit_notes') }}</a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item"
                                       href="{{route( 'biller.orders.index' )}}?section=creditnote"
                                       data-toggle="dropdown"><i
                                                class="ft-file-text"></i> {{ trans('orders.credit_notes_manage')}}
                                    </a>
                                </li>
                                @permission('data-creditnote')
                                <li><a class="dropdown-item"
                                       href="{{ route( 'biller.orders.create' )}}?section=creditnote"
                                       data-toggle="dropdown"><i
                                                class="fa fa-plus-circle"></i> {{ trans('orders.credit_notes_create') }}
                                    </a>
                                </li>
                                @endauth
                            </ul>
                        </li>
                        @endauth

                        @permission('invoice-manage')
                            @if( $orderedSupply_show && $orderedSupply_show->is_require == 1)
                                <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                            class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                class="ft-layout"></i> {{ trans('orderedSupply.management') }}</a>
                                    <ul class="dropdown-menu">

                                        <li><a class="dropdown-item" href="{{route( 'biller.orderedSupply.index' ) }}"
                                            data-toggle="dropdown"><i
                                                        class="ft-file-text"></i> {{ trans('labels.backend.orderedSupply.management') }}
                                            </a>
                                        </li>
                                        @permission('invoice-create')
                                        <li><a class="dropdown-item" href="{{ route( 'biller.orderedSupply.create' ) }}"
                                            data-toggle="dropdown"><i
                                                        class="fa fa-plus-circle"></i> {{ trans('labels.backend.orderedSupply.create') }}
                                            </a>
                                        </li> @endauth
                                    </ul>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </li>
            @endif
            @if(access()->allow('manage-customer') || access()->allow('manage-customergroup'))
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="icon-diamond"></i><span>{{trans('features.crm')}}</span></a>
                    <ul class="dropdown-menu">
                        @permission('manage-customer')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-users"></i></i> {{ trans('labels.backend.customers.management') }}</a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="{{ route( 'biller.customers.index' ) }}"
                                       data-toggle="dropdown"><i
                                                class="ft-list"></i> {{ trans('labels.backend.customers.management') }}
                                    </a>
                                </li>
                                @permission('customer-create')
                                <li><a class="dropdown-item" href="{{ route( 'biller.customers.create' ) }}"
                                       data-toggle="dropdown"><i
                                                class="fa fa-plus-circle"></i> {{ trans('labels.backend.customers.create') }}
                                    </a>
                                </li>
                                @endauth
                            </ul>
                        </li>
                        @endauth
                        @permission('manage-customergroup')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-grid"></i></i> {{ trans('labels.backend.customergroups.management') }}
                            </a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="{{ route( 'biller.customergroups.index' ) }}"
                                       data-toggle="dropdown"><i
                                                class="ft-list"></i> {{ trans('labels.backend.customergroups.management') }}
                                    </a>
                                </li>
                                @permission('create-customergroup')
                                <li><a class="dropdown-item" href="{{ route( 'biller.customergroups.create' ) }}"
                                       data-toggle="dropdown"><i
                                                class="fa fa-plus-circle"></i> {{ trans('labels.backend.customergroups.create') }}
                                    </a>
                                </li>
                                @endauth
                            </ul>
                        </li>
                        @endauth

                    </ul>
                </li>
            @endif
            @if(access()->allow('product-manage') || access()->allow('purchaseorder-manage') || access()->allow('manage-warehouse') || access()->allow('supplier-manage'))
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="ft-layers"></i><span>{{trans('features.stock')}}</span></a>
                    <ul class="dropdown-menu">

                        @permission('product-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa fa-cube"></i> {{ trans('labels.backend.products.management') }}</a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="{{ route( 'biller.products.index' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="ft-list"></i> {{ trans('labels.backend.products.management') }}
                                    </a>
                                </li>

                                @permission('product-create')
                                <li><a class="dropdown-item" href="{{ route( 'biller.products.create' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="fa fa-plus-circle"></i> {{ trans('labels.backend.products.create') }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route( 'biller.product-variables.create' ) }}"
                                        data-toggle="dropdown"> <i
                                                class="fa fa-plus-circle"></i> {{ trans('labels.backend.productVariables.create') }}
                                    </a>
                                </li>
                                @endauth
                            </ul>
                        </li>
                        @endauth

                        @permission('purchaseorder-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa fa-clipboard"></i> {{ trans('purchaseorders.management') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route( 'biller.purchaseorders.index' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="ft-list"></i> {{ trans('purchaseorders.management') }}
                                    </a>
                                </li>
                                @permission('purchaseorder-data')
                                <li><a class="dropdown-item" href="{{ route( 'biller.purchaseorders.create' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="fa fa-plus-circle"></i> {{ trans('labels.backend.purchaseorders.create') }}
                                    </a>
                                </li>
                                @endauth
                            </ul>
                        </li>
                        @endauth


                        @permission('productcategory-manage')

                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa fa-object-ungroup"></i> {{ trans('labels.backend.productcategories.management') }}
                            </a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="{{ route( 'biller.productcategories.index' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="ft-list"></i> {{ trans('labels.backend.productcategories.management') }}
                                    </a>
                                </li>
                                @permission('productcategory-data')
                                <li><a class="dropdown-item" href="{{ route( 'biller.productcategories.create' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="fa fa-plus-circle"></i> {{ trans('labels.backend.productcategories.create') }}
                                    </a>
                                </li> @endauth

                            </ul>
                        </li>
                        @endauth
                        @permission('manage-warehouse')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa fa-building-o"></i> {{ trans('labels.backend.warehouses.management') }}
                            </a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="{{ route( 'biller.warehouses.index' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="ft-list"></i> {{ trans('labels.backend.warehouses.management') }}
                                    </a>
                                </li>
                                @permission('warehouse-data')
                                <li><a class="dropdown-item" href="{{ route( 'biller.warehouses.create' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="fa fa-plus-circle"></i> {{ trans('labels.backend.warehouses.create') }}
                                    </a>
                                </li>
                                @endauth
                            </ul>
                        </li>
                        @endauth
                        @permission('supplier-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-target"></i> {{ trans('suppliers.management') }}
                            </a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="{{ route( 'biller.suppliers.index' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="ft-list"></i> {{ trans('suppliers.management') }}
                                    </a>
                                </li>
                                @permission('supplier-data')
                                <li><a class="dropdown-item" href="{{ route( 'biller.suppliers.create' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="fa fa-plus-circle"></i> {{ trans('labels.backend.suppliers.create') }}
                                    </a>
                                </li>
                                @endauth
                            </ul>
                        </li>
                        @endauth
                        @permission('stockreturn-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa fa-puzzle-piece"></i> {{ trans('orders.stock_returns') }}</a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item"
                                       href="{{route( 'biller.orders.index' )}}?section=stockreturn"
                                       data-toggle="dropdown"><i
                                                class="ft-file-text"></i> {{ trans('orders.stock_return_manage')}}
                                    </a>
                                </li>
                                @permission('stockreturn-data')
                                <li><a class="dropdown-item"
                                       href="{{ route( 'biller.orders.create' )}}?section=stockreturn"
                                       data-toggle="dropdown"><i
                                                class="fa fa-plus-circle"></i> {{ trans('orders.stock_return_create') }}
                                    </a>
                                </li>
                                @endauth
                            </ul>
                        </li>
                        @endauth
                        @permission('creditnote-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-phone-outgoing"></i> {{ trans('orders.stock_return_customer') }}</a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item"
                                       href="{{route( 'biller.orders.index' )}}?section=creditnote"
                                       data-toggle="dropdown"><i
                                                class="ft-file-text"></i> {{ trans('orders.credit_notes_manage')}}
                                    </a>
                                </li>
                                @permission('data-creditnote')
                                <li><a class="dropdown-item"
                                       href="{{ route( 'biller.orders.create' )}}?section=creditnote"
                                       data-toggle="dropdown"><i
                                                class="fa fa-plus-circle"></i> {{ trans('orders.credit_notes_create') }}
                                    </a>
                                </li> @endauth
                            </ul>
                        </li>
                        @endauth
                        @permission('product-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa fa-barcode"></i> {{ trans('products.product_label_print') }}
                            </a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="{{route( 'biller.products.product_label' )}}"
                                       data-toggle="dropdown"> <i
                                                class="ft-list"></i> {{ trans('products.product_label_print') }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{route( 'biller.products.standard' )}}"
                                       data-toggle="dropdown"> <i
                                                class="ft-list"></i> {{ trans('products.standard_sheet') }}
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @endauth
                        @permission('stocktransfer')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item " href="{{route( 'biller.products.stock_transfer' )}}"><i
                                        class="ft-wind"></i> {{ trans('products.stock_transfer') }}</a>

                        </li> @endauth

                    </ul>
                </li>

            @endif

            @if(access()->allow('transaction-manage') || access()->allow('account-manage') || $shared ['is_screens'])
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="icon-calculator"></i><span>{{trans('general.finance')}}</span></a>
                    <ul class="dropdown-menu">
                        @permission('account-manage')
                            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                        class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                            class="fa fa-book"></i> {{ trans('labels.backend.accounts.management') }}
                                </a>
                                <ul class="dropdown-menu">

                                    <li><a class="dropdown-item" href="{{ route( 'biller.accounts.index' ) }}"
                                        data-toggle="dropdown"> <i
                                                    class="ft-list"></i> {{ trans('labels.backend.accounts.management') }}
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item"
                                        href="{{ route( 'biller.accounts.balance_sheet',['v']) }}"
                                        data-toggle="dropdown"> <i
                                                    class="fa fa-columns"></i> {{ trans('accounts.balance_sheet') }}</a>
                                    </li>
                                    @permission('account-data')
                                    <li><a class="dropdown-item" href="{{ route( 'biller.accounts.create' ) }}"
                                        data-toggle="dropdown"> <i
                                                    class="fa fa-plus-circle"></i> {{ trans('labels.backend.accounts.create') }}
                                        </a>
                                    </li>
                                    @endauth
                                </ul>
                            </li>
                        @endauth
                        @permission('transaction-manage')
                            <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                        class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                            class="fa fa-hdd-o"></i> {{ trans('labels.backend.transactions.management') }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route( 'biller.transactions.index' ) }}"
                                        data-toggle="dropdown"> <i
                                                    class="ft-list"></i> {{ trans('labels.backend.transactions.management') }}
                                        </a>
                                    </li>
                                    @permission('transaction-data')
                                    <li><a class="dropdown-item" href="{{ route( 'biller.transactions.create' ) }}"
                                        data-toggle="dropdown"> <i
                                                    class="fa fa-plus-circle"></i> {{ trans('labels.backend.transactions.create') }}
                                        </a>
                                    </li>
                                    @endauth
                                </ul>
                            </li>
                        @endauth
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa fa-hdd-o"></i> {{ trans('general.cost_centers') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route( 'biller.costcenters.all' ) }}"
                                    data-toggle="dropdown"> <i
                                                class="ft-list"></i> {{ trans('general.cost_centers_menu') }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route( 'biller.screens.create' ) }}"
                                    data-toggle="dropdown"> <i
                                                class="ft-list"></i> {{ trans('business.create_screens') }}
                                    </a>
                                </li>
                                <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                        class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                            class="fa fa-hdd-o"></i> {{ trans('general.cost_centers') }}
                                    </a>
                                    @if(isset($shared['screens']))
                                    <ul class="dropdown-menu">
                                        @foreach($shared['screens'] as $screen)
                                            <li><a class="dropdown-item" href="{{ route( 'biller.CostCentersByScreenID', [$screen['id']] ) }}"
                                                data-toggle="dropdown">{{ $screen['name'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa fa-hdd-o"></i> {{ trans('general.opening_balance') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route( 'biller.opening_balance.index' ) }}"
                                    data-toggle="dropdown"> <i
                                                class="ft-list"></i> {{ trans('general.opening_balance_menu') }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route( 'biller.opening_balance.create' ) }}"
                                    data-toggle="dropdown"> <i
                                                class="ft-list"></i> {{ trans('business.create_opening_balance') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
            <!-- @if($shared ['is_screens'])
                @if(access()->allow('transaction-manage') || access()->allow('account-manage'))
                    <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                          data-toggle="dropdown"><span>{{trans('general.cost_centers')}}</span></a>
                        <ul class="dropdown-menu">
                            @foreach($shared ['screens'] as $screen)
                                <li><a class="dropdown-item" href="{{ route( 'biller.CostCentersByScreenID', [$screen['id']] ) }}"
                                       data-toggle="dropdown">{{ $screen['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endif -->
            @if(access()->allow('project-manage') || access()->allow('task-manage'))
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="icon-briefcase"></i><span>{{trans('features.project_tasks')}}</span></a>
                    <ul class="dropdown-menu">
                        @permission('project-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="ft-calendar"></i> {{ trans('labels.backend.projects.management') }}</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route( 'biller.projects.index' ) }}"
                                       data-toggle="dropdown"> <i class="ft-list"></i> {{ trans('projects.projects')}}
                                        <span class="badge badge-sm badge-primary">Beta</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endauth
                        @permission('task-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item" href="{{ route( 'biller.tasks.index' ) }}"><i
                                        class="icon-directions"></i> {{ trans('labels.backend.tasks.management') }}</a>
                        </li>
                        @endauth
                        @permission('misc-manage')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="icon-tag"></i> {{ trans('tags.tag_status') }}</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route( 'biller.miscs.index')}}?module=task"
                                       data-toggle="dropdown"> <i
                                                class="fa fa-compass"></i> {{ trans('tasks.status_management') }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route( 'biller.miscs.create' ) }}?module=task"
                                       data-toggle="dropdown"> <i
                                                class="fa fa-plus-circle"></i> {{ trans('tags.new_status') }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route( 'biller.miscs.index' ) }}"
                                       data-toggle="dropdown"> <i class="fa fa-tags"></i> {{ trans('tags.tags') }}</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route( 'biller.miscs.create' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="fa fa-plus-circle"></i> {{ trans('tags.new') }}
                                    </a>
                                </li>


                            </ul>
                        </li>
                        @endauth

                    </ul>
                </li>
            @endif
            @if(access()->allow('manage-hrm') || access()->allow('department-manage'))
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="icon-badge"></i><span>{{trans('features.hrm')}}</span></a>
                    <ul class="dropdown-menu">
                        @permission('manage-hrm')
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa fa-users"></i> {{ trans('hrms.management') }}</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route( 'biller.hrms.index' ) }}"
                                       data-toggle="dropdown"> <i class="ft-list"></i> {{ trans('hrms.employees') }}</a>
                                </li>

                                <li><a class="dropdown-item" href="{{ route( 'biller.hrms.create' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="fa fa-plus-circle"></i> {{ trans('hrms.create') }}
                                    </a>
                                </li>
                                <!-- <li><a class="dropdown-item" href="{{ route( 'biller.role.index' ) }}"
                                       data-toggle="dropdown"> <i class="ft-pocket"></i> {{ trans('hrms.roles') }}</a>
                                </li> -->
                            </ul>
                        </li>
                        @endauth
                        @permission('department-manage')
                        <li><a class="dropdown-item" href="{{ route( 'biller.departments.index' ) }}"
                               data-toggle="dropdown"> <i
                                        class="ft-list"></i> {{ trans('departments.departments') }}</a>
                        </li>

                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa fa-money"></i> {{ trans('hrms.payroll') }}</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route( 'biller.hrms.index' ) }}?rel_type=3"
                                       data-toggle="dropdown"> <i class="ft-list"></i> {{ trans('hrms.payroll') }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route( 'biller.hrms.payroll' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="fa fa-plus-circle"></i> {{ trans('hrms.payroll_entry') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a
                                    class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><i
                                        class="fa ft-activity"></i> {{ trans('hrms.attendance') }}</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route( 'biller.hrms.attendance_list' ) }}"
                                       data-toggle="dropdown"> <i class="ft-list"></i> {{ trans('hrms.attendance') }}
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route( 'biller.hrms.attendance' ) }}"
                                       data-toggle="dropdown"> <i
                                                class="fa fa-plus-circle"></i> {{ trans('hrms.attendance_add') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endauth
                    </ul>
                </li>
            @endif
            @if(access()->allow('note-manage') || access()->allow('manage-event'))
                <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
                                                                      data-toggle="dropdown"><i
                                class="icon-star"></i><span>{{trans('features.misc')}}</span></a>
                    <ul class="dropdown-menu">
                        @permission('note-manage')
                        <li><a class="dropdown-item"
                               href="{{route('biller.notes.index')}}"
                               data-toggle="dropdown"><i
                                        class="icon-note"></i> {{trans('general.notes')}}</a>
                        </li>
                        @endauth
                        @permission('manage-event')
                        <li><a class="dropdown-item"
                               href="{{route('biller.events.index')}}"
                               data-toggle="dropdown"><i
                                        class="icon-calendar"></i> {{trans('features.calendar')}}</a>
                        </li>
                        @endauth

                    </ul>
                </li>
            @endif
            @permission('reports-statements')

            <li class="dropdown mega-dropdown nav-item" data-menu="megamenu"><a class="dropdown-toggle nav-link"
                                                                                href="#" data-toggle="dropdown"><i
                            class="icon-pie-chart"></i><span>{{trans('features.reports')}}</span></a>
                <ul class="mega-dropdown-menu dropdown-menu row">
                    <li class="col-md-3" data-mega-col="col-md-3">
                        <ul class="drilldown-menu">
                            <li class="menu-list">
                                <ul class="mega-menu-sub">
                                    <li class="nav-item text-bold-600 ml-1 text-info p-1">{{trans('meta.statements')}}
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i
                                                    class="fa fa-book"></i>{{trans('meta.finance_account_statement')}}
                                        </a>
                                        <ul class="mega-menu-sub">

                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['account'])}}"
                                                ><i class="icon-doc"></i> {{trans('meta.finance_account_statement')}}
                                                </a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['income'])}}"
                                                ><i class="icon-doc"></i> {{trans('meta.income_statement')}}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['expense'])}}"
                                                ><i class="icon-doc"></i> {{trans('meta.expense_statement')}}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['pos_statement'])}}"
                                                ><i class="icon-doc"></i> {{trans('meta.pos_statement')}}</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li><a
                                                class="dropdown-item" href="#"><i
                                                    class="fa fa-smile-o"></i>{{trans('customers.customer')}}</a>
                                        <ul class="mega-menu-sub">

                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['customer'])}}"
                                                   data-toggle="dropdown">{{trans('meta.customer_statements')}}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['product_customer_statement'])}}"
                                                   data-toggle="dropdown">{{trans('meta.product_customer_statement')}}</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li><a
                                                class="dropdown-item" href="#"><i
                                                    class="fa fa-truck"></i>{{trans('suppliers.supplier')}}</a>
                                        <ul class="mega-menu-sub">


                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['supplier'])}}"
                                                   data-toggle="dropdown">{{trans('meta.supplier_statements')}}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['product_supplier_statement'])}}"
                                                   data-toggle="dropdown">{{trans('meta.product_supplier_statement')}}</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li><a
                                                class="dropdown-item" href="#"><i
                                                    class="icon-doc"></i>{{trans('meta.tax_statements')}}</a>
                                        <ul class="mega-menu-sub">

                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['tax'])}}"
                                                   data-toggle="dropdown">{{trans('meta.tax_statements')}} {{trans('meta.sales')}}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['tax'])}}?s=purchase"
                                                   data-toggle="dropdown">{{trans('meta.tax_statements')}}  {{trans('meta.purchase')}}</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li><a
                                                class="dropdown-item" href="#"><i
                                                    class="fa fa-th"></i>{{trans('meta.product_statement')}}</a>
                                        <ul class="mega-menu-sub">
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['product_statement'])}}"
                                                   data-toggle="dropdown">{{trans('meta.product_statement')}}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['product_category_statement'])}}"
                                                   data-toggle="dropdown">{{trans('meta.product_category_statement')}}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['product_warehouse_statement'])}}"
                                                   data-toggle="dropdown">{{trans('meta.product_warehouse_statement')}}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['product_kitchen_warehouse_statement'])}}"
                                                   data-toggle="dropdown">{{trans('meta.product_kitchen_warehouse_statement')}}</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li><a
                                                class="dropdown-item" href="#"><i
                                                    class="fa fa-road"></i>{{trans('products.stock_transfer')}}</a>
                                        <ul class="mega-menu-sub">


                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['stock_transfer'])}}"
                                                   data-toggle="dropdown">{{trans('meta.stock_transfer_statement_warehouse')}}</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="{{route('biller.reports.statements',['stock_transfer_product'])}}"
                                                   data-toggle="dropdown">{{trans('meta.stock_transfer_statement_product')}}</a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="col-md-3" data-mega-col="col-md-3">
                        <ul class="drilldown-menu">
                            <li class="menu-list">
                                <ul class="mega-menu-sub">
                                    <li class="nav-item text-bold-600 ml-1 text-info p-1">{{trans('meta.graphical_reports')}}
                                    </li>
                                    <li data-menu=""><a class="dropdown-item"
                                                        href="{{route('biller.reports.charts',['customer'])}}"><i
                                                    class="fa fa-bar-chart"></i> {{trans('meta.customer_graphical_overview')}}
                                        </a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item"
                                                        href="{{route('biller.reports.charts',['supplier'])}}"><i
                                                    class="fa fa-sun-o"></i> {{trans('meta.supplier_graphical_overview')}}
                                        </a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item"
                                                        href="{{route('biller.reports.charts',['product'])}}"><i
                                                    class="ft-trending-up"></i> {{trans('meta.product_graphical_overview')}}
                                        </a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item"
                                                        href="{{route('biller.reports.charts',['income_vs_expenses'])}}"
                                        ><i
                                                    class="icon-pie-chart"></i> {{trans('meta.income_vs_expenses_overview')}}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="col-md-3" data-mega-col="col-md-3">
                        <ul class="drilldown-menu">
                            <li class="menu-list">
                                <ul class="mega-menu-sub">
                                    <li class="nav-item text-bold-600 ml-1 text-info p-1">{{trans('meta.summary_reports')}}
                                    </li>
                                    <li data-menu=""><a class="dropdown-item"
                                                        href="{{route('biller.reports.summary',['income'])}}"
                                        ><i
                                                    class="ft-check-circle"></i> {{trans('meta.income_summary')}}</a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item"
                                                        href="{{route('biller.reports.summary',['expense'])}}"
                                        ><i
                                                    class="fa fa fa-bullhorn"></i> {{trans('meta.expense_summary')}}</a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item"
                                                        href="{{route('biller.reports.summary',['sale'])}}"
                                        ><i
                                                    class="ft-aperture"></i> {{trans('meta.sale_summary')}}</a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item"
                                                        href="{{route('biller.reports.summary',['purchase'])}}"
                                        ><i
                                                    class="ft-disc"></i> {{trans('meta.purchase_summary')}}</a>
                                    </li>
                                    <li data-menu=""><a class="dropdown-item"
                                                        href="{{route('biller.reports.summary',['products'])}}"
                                        ><i
                                                    class="ft-layers"></i> {{trans('meta.products_summary')}}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="col-md-3" data-mega-col="col-md-3">
                        <ul class="drilldown-menu">
                            <li class="menu-list">
                                <ul class="mega-menu-sub">
                                    <li class="nav-item text-bold-600 ml-1 text-info p-1">{{trans('import.import')}}
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="{{route('biller.import.general',['customer'])}}"
                                        ><i
                                                    class="fa fa-file-excel-o"></i> {{trans('import.import_customers')}}
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="{{route('biller.import.general',['products'])}}"
                                        ><i
                                                    class="fa fa-file-excel-o"></i> {{trans('import.import_products')}}
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="{{route('biller.import.general',['accounts'])}}"
                                        ><i
                                                    class="fa fa-file-excel-o"></i> {{trans('import.import_accounts')}}
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="{{route('biller.import.general',['transactions'])}}"
                                        ><i
                                                    class="fa fa-file-excel-o"></i> {{trans('import.import_transactions')}}
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endauth
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
<!-- END: Main Menu-->
