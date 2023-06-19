@extends('admin.layouts.master')
@section('title')
   المشتركين
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
@endsection
@section('sub_title')
    المستخدمين
@endsection
@section('title_head')
المشتركين
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">بيانات المشتركين</h4>
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
                            @can('create_users')
                            <a href="{{route('users.create')}}" class="btn btn-primary btn-min-width btn-glow mr-1 mb-1">اضافة مشترك جديد</a>
                            @endcan
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered sourced-data">

                                    <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>رقم الجوال</th>
                                    <th>رقم هوية</th>
                                    <th>العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
            @foreach($data as $info)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{route('users.show',$info->id)}}">{{$info->name}}</a> </td>
                    <td>{{$info->phone}}</td>
                    <td>{{$info->verification_id}}</td>

                    <td>
                        @can('update_users')
                        <a href="{{route('users.edit',$info->id)}}" class="btn btn-sm btn-success ">تعديل</a>
                        @endcan
                            @can('delete_users')
                        <a href="#delete"  data-id = "{{$info->id}}" data-toggle="modal"
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

        <!-- Modal -->
        <div class="modal fade text-left" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger white">
                        <h4 class="modal-title white" id="delete">حذف المشترك</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('users.destroy','delete')}}" method="post">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                            <input type="hidden" name="id"  id="id">
                            <h5>هل انت متأكد من عملية الحذف ؟</h5>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إالغاء</button>
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
    <script src="{{asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.min.js')}}" type="text/javascript"></script>

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


    <!-- END PAGE LEVEL JS-->

    <script>
        // Model Delete
        $('#delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
    </script>
@endsection
