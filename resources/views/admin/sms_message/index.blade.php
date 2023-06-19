@extends('admin.layouts.master')
@section('title')
    الرسائل
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
    الرسائل
@endsection
@section('title_head')
   الرسائل
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">بيانات الرسائل</h4>
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
                            @can('create_services')
                            <a data-toggle="modal" href="#create"
                               data-target="#create" class="btn btn-primary btn-min-width btn-glow mr-1 mb-1">اضافة رسالة
                                جديدة</a>
                            @endcan
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered sourced-data">

                                        <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>محتوى الرسالة</th>
                                    <th>وقت الارسال</th>
                                    <th>العمليات</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $info)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$info->name}}</td>
                                        <td>{{$info->content}}</td>
                                        <td>{{$info->time_sent}}</td>



                                        <td>
                                                @can('delete_services')
                                            <a href="#delete" data-id="{{$info->id}}" data-toggle="modal"
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

        <!-- Modal create -->
        <div class="modal fade text-left" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <label class="modal-title text-text-bold-600" id="myModalLabel33">اضافة فترة زمنية جديدة</label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('MessageSms.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="d-block-flex ">
                                <div class="form-group ">
                                    <label>اسم المستخدم<span class="text-danger">*</span></label>
                                    <br>
                                    <select required class="select2 form-control " name="users[]"
                                            style="width: 470px" multiple="multiple">

                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>

                                        @endforeach


                                    </select>
                                    @error('service_ids')
                                    <span class="text-danger">
                                {{ $message }}
                             </span>
                                    @enderror

                                </div>
                            </div>

                            <label>محتوى الرسالة </label>
                            <div class="form-group">
                                <textarea name="message" required class="form-control"
                                       data-validation-required-message="This field is required"
                                          placeholder="ادخل المحتوى ">{{old('message')}}</textarea>
                            </div>
                            @error('content')
                            <span class="text-danger">
                         {{ $message }}
                         </span>
                            @enderror
                            <label> وقت الارسال (عدد الساعات): </label>
                            <div class="form-group">
                                <input type="number" value="{{old('time_sent')}}" name="time_sent" required class="form-control"
                                       data-validation-required-message="This field is required"
                                       placeholder="ادخل  وقت الارسال ">
                            </div>
                            @error('time_sent')
                            <span class="text-danger">
                         {{ $message }}
                         </span>
                            @enderror



                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إالغاء
                            </button>
                            <button type="submit" class="btn btn-outline-success">اضافة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal edit -->
        <div class="modal fade text-left" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <label class="modal-title text-text-bold-600" id="myModalLabel33">تعديل الخدمة </label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('Intervals.update','update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label>اسم الفترة الزمنية: </label>
                            <div class="form-group">
                                <input type="text" value="{{old('name')}}" name="name" id="name" required class="form-control"
                                       data-validation-required-message="This field is required"
                                       placeholder="ادخل  اسم الفترة الزمنية ">
                            </div>
                            @error('name')
                            <span class="text-danger">
                         {{ $message }}
                         </span>
                            @enderror

                            <label>السعر: </label>
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                                <input type="text" value="{{old('price')}}" name="price" id="price" required class="form-control"
                                       data-validation-required-message="This field is required"
                                       placeholder="ادخل السعر ">
                            </div>
                            @error('price')
                            <span class="text-danger">
                         {{ $message }}
                         </span>
                            @enderror
                            <label>بداية الفترة: </label>
                            <div class="form-group">
                                <input type="time" value="{{old('start_time')}}" name="start_time" id="start_time" required class="form-control"
                                       data-validation-required-message="This field is required"
                                       placeholder="ادخل  بداية الفترة ">
                            </div>
                            @error('start_time')
                            <span class="text-danger">
                         {{ $message }}
                         </span>
                            @enderror


                            <label>نهاية الفترة: </label>
                            <div class="form-group">
                                <input type="time" value="{{old('end_time')}}" name="end_time" id="end_time" required class="form-control"
                                       data-validation-required-message="This field is required"
                                       placeholder="ادخل  نهاية الفترة ">
                            </div>
                            @error('end_time')
                            <span class="text-danger">
                         {{ $message }}
                         </span>
                            @enderror

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إالغاء
                            </button>
                            <button type="submit" class="btn btn-outline-success">تحديث</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal delete -->
        <div class="modal fade text-left" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger white">
                        <h4 class="modal-title white" id="delete">حذف الخدمة</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('MessageSms.destroy','delete')}}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <h5>هل انت متأكد من عملية الحذف ؟</h5>

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
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/select/select2.full.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('dashboard/app-assets/js/scripts/forms/select/form-select2.js')}}"
            type="text/javascript"></script>
    <script>
        // Model edit
        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var price = button.data('price')
            var start_time = button.data('start_time')
            var end_time = button.data('end_time')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #price').val(price);
            modal.find('.modal-body #start_time').val(start_time);
            modal.find('.modal-body #end_time').val(end_time);

            // if(status == 1){
            //     $('.status').prop('checked',true)
            // }else {
            //     $('.status').prop('checked',false)
            // }
            // modal.find('.modal-body #image').val(image);
            // $('#blah2').attr('src', image);
        })

        const timeString = '18:00:00'
        // Prepend any date. Use your birthday.
        const timeString12hr = new Date('1970-01-01T' + timeString + 'Z')
            .toLocaleTimeString('en-US',
                {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
            );
        document.getElementById('myTime').innerText = timeString12hr
    </script>
    <script>
        // Model Delete
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
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
