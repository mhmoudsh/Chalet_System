@extends('admin.layouts.master')
@section('title')
    الصفحة الرئيسية
@endsection
@section('css')
@endsection
@section('sub_title')
    لوحة التحكم
@endsection
@section('title_head')
    ملخص العمليات
@endsection
{{--@section('content')--}}

{{--    <!-- eCommerce statistic -->--}}
{{--    <div class="row">--}}
{{--        <div class="col-xl-3 col-lg-6 col-12">--}}
{{--            <div class="card pull-up">--}}
{{--                <div class="card-content">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="media d-flex">--}}
{{--                            <div class="media-body text-left">--}}
{{--                                <h3 class="info">{{$user_subscriptions->count()}}</h3>--}}
{{--                                <h6>عدد الاشتراكات</h6>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <i class="icon-basket-loaded info font-large-2 float-right"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
{{--                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%"--}}
{{--                                 aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-lg-6 col-12">--}}
{{--            <div class="card pull-up">--}}
{{--                <div class="card-content">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="media d-flex">--}}
{{--                            <div class="media-body text-left">--}}
{{--                                <h3 class="warning">{{$services->count()}}</h3>--}}
{{--                                <h6>عدد الخدمات</h6>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <i class="icon-pie-chart warning font-large-2 float-right"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
{{--                            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%"--}}
{{--                                 aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-lg-6 col-12">--}}
{{--            <div class="card pull-up">--}}
{{--                <div class="card-content">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="media d-flex">--}}
{{--                            <div class="media-body text-left">--}}
{{--                                <h3 class="success">{{$employees->count()}}</h3>--}}
{{--                                <h6>عدد الموظفين</h6>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <i class="icon-user-follow success font-large-2 float-right"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
{{--                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%"--}}
{{--                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-3 col-lg-6 col-12">--}}
{{--            <div class="card pull-up">--}}
{{--                <div class="card-content">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="media d-flex">--}}
{{--                            <div class="media-body text-left">--}}
{{--                                <h3 class="success">{{$users->count()}}</h3>--}}
{{--                                <h6>عدد المشتركين</h6>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <i class="icon-user-following danger font-large-2 float-right"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
{{--                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%"--}}
{{--                                 aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--/ eCommerce statistic -->--}}
{{--    <!-- Products sell and New Orders -->--}}
{{--    <div class="row match-height">--}}
{{--        <div class="col-xl-8 col-12" id="ecommerceChartView">--}}
{{--            <div class="card card-shadow">--}}
{{--                <div class="card-header card-header-transparent py-20">--}}

{{--                </div>--}}
{{--                <div class="widget-content tab-content bg-white p-20">--}}
{{--                    <div class="ct-chart tab-pane active scoreLineShadow" >--}}
{{--                        <div id="line-chart"></div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-4 col-lg-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h4 class="card-title">آخر طلبات الاشتراكات</h4>--}}
{{--                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>--}}
{{--                    <div class="heading-elements">--}}
{{--                        <ul class="list-inline mb-0">--}}
{{--                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <div id="new-orders" class="media-list position-relative">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table id="new-orders-table" class="table table-hover table-xl mb-0">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th class="border-top-0"> المشترك</th>--}}
{{--                                    <th class="border-top-0">الاشتراك</th>--}}
{{--                                    <th class="border-top-0 ">السعر</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($user_subscriptions->take(5) as $user_subscription )--}}
{{--                                    <tr>--}}
{{--                                        <td class="text-truncate">{{$user_subscription->user->name}}</td>--}}
{{--                                        <td class="text-truncate text-warning">{{$user_subscription->subscription->name}}</td>--}}

{{--                                        <td class="text-truncate text-success">{{$user_subscription->price}}</td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}


{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--/ Products sell and New Orders -->--}}
{{--    <!-- Recent Transactions -->--}}
{{--    <div class="row">--}}
{{--        <div id="recent-transactions" class="col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h4 class="card-title">آخر سندات قبض </h4>--}}
{{--                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>--}}
{{--                    <div class="heading-elements">--}}
{{--                        <ul class="list-inline mb-0">--}}
{{--                            <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right"--}}
{{--                                   href="{{route('catch_receipts.index')}}" target="_blank">سندات القبض</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table id="recent-orders" class="table table-hover table-xl mb-0">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th class="border-top-0">رقم السند</th>--}}
{{--                                <th class="border-top-0">اسم المستلم منه</th>--}}
{{--                                <th class="border-top-0">نوع المستلم</th>--}}
{{--                                <th class="border-top-0">تاريخ الاستلام</th>--}}
{{--                                <th class="border-top-0">المجموع</th>--}}

{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($catch_receipts->take(5) as $catch_receipt)--}}


{{--                            <tr>--}}
{{--                                <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1 mr-1"></i>--}}
{{--                                {{$catch_receipt->number}}--}}
{{--                                </td>--}}
{{--                                <td class="text-truncate"><a href="#">--}}
{{--                                        {{isset($catch_receipt->user->name) ? $catch_receipt->user->name : $catch_receipt->employee->name}}</a></td>--}}
{{--                                <td class="text-warning">--}}

{{--                                    {{isset($catch_receipt->user->name) ?  'مشترك': 'موظف'}}--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    <button type="button" class="btn btn-sm btn-outline-danger round">  {{$catch_receipt->date}}</button>--}}
{{--                                </td>--}}

{{--                                <td class="text-truncate">{{$catch_receipt->total}}</td>--}}
{{--                            </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
{{--        <div id="recent-transactions" class="col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h4 class="card-title">آخر سندات صرف </h4>--}}
{{--                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>--}}
{{--                    <div class="heading-elements">--}}
{{--                        <ul class="list-inline mb-0">--}}
{{--                            <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right"--}}
{{--                                   href="{{route('receipts.index')}}" target="_blank">سندات صرف</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-content">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table id="recent-orders" class="table table-hover table-xl mb-0">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th class="border-top-0">رقم السند</th>--}}
{{--                                <th class="border-top-0">اسم المصرف له</th>--}}
{{--                                <th class="border-top-0">نوع المستلم</th>--}}
{{--                                <th class="border-top-0">تاريخ الاستلام</th>--}}
{{--                                <th class="border-top-0">المجموع</th>--}}

{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($receipts->take(5)  as $receipt)--}}


{{--                                <tr>--}}
{{--                                    <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1 mr-1"></i>--}}
{{--                                        {{$receipt->number}}--}}
{{--                                    </td>--}}
{{--                                    <td class="text-truncate"><a href="#">--}}
{{--                                            @if(isset($receipt->user->name))--}}
{{--                                                {{$receipt->user->name}}--}}
{{--                                            @elseif(isset($receipt->employee->name))--}}
{{--                                                {{$receipt->employee->name}}--}}
{{--                                            @else--}}
{{--                                                {{ isset($receipt->expenses->name) ? $receipt->expenses->name :''}}--}}

{{--                                            @endif--}}
{{--                                        </a></td>--}}
{{--                                    <td class="text-warning">--}}
{{--                                    @if(isset($receipt->user->name))--}}
{{--                                        مشترك--}}
{{--                                        @elseif(isset($receipt->employee->name))--}}
{{--                                        موظف--}}
{{--                                        @else--}}
{{--                                        مصروفات--}}
{{--                                    @endif--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <button type="button" class="btn btn-sm btn-outline-danger round">  {{$receipt->date}}</button>--}}
{{--                                    </td>--}}

{{--                                    <td class="text-truncate">{{$receipt->total}}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--/ Recent Transactions -->--}}
{{--    <!--Recent Orders & Monthly Sales -->--}}
{{--    <div class="row match-height">--}}
{{--        <div class="col-xl-12 col-lg-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-content ">--}}
{{--                    <div id="cost-revenue" class="height-250 position-relative"></div>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                    <div class="row mt-1">--}}
{{--                        <div class="col-3 text-center">--}}
{{--                            <h6 class="text-muted">مجموع سندات القبض</h6>--}}
{{--                            <h2 class="block font-weight-normal">{{number_format($catch_receipts->sum('total'),2)}}</h2>--}}
{{--                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
{{--                                <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width:{{$catch_receipts->count() != 0 ? $catch_receipts->sum('total')/$catch_receipts->count() :0}}%"--}}
{{--                                     aria-valuenow="2" aria-valuemin="0" aria-valuemax="50"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3 text-center">--}}
{{--                            <h6 class="text-muted">مجموع سندات الصرف</h6>--}}
{{--                            <h2 class="block font-weight-normal">{{number_format($receipts->sum('total'),2)}}</h2>--}}
{{--                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
{{--                                <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: {{$receipts->count() != 0 ? $receipts->sum('total')/$receipts->count() :0}}%"--}}
{{--                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3 text-center">--}}
{{--                            <h6 class="text-muted">مجموع الاشتراكات</h6>--}}
{{--                            <h2 class="block font-weight-normal">{{number_format($user_subscriptions->sum('price'),2)}}</h2>--}}
{{--                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
{{--                                <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width:{{$user_subscriptions->count() !=0 ?$user_subscriptions->sum('price')/$user_subscriptions->count() :0}}%"--}}
{{--                                     aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-3 text-center">--}}
{{--                            <h6 class="text-muted">الرصيد الإجمالي</h6>--}}
{{--                            <h2 class="block font-weight-normal">{{number_format($catch_receipts->sum('total'),2)}}</h2>--}}
{{--                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">--}}
{{--                                <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width:  {{$catch_receipts->count() != 0  ? $catch_receipts->sum('total')/$catch_receipts->count() :0}}%"--}}
{{--                                     aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-4 col-lg-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-content">--}}
{{--                    <div class="card-body sales-growth-chart">--}}
{{--                        <div id="myChart"  class="height-250"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                    <div class="chart-title mb-1 text-center">--}}
{{--                        <h6>Total monthly Sales.</h6>--}}
{{--                    </div>--}}
{{--                    <div class="chart-stats text-center">--}}
{{--                        <a href="#" class="btn btn-sm btn-danger box-shadow-2 mr-1">Statistics <i--}}
{{--                                class="ft-bar-chart"></i></a>--}}
{{--                        <span class="text-muted">for the last year.</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!--/Recent Orders & Monthly Sales -->--}}


{{--@endsection--}}
@section('scripts')
{{--    <script>--}}

{{--        //line chart--}}
{{--        var line = new Morris.Line({--}}
{{--            element: 'line-chart',--}}
{{--            resize: true,--}}
{{--            data: [--}}
{{--                    @foreach ($statistics_month as $data)--}}
{{--                {--}}
{{--                    ym: "{{ $data->year }}-{{ $data->month }}", sum: "{{ $data->sum }}" //year month--}}
{{--                },--}}
{{--                @endforeach--}}
{{--            ],--}}
{{--            xkey: 'ym',--}}
{{--            ykeys: ['sum'],--}}
{{--            labels: ['@lang('site.total')'],--}}
{{--            lineWidth: 2,--}}
{{--            hideHover: 'auto',--}}
{{--            gridStrokeWidth: 0.4,--}}
{{--            pointSize: 4,--}}
{{--            gridTextFamily: 'Open Sans',--}}
{{--            gridTextSize: 10--}}
{{--        });--}}
{{--    </script>--}}
@endsection
