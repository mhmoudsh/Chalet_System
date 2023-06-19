@extends('admin.layouts.master')
@section('title')
    تقارير  سندات الصرف
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
    تقارير  سندات الصرف
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

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered sourced-data">

                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>رقم السند</th>
                                            <th>نوع المصرف له</th>
                                            <th>اسم المصرف له</th>
                                            <th>المجموع</th>
                                            <th>تاريخ الاستلام</th>
                                            <th>ملاحظات</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $info)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$info->number}}</td>
                                                <td>
                                                    @if($info->user_id !=null)
                                                        <span class="bg-primary text-white">مشترك</span>
                                                    @elseif($info->employee_id !=null)
                                                        <span class="bg-success text-white">موظف</span>
                                                    @else
                                                        <span class="bg-warning text-white">مصروفات </span>

                                                    @endif
                                                </td>
                                                @if($info->user_id !=null)
                                                    <td>{{$info->user->name}}</td>

                                                @elseif($info->employee_id !=null)

                                                    <td>{{$info->employee->name}}</td>


                                                @else
                                                    <td>{{$info->expenses->name}}</td>


                                                @endif
                                                <td><span class="text-success">{{$info->total}}</span></td>
                                                <td>{{$info->created_at->format('Y-m-d')}}</td>
                                                <td>{{$info->notes}}</td>

                                                <td>
                                                    @can('delete_receipts')
                                                        <a href="#delete" data-id="{{$info->id}}" data-toggle="modal"
                                                           data-target="#delete" class="btn btn-sm btn-danger ">ارشفة</a>
                                                    @endcan
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
                var date = new Date( data[5] );

                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
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
