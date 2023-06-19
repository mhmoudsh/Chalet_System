@extends('admin.layouts.master')
@section('title')
    تقارير  الاشتراكات
@endsection
@section('css')

    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css-rtl/plugins/forms/switch.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">

    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/vendors/css/forms/selects/select2.min.css')}}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">

@endsection
@section('sub_title')
    تقارير
@endsection
@section('title_head')
    تقارير  الاشتراكات
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>من تاريخ</label>
                                    <div class='input-group'>
                                        <input type='text' id="min" name="min" class="form-control " />
                                        <div class="input-group-append">
                            <span class="input-group-text">
                              <span class="la la-calendar"></span>
                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>الى تاريخ</label>
                                    <div class='input-group'>
                                        <input id="max" name="max" type='text' class="form-control " />
                                        <div class="input-group-append">
                            <span class="input-group-text">
                              <span class="la la-calendar"></span>
                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">

                                <div   id="search_ajax"     class="table-responsive">
                                    <table class="table table-striped table-bordered sourced-data">

                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم المشترك</th>
                                            <th>اسم الاشتراك</th>
                                            <th>الحالة</th>
                                            <th>السعر</th>
                                            <th>المدة(شهرياً)</th>
                                            <th>تاريخ البداية</th>
                                            <th>تاريخ الانتهاء</th>
                                            {{--                                    <th> الفاتورة</th>--}}
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $info)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$info->user->name}}</td>
                                                <td>   <span class="bg-primary text-white"> {{$info->subscription->name}}</span></td>

                                                <td>
                                                    @if( $info->status == 1)
                                                        <span class="bg-success text-white">مفعل</span>
                                                    @else
                                                        <span class="bg-danger text-white">منتهي</span>
                                                    @endif

                                                </td>
                                                <td>{{$info->price}}</td>
                                                <td>{{$info->duration}} شهور</td>
                                                <td>{{$info->start_at}}</td>
                                                <td>{{$info->end_at}}</td>
                                                {{--                                        <td>--}}
                                                {{--                                            <a href="#show"  data-service_ids="{{$info->service_ids }}" data-id="{{$info->id}}" data-toggle="modal"--}}
                                                {{--                                               data-target="#show" class="btn btn-sm btn-primary ">عرض</a>--}}
                                                {{--                                        </td>--}}
                                                <td>

                                                    @if($info->status !=2)

                                                        @can('update_user_subscriptions')
                                                            <a href="#edit" data-user_subscription_old_id="{{$info->id}}" data-name_edit="{{$info->user->id}}"
                                                               data-subscription_old_id="{{$info->subscription->id}}"
                                                               data-duration_edit="{{$info->duration}}" data-price_edit="{{$info->price}}"
                                                               data-toggle="modal"
                                                               data-target="#edit" class="btn btn-sm btn-success ">تغيير الاشتراك</a>

                                                        @endcan
                                                        @can('delete_user_subscriptions')
                                                            <a href="#delete" data-user_subscription_old_id="{{$info->id}}" data-user_id="{{$info->user->id}}"
                                                               data-subscription_old_id="{{$info->subscription->id}}"
                                                               data-duration_edit="{{$info->duration}}" data-price_edit="{{$info->price}}" data-toggle="modal"
                                                               data-target="#delete" class="btn btn-sm btn-danger ">انهاء الاشتراك</a>
                                                        @endcan
                                                    @else
                                                        @can('update_user_subscriptions')
                                                            <a href="#edit" data-user_subscription_old_id="{{$info->id}}" data-name_edit="{{$info->user->id}}"
                                                               data-subscription_old_id="{{$info->subscription->id}}"
                                                               data-duration_edit="{{$info->duration}}" data-price_edit="{{$info->price}}"
                                                               data-toggle="modal"
                                                               data-target="#edit" class="btn btn-sm btn-success ">تغيير الاشتراك</a>
                                                        @endcan
                                                        @can('renew_user_subscriptions')
                                                            <a href="#renewal" data-user_subscription_id="{{$info->id}}" data-user_id="{{$info->user->id}}" data-toggle="modal"
                                                               data-target="#renewal" class="btn btn-sm btn-primary ">تجديد الاشتراك</a>
                                                        @endcan
                                                    @endif

                                                </td>
                                            </tr>

                                        @endforeach


                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    </section>
    <!-- DOM - jQuery events table -->

@endsection
@section('scripts')
    <script src="{{asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"
            type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('dashboard/app-assets/js/scripts/tables/datatables/datatable-advanced.js')}}"
            type="text/javascript"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"
            type="text/javascript"></script>


    <script>
        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date( data[6]);
                var date2 = new Date( data[7]);

                if (
                    ( min === null && max === null ) ||
                    ( min === null && date2 <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date2 <= max )
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });     
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });

            // DataTables initialisation
            var table = $('.table').DataTable();

            // Refilter the table
            $('#min, #max').on('change', function () {
                table.draw();
            });
        });
    </script>


    <!-- END PAGE LEVEL JS-->

@endsection
