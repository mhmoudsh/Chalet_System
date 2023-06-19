@extends('admin.layouts.master')
@section('title')
    تعديل بيانات المسؤول
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css-rtl/plugins/forms/switch.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('dashboard/app-assets/vendors/css/forms/selects/select2.min.css')}}">

@endsection
@section('sub_title')
    المسؤولين والصلاحيات
@endsection
@section('title_head')
    المسؤولين
@endsection
@section('content')
    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        <div class="col-xs-7 col-sm-7 col-md-7">
                            <div class="form-group">
                                <label for="inputName" class="control-label"> اسم الصلاحية<span
                                        class="tx-danger">*</span></label>
                                {!! Form::text('name', null, array('placeholder' => __('site.name_permission'),'class' => 'form-control','id'=>'name')) !!}
                                <input type="hidden" name="url_roles" id="url_roles" value="{{old('roles_name')}}">
                                <input type="hidden" name="role_id" id="role_id" value="{{ $role->id}}">
                                <span class="tx-danger" id="alert_name"> </span>
                                @error('name')

                                <span class="tx-danger" style="display: none">
                             {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="inputName" class="control-label"> @lang('site.sellect_all') <span
                                        class="tx-danger">*</span></label>
                                <input type="checkbox" name="check_All" id="checkAll" value="">



                            </div>
                        </div>
                    </div>
                    <div class="row">




                        @php
                            $models = ['users','employees','services','subscriptions','user_subscriptions','catch_receipts','receipts','expenses',
                               'report_receipts','report_catch_receipts','report_expenses','report_subscriptions','settings','actives','admins','roles'];                      $maps = ['create', 'read','renew', 'update', 'delete'];
                        @endphp
                        @foreach ($models as $index=>$model)
                            <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
                                <div class="card">

                                    <div class="card-header tx-medium bd-0 tx-white bg-primary">
                                        <h5 class=" {{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" style="color: #ffffff" data-toggle="tab">@lang('site.' . $model)</a></h5>

                                    </div>
                                    <div class="card-body {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">
                                        @foreach ($maps as $map)
                                            @foreach($permission as $value)
                                                @if($value->name === $map . '_' . $model )
                                                    <label>{{ Form::checkbox('permission[]', $value->id , in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name') )}} @lang('site.' . $map)</label> <br>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </div><!-- /.box-body -->
                                    {{--                                @endforeach--}}
                                    <div class="card-footer">
                                        @lang('site.' . $model)
                                    </div>
                                </div><!-- /.box -->
                            </div>
                        @endforeach

                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary"> تحديث</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- row closed -->

@endsection
@section('scripts')

    <script src="{{asset('dashboard/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"
            type="text/javascript"></script>

    <script src="{{asset('dashboard/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>


    <!-- END PAGE LEVEL JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <script src="{{asset('dashboard/app-assets/js/scripts/forms/switch.js')}}" type="text/javascript"></script>

    <script src="{{asset('dashboard/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('dashboard/app-assets/js/scripts/forms/validation/form-validation.js')}}"
            type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('dashboard/app-assets/vendors/js/forms/select/select2.full.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('dashboard/app-assets/js/scripts/forms/select/form-select2.js')}}"
            type="text/javascript"></script>
    <script !src="">
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
