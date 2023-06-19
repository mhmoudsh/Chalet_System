@extends('admin.layouts.master')
@section('title')
    الحجوزات
@endsection
@section('css')

    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">

    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/vendors/css/forms/selects/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css-rtl/plugins/forms/switch.css')}}">


    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">


    @section('sub_title')
        الحجوزات
    @endsection
    @section('title_head')
        اضافة حجز جديد
    @endsection
    @section('content')
        <input type="hidden" id="ajax_search_url" name="{{route('admin.subscriptions_search')}}">
        <input type="hidden" id="token_search" value="{{csrf_token()}}">
        <!-- DOM - jQuery events table -->
        <section id="dom">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> اضافة حجز جديد</h4>
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
                                @can('create_user_subscriptions')
                                    <a href="{{route('user_reservations.create')}}"
                                       class="btn btn-primary btn-min-width btn-glow mr-1 mb-1">اضافة
                                        حجز جديد
                                    </a>
                                @endcan
                                <div class="row">
                                    {{--                                <div class="col-2">--}}
                                    {{--                                    <div class="form-group ">--}}

                                    {{--                                        <input type="text"  id="search_by_text" name="search_by_text" class="form-control" placeholder="بحث">--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}


                                    {{--                                <div class="col-2">--}}
                                    {{--                                    <div class="form-group ">--}}
                                    {{--                                        <label class="form-label">حالة الاشتراك</label>--}}
                                    {{--                                        <select name="select-status" id="select-status" style="width: auto" class="form-control  nice-select  custom-select">--}}
                                    {{--                                            <option value="0">--أختر--</option>--}}
                                    {{--                                            <option value="1">مفعل</option>--}}
                                    {{--                                            <option value="2">منتهي</option>--}}



                                    {{--                                        </select>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}

                                </div>

                                <div id="search_ajax" class="table-responsive">
                                    <table class="table table-striped table-bordered sourced-data">

                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم المستخدم</th>
                                            <th>رقم الجوال</th>
                                            <th>الحالة</th>
                                            <th>تاريخ الحجز</th>
                                            <th>نوع الفترة</th>
                                            <th>الوقت</th>
                                            <th>السعر</th>
                                            <th>المبلغ المدفوع</th>
                                            <th>المتبقي</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $info)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$info->user->name}}</td>
                                                <td><span class="bg-primary text-white">{{$info->user->phone}}</span>
                                                </td>

                                                <td>
                                                    @if( $info->status == 1)
                                                        <span class="bg-success text-white">مكتمل الحجز</span>

                                                    @elseif($info->status == 2)
                                                        <span class="bg-primary text-white">حجز مؤكد </span>
                                                    @else
                                                        <span class="bg-danger text-white">حجز أولي</span>
                                                    @endif

                                                </td>
                                                <td>{{$info->date}}</td>
                                                <td>{{isset($info->interval->name) ?  $info->interval->name: "مخصص"}}</td>
                                                <td>{{$info->start_custom_time}} - {{$info->end_custom_time}} </td>
                                                <td>{{$info->manual_price}}</td>
                                                <td><span class="bg-success text-white">{{$info->amount_paid}} </span>
                                                </td>
                                                <td><span
                                                        class="bg-danger text-white">{{ number_format($info->manual_price - $info->amount_paid,2)}} </span>
                                                </td>
                                                <td>


                                                    @can('update_user_subscriptions')
                                                        <a href="{{route('user_reservations.edit',$info->id)}}"
                                                           class="btn btn-sm btn-success ">تعديل</a>

                                                    @endcan
                                                    @can('delete_user_subscriptions')
                                                        <a  href="#delete"  data-id = "{{$info->id}}" data-toggle="modal"
                                                            data-target="#delete" class="btn btn-sm btn-danger ">حذف</a>
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
        <!-- Modal delete -->
        <div class="modal fade text-left" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger white">
                        <h4 class="modal-title white" id="delete">حذف الحجز</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('user_reservations.destroy','delete')}}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">

                            <input type="hidden" name="id" id="id">
                            <h5>هل انت متأكد من عملية حذف الحجز ؟</h5>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إالغاء
                            </button>
                            <button type="submit" class="btn btn-outline-danger">حذف</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>


        <!-- DOM - jQuery events table -->

    @endsection
    @section('scripts')
        <!-- BEGIN PAGE LEVEL JS-->

        <!-- END PAGE LEVEL JS-->
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

        <script src="{{asset('dashboard/app-assets/vendors/js/forms/toggle/switchery.min.js')}}"
                type="text/javascript"></script>


        <script src="{{asset('dashboard/app-assets/vendors/js/forms/select/select2.full.min.js')}}"
                type="text/javascript"></script>
        <script src="{{asset('dashboard/app-assets/js/scripts/forms/select/form-select2.js')}}"
                type="text/javascript"></script>


        <!-- END PAGE LEVEL JS-->
        <script src="{{asset('dashboard/app-assets/js/custom/usersubscriptions.js')}}"
                type="text/javascript"></script>


        <script>

            // Model Delete
            $('#delete').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)


                var id = button.data('id')

                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })


            // Model Show
            $('#renewal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var user_subscription_id = button.data('user_subscription_id')
                var user_id = button.data('user_id')
                var modal = $(this)
                modal.find('.modal-body #user_subscription_id').val(user_subscription_id);
                modal.find('.modal-body #user_id').val(user_id);
            })


        </script>
        <script type="text/javascript">
            $('input[type=radio][name=type_user]').change(function () {
                var selectize_user_id = $('#user_id')[0].selectize;


                var selectize_employee_id = $('#employee_id')[0].selectize;
                var selectize_expenses_id = $('#expenses_id')[0].selectize;
                if (this.value == '2') {

                    $('#user-div').show();
                    $('#user_id').selectize().attr('required', false);
                    // $('#invoice_id').attr('required',false);


                    $('#employee-div').hide();
                    $('#employee_id').selectize().attr('required', true);

                    $('#expenses-div').hide();
                    $('#expenses_id').selectize().attr('required', false);
                    selectize_expenses_id.setValue('0');
                    selectize_user_id.setValue('0');
                    selectize_employee_id.setValue('0');


                    $("#invoice_id").val('');
                    $("#price").val('');
                    $("#notes").val('');
                    $('#paid_total').text('0');
                    $('#unpaid_total').text('0');


                } else if (this.value == '1') {

                    $('#user-div').hide();
                    $('#user_id').selectize().attr('required', true);

                    // $('#invoice_id').attr('required',true);
                    $('#paid_total').text('0');
                    $('#unpaid_total').text('0');


                    $('#user_id').on('change', function (e) {
                        e.preventDefault();
                        var selected_grn_id = $(this).children("option:selected").val();
                        $.ajax({
                            type: "POST",
                            url: "{{route('admin.getInvoiceData')}}",
                            data: {
                                id: selected_grn_id,
                                _token: "{{csrf_token()}}"
                            },
                            success: function (response) {
                                $("#invoice_id").empty();
                                if (response.length > 0) {
                                    $('#paid_total').text(response);
                                    // $("#invoice_id").append(`<option value="">----اختر----</option>`)
                                    // response.forEach(el => {
                                    //     $("#invoice_id").append(
                                    //
                                    //         `<option value='${el.id}'> ${el.number}  -  المجموع ${el.total} رقم الفاتورة  </option>`
                                    //     )
                                    //
                                    // })
                                } else {

                                    $('#paid_total').text('0');
                                    $('#unpaid_total').text('0');

                                    // $("#invoice_id").empty();
                                    // $("#invoice_id").append(`<option value="">----اختر----</option>`)

                                }

                            },
                            error: function () {
                                $('#paid_total').text('0');
                            }
                        });
                    });

                    {{--$('#invoice_id').on('change',function(e){--}}
                    {{--    e.preventDefault();--}}
                    {{--    var selected_grn_id = $(this).children("option:selected").val();--}}
                    {{--    $.ajax({--}}
                    {{--        type: "POST",--}}
                    {{--        url: "{{route('admin.getCatchReceipt')}}",--}}
                    {{--        data:{--}}
                    {{--            user_id :$('#user_id').val() ,--}}
                    {{--            invoice_id : selected_grn_id,--}}
                    {{--            _token:"{{csrf_token()}}"--}}
                    {{--        },--}}
                    {{--        success: function(response){--}}

                    {{--            if(response !=[]) {--}}
                    {{--                $('#paid_total').text(response['amount_paid']);--}}
                    {{--                $('#unpaid_total').text(response['remaining']);--}}
                    {{--            }else {--}}


                    {{--                $('#paid_total').text('0');--}}
                    {{--                $('#unpaid_total').text('0');--}}

                    {{--            }--}}

                    {{--        },--}}
                    {{--        error:function () {--}}
                    {{--            $('#paid_total').text('0');--}}
                    {{--            $('#unpaid_total').text('0');--}}
                    {{--        }--}}
                    {{--    });--}}
                    {{--});--}}
                    $('#employee-div').show();
                    $('#employee_id').selectize().attr('required', false);
                    $('#paid_total').text('0');
                    $('#unpaid_total').text('0');

                    $('#expenses-div').hide();
                    $('#expenses_id').selectize().attr('required', false);
                    selectize_expenses_id.setValue('0');

                    selectize_user_id.setValue('0');

                    selectize_employee_id.setValue('0');

                    $("#price").val('');
                    $("#notes").val('');
                } else {
                    $('#user-div').hide();
                    $('#user_id').selectize().attr('required', false);
                    $('#employee-div').hide();
                    $('#employee_id').selectize().attr('required', false);
                    $('#paid_total').text('0');
                    $('#unpaid_total').text('0');

                    $('#expenses-div').show();
                    $('#expenses_id').selectize().attr('required', true);
                    selectize_expenses_id.setValue('0');

                    selectize_user_id.setValue('0');

                    selectize_employee_id.setValue('0');

                    $("#price").val('');
                    $("#notes").val('');
                }
            });
            $(document).ready(function () {
                $('#subscription_id').on('change', function (e) {
                    e.preventDefault();
                    var selected_grn_id = $(this).children("option:selected").val();
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.getSubscriptionData')}}",
                        data: {
                            id: selected_grn_id,
                            _token: "{{csrf_token()}}"
                        },
                        success: function (data) {
                            if (data['subscription'] == null) {
                                $('#price').val('');
                                $('#duration').val('');
                            } else {
                                $('#price').val(data['subscription']['price']);
                                $('#duration').val(data['subscription']['duration']);
                            }

                        }
                    });
                });


                $('#subscription_edit').on('change', function (e) {
                    e.preventDefault();
                    var selected_grn_id = $(this).children("option:selected").val();
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.getSubscriptionData')}}",
                        data: {
                            id: selected_grn_id,
                            _token: "{{csrf_token()}}"
                        },
                        success: function (data) {
                            if (data['subscription'] == null) {
                                $('#price_edit').val('');
                                $('#duration_edit').val('');
                            } else {
                                $('#price_edit').val(data['subscription']['price']);
                                $('#duration_edit').val(data['subscription']['duration']);
                            }

                        }
                    });
                });
            });
        </script>

    @endsection
