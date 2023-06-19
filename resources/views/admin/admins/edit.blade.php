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
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">  تعديل بيانات المسؤول</h4>
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
                                                    <form action="{{route('admins.update',$data->id)}}" method="post"  enctype="multipart/form-data" >
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label> اسم المسؤول<span class="text-danger">*</span></label>
                                                                        <input type="text" value="{{old('name',$data->name)}}" name="name" required class="form-control" data-validation-required-message="This field is required" placeholder="ادخل  اسم المسؤول ">
                                                                    </div>
                                                                    @error('name')
                                                                    <span class="text-danger">
                                                                    {{ $message }}
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>البريد الاكتروني</label>
                                                                        <input required type="email"  name="email"   value="{{old('email',$data->email)}}" class="form-control" placeholder="ادخل رقم البريد الاكتروني ">
                                                                    </div>
                                                                    @error('email')
                                                                    <span class="text-danger">
                                                                    {{ $message }}
                                                                    </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>  رقم الجوال<span class="text-danger">*</span></label>
                                                                        <input type="text"  name="phone" value="{{old('phone',$data->phone)}}" required class="form-control" placeholder="ادخل رقم الجوال ">
                                                                    </div>
                                                                    @error('phone')
                                                                    <span class="text-danger">
                                                                    {{ $message }}
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label> عنوان المسؤول</label>
                                                                        <input type="text" value="{{old('address',$data->address)}}"  name="address"  class="form-control" placeholder="ادخل رقم عنوان المسؤول">
                                                                    </div>
                                                                    @error('address')
                                                                    <span class="text-danger">
                                                                    {{ $message }}
                                                                    </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label> كلمة السر </label>
                                                                        <input type="password"   name="password"  class="form-control" placeholder="ادخل كلمة السر ">
                                                                    </div>
                                                                    @error('address')
                                                                    <span class="text-danger">
                                                                    {{ $message }}
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>  تأكيد كلمة السر </label>
                                                                        <input type="password"   name="password_confirmation"  class="form-control" placeholder="ادخل تأكيد كلمة السر ">
                                                                    </div>
                                                                    @error('address')
                                                                    <span class="text-danger">
                                                                    {{ $message }}
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">

                                                                    <div class="form-group ">

                                                                        <label>نوع المسؤول <span class="text-danger">*</span></label>
                                                                        <br>

                                                                        @if ($data->roles_name != ['المشرف'])

                                                                            <div class="form-group">
                                                                                <strong> @lang('site.permissions')</strong>
                                                                                {!! Form::select('roles_name[]', $roles,$adminRoles, array('class' => 'form-control select2 parsley-style-1','multiple'))
                                                                                !!}
                                                                            </div>
                                                                        @else
                                                                            {!! Form::select('roles_name[]', $roles,$adminRoles, array('class' => 'form-control select2 parsley-style-1','multiple','readonly'))
                                                                   !!}
                                                                        @endif
                                                                    </div>


                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group" >

                                                                        <label>حالة المسؤول <span class="text-danger">*</span></label>
                                                                        <br>

                                                                        <input type="checkbox" {{$data->status == 1 ?'checked':''}}  name="status"  class=" switch" id="switch8" data-on-title="1" data-off-label="غير مفعل"
                                                                               data-on-label="مفعل" data-off-title="0" data-switch-always />
                                                                    </div>
                                                                    @error('status')
                                                                    <span class="text-danger">
                                                                    {{ $message }}
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <br>
                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>صورة المسؤول</label>
                                                                        <input accept="image/*" class="form-group" type='file' id="imgInp" />
                                                                        <br>
                                                                        <img id="blah" name="image"  src="{{asset('dashboard/app-assets/images/avatar.jpg')}}" style="height:100px; width: 100px; " alt="your image" />
                                                                    </div>
                                                                </div>
                                                                @error('image')
                                                                <span class="text-danger">
                                                                    {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                        </div>
                                                        <div class="form-actions">
                                                            <div class="text-right">
                                                                <button type="submit" class="btn btn-primary">حفظ <i class="ft-thumbs-up position-right"></i></button>
                                                                <button type="reset" class="btn btn-warning">مسح البيانات <i class="ft-refresh-cw position-right"></i></button>
                                                            </div>
                                                        </div>
                                                    </form>
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
            </div>
        </div>
    </section>
    <!-- DOM - jQuery events table -->

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
