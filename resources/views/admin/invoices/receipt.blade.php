@extends('admin.layouts.master')
@section('title')
    الفواتير الصرف
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
@endsection
@section('sub_title')
    الفواتير
@endsection
@section('title_head')
    الفواتير الصرف
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">بيانات الفواتير</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
{{--                            <a data-toggle="modal" href="#create"--}}
{{--                               data-target="#create" class="btn btn-primary btn-min-width btn-glow mr-1 mb-1">اضافة--}}
{{--                                اشتراك جديد--}}
{{--                            </a>--}}
                            <table class="table table-striped table-bordered sourced-data">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>رقم الفاتورة</th>
                                    <th>حالة الفاتورة</th>
                                    <th>اسم المشترك</th>
                                    <th>المجموع</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $info)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$info->number}}</td>
                                        <td>
                                            @if( $info->status == 1)
                                                <span class="bg-success text-white">مدفوعة</span>

                                            @elseif($info->status == 2)
                                                    <span class="bg-warning text-white">مدفوعة جزئية</span>

                                            @else
                                                <span class="bg-danger text-white">غير مدفوعة</span>
                                            @endif

                                        </td>
                                        <td>{{$info->user_name}}</td>


                                        <td>{{$info->total}}</td>

                                        <td>
                                            <a href="#edit" data-id="{{$info->id}}" data-name="{{$info->name}}"
                                               data-status="{{$info->status}}"
                                               data-service_ids="{{$info->service_ids }}"
                                               data-duration="{{$info->duration}}" data-price="{{$info->price}}"
                                               data-toggle="modal"
                                               data-target="#edit" class="btn btn-sm btn-success ">تسديد </a>
{{--                                            <a href="#delete" data-id="{{$info->id}}" data-toggle="modal"--}}
{{--                                               data-target="#delete" class="btn btn-sm btn-danger ">حذف</a>--}}
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

{{--@include('admin.subscriptions.modals')--}}
    </section>
    <!-- DOM - jQuery events table -->

@endsection
@section('scripts')

    <script src="{{asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"
            type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            $('#mytable').DataTable({

                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/ar.json'
                },

            });


        });
    </script>
    <script src="{{asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('dashboard/app-assets/js/scripts/tables/datatables/datatable-advanced.js')}}"
            type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/toggle/switchery.min.js')}}"
            type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <script src="{{asset('dashboard/app-assets/js/scripts/forms/switch.js')}}" type="text/javascript"></script>

    <script src="{{asset('dashboard/app-assets/vendors/js/forms/toggle/switchery.min.js')}}"
            type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/select/select2.full.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('dashboard/app-assets/js/scripts/forms/select/form-select2.js')}}"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script>
        // Model edit
        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var price = button.data('price')
            var duration = button.data('duration')
            var status = button.data('status')
            var service_ids = button.data('service_ids')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #price').val(price);
            modal.find('.modal-body #duration').val(duration);
            modal.find('.modal-body #service_ids').val(service_ids);
            if (status == 1) {
                $('.status').prop('checked', true)
            } else {
                $('.status').prop('checked', false)
            }
            $("#service_ids").select2("val", service_ids);

        })
    </script>
    <script>

        // Model Delete
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })

        // Model Show
        $('#show').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var service_ids = button.data('service_ids')
            var modal = $(this)
            $("#service_ids_show").select2("val", service_ids);
        })
    </script>

    <script !src="">
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
