@extends('admin.layouts.master')
@section('title')
    سندات الصرف
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
    سندات القبض والصرف
@endsection
@section('title_head')
    سندات الصرف
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">بيانات سندات الصرف</h4>
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
                            @can('create_receipts')
                            <a data-toggle="modal" href="#create"
                               data-target="#create" class="btn btn-primary btn-min-width btn-glow mr-1 mb-1">اضافة
                                سند صرف  جديد
                            </a>
                            @endcan
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
                                        <span class="bg-primary text-white">زبون</span>
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

@include('admin.receipts.modals')
    </section>
    <!-- DOM - jQuery events table -->

@endsection
@section('scripts')

    <script src="{{asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"
            type="text/javascript"></script>


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

    <script>


        $('input[type=radio][name=type_user]').change(function() {
            var selectize_user_id = $('#user_id')[0].selectize;


            var selectize_employee_id = $('#employee_id')[0].selectize;
            var selectize_expenses_id = $('#expenses_id')[0].selectize;
            if (this.value == '2') {

                $('#user-div').show();
                $('#user_id').selectize().attr('required',false);
                // $('#invoice_id').attr('required',false);


                $('#employee-div').hide();
                $('#employee_id').selectize().attr('required',true);

                $('#expenses-div').hide();
                $('#expenses_id').selectize().attr('required',false);
                selectize_expenses_id.setValue('0');
                selectize_user_id.setValue('0');
                selectize_employee_id.setValue('0');


                $("#invoice_id").val('');
                $("#price").val('');
                $("#notes").val('');
                $('#paid_total').text('0');
                $('#unpaid_total').text('0');


            }
            else if (this.value == '1') {

                $('#user-div').hide();
                $('#user_id').selectize().attr('required',true);

                // $('#invoice_id').attr('required',true);
                $('#paid_total').text('0');
                $('#unpaid_total').text('0');


                $('#user_id').on('change',function(e){
                    e.preventDefault();
                    var selected_grn_id = $(this).children("option:selected").val();
                    $.ajax({
                        type: "POST",
                        url: "{{route('admin.getInvoiceData')}}",
                        data:{
                            id : selected_grn_id,
                            _token:"{{csrf_token()}}"
                        },
                        success: function(response){
                            $("#invoice_id").empty();
                            if(response.length > 0) {
                                $('#paid_total').text(response);
                                // $("#invoice_id").append(`<option value="">----اختر----</option>`)
                                // response.forEach(el => {
                                //     $("#invoice_id").append(
                                //
                                //         `<option value='${el.id}'> ${el.number}  -  المجموع ${el.total} رقم الفاتورة  </option>`
                                //     )
                                //
                                // })
                            }else {

                                $('#paid_total').text('0');
                                $('#unpaid_total').text('0');

                                // $("#invoice_id").empty();
                                // $("#invoice_id").append(`<option value="">----اختر----</option>`)

                            }

                        },
                        error: function (){
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
                $('#employee_id').selectize().attr('required',false);
                $('#paid_total').text('0');
                $('#unpaid_total').text('0');

                $('#expenses-div').hide();
                $('#expenses_id').selectize().attr('required',false);
                selectize_expenses_id.setValue('0');

                selectize_user_id.setValue('0');

                selectize_employee_id.setValue('0');

                $("#price").val('');
                $("#notes").val('');
            } else {
                $('#user-div').hide();
                $('#user_id').selectize().attr('required',false);
                $('#employee-div').hide();
                $('#employee_id').selectize().attr('required',false);
                $('#paid_total').text('0');
                $('#unpaid_total').text('0');

                $('#expenses-div').show();
                $('#expenses_id').selectize().attr('required',true);
                selectize_expenses_id.setValue('0');

                selectize_user_id.setValue('0');

                selectize_employee_id.setValue('0');

                $("#price").val('');
                $("#notes").val('');
            }
        });



    </script>
@endsection
