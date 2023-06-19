@extends('admin.layouts.master')
@section('title')
    الخدمات
@endsection
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css-rtl/plugins/forms/switch.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">

    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
@section('sub_title')
    الخدمات
@endsection
@section('title_head')
    الخدمات المقدمة
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">بيانات الخدمات</h4>
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
                               data-target="#create" class="btn btn-primary btn-min-width btn-glow mr-1 mb-1">اضافة خدمة
                                جديدة</a>
                            @endcan
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered sourced-data">

                                        <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الصورة</th>
                                    <th>الحالة</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $info)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$info->name}}</td>
                                        <td>
                                            <img src="{{$info->image}}" style="height: 100px; width: 100px" alt="{{$info->name}}">
                                        </td>
                                        <td>
                                            @if( $info->status == 1)
                                                <span class="bg-success text-white">مفعل</span>
                                            @else
                                                <span class="bg-danger text-white">غير مفعل</span>
                                            @endif

                                        </td>

                                        <td>
                                            @can('update_services')
                                            <a href="#edit" data-id="{{$info->id}}" data-name="{{$info->name}}"
                                               data-image="{{$info->image}}" data-status="{{$info->status}}"
                                               data-toggle="modal"
                                               data-target="#edit" class="btn btn-sm btn-success ">تعديل</a>
                                            @endcan
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
                        <label class="modal-title text-text-bold-600" id="myModalLabel33">اضافة خدمة جديدة</label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('services.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label>اسم الخدمة: </label>
                            <div class="form-group">
                                <input type="text" value="{{old('name')}}" name="name" required class="form-control"
                                       data-validation-required-message="This field is required"
                                       placeholder="ادخل  اسم الخدمة ">
                            </div>
                            @error('name')
                            <span class="text-danger">
                         {{ $message }}
                         </span>
                            @enderror
                            <div class="form-group">

                                <label>حالة الخدمة <span class="text-danger">*</span></label>
                                <br>

                                <input type="checkbox" name="status" class=" switch" id="switch8" data-on-title="1"
                                       data-off-label="غير مفعل"
                                       data-on-label="مفعل" data-off-title="0" data-switch-always checked/>
                            </div>
                            @error('status')
                            <span class="text-danger">
                                {{ $message }}
                             </span>
                            @enderror

                        </div>


                        <div class="form-group center">
                            <label>صورة الخدمة</label>
                            <input accept="image/*"  type="file"
                                   onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" name="image" class="form-group" id="imgInp"/>
                            <br>
                            <img id="blah" src="{{asset('dashboard/app-assets/images/avatar.jpg')}}"
                                 style="height:100px; width: 100px;margin: 20px " alt="your image"/></div>

                        @error('image')
                        <span class="text-danger">
                             {{ $message }}
                             </span>
                        @enderror

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
                    <form action="{{route('services.update','update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <label>اسم الخدمة: </label>
                            <div class="form-group">
                                <input type="hidden" name="id" id="id">
                                <input type="text" value="{{old('name')}}" id="name" name="name" required
                                       class="form-control"
                                       data-validation-required-message="This field is required"
                                       placeholder="ادخل  اسم الخدمة ">
                            </div>
                            @error('name')
                            <span class="text-danger">
                         {{ $message }}
                         </span>
                            @enderror
                            <div class="form-group">

                                <label>حالة الخدمة <span class="text-danger">*</span></label>
                                <br>

                                <input type="checkbox" name="status" class="status switch" id="switch8" data-on-title="1"
                                       data-off-label="غير مفعل"
                                       data-on-label="مفعل" data-off-title="0" data-switch-always />
                            </div>
                            @error('status')
                            <span class="text-danger">
                                {{ $message }}
                             </span>
                            @enderror

                        </div>


                        <div class="form-group center">
                            <label>صورة الخدمة</label>
                            <input accept="image/*"  class="form-group"   name="image"  type="file"
                                   onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" id="imgInp"/>
                            <br>
                            <img id="blah2"src="{{asset('dashboard/app-assets/images/avatar.jpg')}}"
                                 style="height:100px; width: 100px;margin: 20px " alt="your image"/></div>

                        @error('image')
                        <span class="text-danger">
                             {{ $message }}
                             </span>
                        @enderror

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
                    <form action="{{route('services.destroy','delete')}}" method="post">
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
    <script>
        // Model edit
        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var status = button.data('status')
            var image = button.data('image')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            if(status == 1){
                $('.status').prop('checked',true)
            }else {
                $('.status').prop('checked',false)
            }
            modal.find('.modal-body #image').val(image);
            $('#blah2').attr('src', image);
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
