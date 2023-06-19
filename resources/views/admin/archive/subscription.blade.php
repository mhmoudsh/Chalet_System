@extends('admin.layouts.master')
@section('title')
    الاشتراكات
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
    الاشتراكات المؤرشفة
@endsection
@section('title_head')
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">     الاشتراكات المؤرشفة</h4>
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

                            <div class="table-responsive">
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



                                                    <a href="#delete" data-id="{{$info->id}}" data-name_edit="{{$info->user->id}}"
                                                       data-subscription_old_id="{{$info->subscription->id}}"
                                                       data-duration_edit="{{$info->duration}}" data-price_edit="{{$info->price}}"
                                                       data-toggle="modal"
                                                       data-target="#edit" class="btn btn-sm btn-success "> استعادة</a>



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
            <div class="modal fade text-left" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger white">
                            <h4 class="modal-title white" id="delete">الاستعادة الاشتراك</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('admin.restoreUserSubscription','delete')}}" method="post">
                            @csrf
                            @method('post')
                            <div class="modal-body">
                                <input type="hidden" name="id"  id="id">
                                <h5>هل انت متأكد من عملية الاستعادة ؟</h5>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إالغاء</button>
                                <button type="submit" class="btn btn-outline-danger">استعادة</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- DOM - jQuery events table -->
    <!-- Modal -->

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
            var id_edit = button.data('id_edit')
            var name_edit = button.data('name_edit')
            var subscription_old_id = button.data('subscription_old_id')
            var user_subscription_old_id = button.data('user_subscription_old_id')
            var subscription_edit = button.data('subscription_edit')
            var price_edit = button.data('price_edit')
            var duration_edit = button.data('duration_edit')

            var modal = $(this)
            modal.find('.modal-body #id_edit').val(id_edit);
            modal.find('.modal-body #name_edit').val(name_edit);
            modal.find('.modal-body #user_id').val(name_edit);
            modal.find('.modal-body #subscription_old_id').val(subscription_old_id);
            modal.find('.modal-body #user_subscription_old_id').val(user_subscription_old_id);
            modal.find('.modal-body #subscription_edit').val(subscription_edit);
            modal.find('.modal-body #price_edit').val(price_edit);
            modal.find('.modal-body #duration_edit').val(duration_edit);

            $("#name_edit").select2("val",[name_edit]);
            $("#subscription_edit").select2("val",[subscription_edit]);

        })
    </script>
    <script>

        // Model Delete
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)

            var user_subscription_old_id = button.data('user_subscription_old_id')
            var user_id = button.data('user_id')
            var subscription_old_id = button.data('subscription_old_id')
            var modal = $(this)
            modal.find('.modal-body #user_subscription_old_id2').val(user_subscription_old_id);
            modal.find('.modal-body #user_id2').val(user_id);
            modal.find('.modal-body #subscription_old_id2').val(subscription_old_id);
        })

        // Model Show
        $('#show').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var service_ids = button.data('service_ids')
            var modal = $(this)
            $("#service_ids_show").select2("val", service_ids);
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

        $(document).ready(function () {
            $('#subscription_id').on('change',function(e){
                e.preventDefault();
                var selected_grn_id = $(this).children("option:selected").val();
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.getSubscriptionData')}}",
                    data:{
                        id : selected_grn_id,
                        _token:"{{csrf_token()}}"
                    },
                    success: function(data){
                        if (data['subscription'] ==null){
                            $('#price').val('');
                            $('#duration').val('');
                        }else {
                            $('#price').val(data['subscription']['price']);
                            $('#duration').val(data['subscription']['duration']);
                        }

                    }
                });
            });


            $('#subscription_edit').on('change',function(e){
                e.preventDefault();
                var selected_grn_id = $(this).children("option:selected").val();
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.getSubscriptionData')}}",
                    data:{
                        id : selected_grn_id,
                        _token:"{{csrf_token()}}"
                    },
                    success: function(data){
                        if (data['subscription'] ==null){
                            $('#price_edit').val('');
                            $('#duration_edit').val('');
                        }else {
                            $('#price_edit').val(data['subscription']['price']);
                            $('#duration_edit').val(data['subscription']['duration']);
                        }

                    }
                });
            });
        });
    </script>
    <script !src="">
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }

        var myArray = ['danger', 'primary', 'warning','success'];
        const random = Math.floor(Math.random() * myArray.length);
        console.log(random, myArray[random]);
    </script>
@endsection
