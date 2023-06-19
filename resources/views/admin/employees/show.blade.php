@extends('admin.layouts.master')
@section('title')
    تفاصيل الموظف
@endsection
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css-rtl/plugins/forms/switch.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">

@endsection
@section('sub_title')
    الموظفين
@endsection
@section('title_head')
    تفاصيل الموظف
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title "> بيانات الموظف</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <!-- Grid With Label start -->
                            <section class="grid-with-label" id="grid-with-label">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">

                                            <div class="card-content collapse show">
                                                <div class="card-body">

                                                    <table class="table table-bordered  table-striped">
                                                        <tr>
                                                            <th> اسم الموظف</th>
                                                            <td> {{old('name',$data->name)}}</td>
                                                        </tr>

                                                        <tr>
                                                            <th> البريد الاكتروني</th>
                                                            <td> {{old('name',$data->email)}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th> رقم الجوال</th>
                                                            <td> {{old('phone',$data->phone)}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th> العنوان</th>
                                                            <td> {{old('address',$data->address)}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th> نوع الراتب</th>
                                                            <td> {{ $data->salary_type =='salary' ? 'راتب' :'نسبة %'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th> {{ $data->salary_type =='salary' ? 'راتب' :'نسبة'}}
                                                                الراتب
                                                            </th>
                                                            <td> {{ $data->salary_type =='salary' ? $data->salary_value : number_format($data->salary_value,0) .'%'}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>صورة الموظف</th>
                                                            <td>            @if($data->image)
                                                                    <img id="blah" src="{{asset($data->image)}}"
                                                                         style="height:100px; width: 100px; "
                                                                         alt="your image"/>

                                                                @else
                                                                    <img id="blah"
                                                                         src="{{asset('dashboard/app-assets/images/avatar.jpg')}}"
                                                                         style="height:100px; width: 100px; "
                                                                         alt="your image"/>

                                                                @endif
                                                            </td>
                                                        </tr>

                                                    </table>


                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>
                            <!-- Grid With Label end -->
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">عمليات الموظف</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-underline nav-justified">
                                <li class="nav-item">
                                    <a class="nav-link active" id="activeIcon12-tab1" data-toggle="tab"
                                       href="#activeIcon12"
                                       aria-controls="activeIcon12" aria-expanded="true"><i class="ft-credit-card"></i>
                                        سندات القبض</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="linkIcon12-tab1" data-toggle="tab" href="#linkIcon12"
                                       aria-controls="linkIcon12"
                                       aria-expanded="false"><i class="ft-credit-card"></i> سندات الصرف </a>
                                </li>

                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel" class="tab-pane active" id="activeIcon12"
                                     aria-labelledby="activeIcon12-tab1"
                                     aria-expanded="true">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered sourced-data">

                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>رقم السند</th>
                                                <th>نوع المستلم</th>
                                                <th>اسم المستلم منه</th>
                                                <th>المجموع</th>
                                                <th>تاريخ الاستلام</th>
                                                <th>ملاحظات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data->catchReceipts as $info)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$info->number}}</td>
                                                    <td>
                                                        @if($info->user_id !=null)
                                                            <span class="bg-primary text-white">مشترك</span>
                                                        @else
                                                            <span class="bg-success text-white">موظف</span>

                                                        @endif
                                                    </td>
                                                    @if($info->user_id !=null)
                                                        <td>{{$info->user->name}}</td>
                                                    @else
                                                        <td>{{$info->employee->name}}</td>

                                                    @endif
                                                    <td><span class="text-success">{{$info->total}}</span></td>
                                                    <td>{{$info->created_at->format('Y-m-d')}}</td>
                                                    <td>{{$info->notes}}</td>
                                                </tr>

                                            @endforeach


                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="linkIcon12" role="tabpanel" aria-labelledby="linkIcon12-tab1"
                                     aria-expanded="false">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered sourced-data">

                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>رقم السند</th>
                                                <th>نوع المستلم</th>
                                                <th>اسم المستلم منه</th>
                                                <th>المجموع</th>
                                                <th>تاريخ الاستلام</th>
                                                <th>ملاحظات</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data->Receipts as $info)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$info->number}}</td>
                                                    <td>
                                                        @if($info->user_id !=null)
                                                            <span class="bg-primary text-white">مشترك</span>
                                                        @else
                                                            <span class="bg-success text-white">موظف</span>

                                                        @endif
                                                    </td>
                                                    @if($info->user_id !=null)
                                                        <td>{{$info->user->name}}</td>
                                                    @else
                                                        <td>{{$info->employee->name}}</td>

                                                    @endif
                                                    <td><span class="text-success">{{$info->total}}</span></td>
                                                    <td>{{$info->created_at->format('Y-m-d')}}</td>
                                                    <td>{{$info->notes}}</td>


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

                <div class="form-actions">
                    <div class="text-center">
                        <a href="{{route('employees.index')}}" class="btn btn-primary">رجوع <i
                                class="ft-pocket"></i></a>

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
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"
            type="text/javascript"></script>

    <script src="{{asset('dashboard/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/icheck/icheck.min.js')}}"
            type="text/javascript"></script>


    <!-- END PAGE LEVEL JS-->
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
    <script src="{{asset('dashboard/app-assets/js/scripts/forms/validation/form-validation.js')}}"
            type="text/javascript"></script>
    <script !src="">
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }

        val_type = $('input[name="salary_type"]:checked').val();

        if (val_type == 'salary') {
            $("#salary").show();
            $("#ratio").hide();
        } else {

            $("#salary").hide();
            $("#ratio").show();

        }
        $('input[type=radio][name=salary_type]').change(function () {


            if (this.value == 'salary') {
                $("#salary").show();
                $("#ratio").hide();
            } else {

                $("#salary").hide();
                $("#ratio").show();

            }
        });
    </script>
@endsection
