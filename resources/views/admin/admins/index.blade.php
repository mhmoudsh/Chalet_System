@extends('admin.layouts.master')
@section('title')
    المسؤولين
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
    المسؤولين والصلاحيات
@endsection
@section('title_head')
المسؤولين
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">بيانات المسؤولين</h4>
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
                                @can('create_admins')
                                <a href="{{ route('admins.create') }}"
                                   class="btn btn-primary btn-min-width btn-glow mr-1 mb-1">اضافة مسؤول
                                    جديد</a>
                                @endcan

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered sourced-data">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>الإيميل</th>
                                    <th>الحالة</th>
                                    <th>الصلاحيات</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $info)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$info->name}}</td>
                                        <td>{{$info->email}}</td>

                                        <td>
                                            @if( $info->status == 1)
                                                <span class="bg-success text-white">مفعل</span>
                                            @else
                                                <span class="bg-danger text-white">غير مفعل</span>
                                            @endif

                                        </td>
                                        <td>

                                            @if (!empty($info->getRoleNames()))
                                                @foreach ($info->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @can('update_admins')
                                            <a href="{{ route('admins.edit', $info->id) }}" class="btn btn-sm btn-success ">تعديل</a>
                                            @endcan
                                                @can('delete_admins')
                                            @if($info->roles_name != ['owner'])
                                            <a href="#delete" data-id="{{$info->id}}" data-toggle="modal"
                                               data-target="#delete" class="btn btn-sm btn-danger ">حذف</a>
                                            @endif
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


        <!-- Modal delete -->
        <div class="modal fade text-left" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger white">
                        <h4 class="modal-title white" id="delete">حذف المسؤول</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('admins.destroy','delete')}}" method="post">
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
