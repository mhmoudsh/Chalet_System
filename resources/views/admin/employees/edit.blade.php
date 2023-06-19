@extends('admin.layouts.master')
@section('title')
    تعديل بيانات الموظف
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
    المستخدمين
@endsection
@section('title_head')
    الموظفين
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">تحديث بيانات الموظف</h4>
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
                                                    <form action="{{route('employees.update',$data->id)}}" method="post"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label> اسم الموظف<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text"
                                                                               value="{{old('name',$data->name)}}"
                                                                               name="name" required class="form-control"
                                                                               data-validation-required-message="This field is required"
                                                                               placeholder="ادخل  اسم الموظف ">
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
                                                                        <input type="email" name="email"
                                                                               value="{{old('email',$data->email)}}"
                                                                               class="form-control"
                                                                               placeholder="ادخل رقم البريد الاكتروني ">
                                                                    </div>
                                                                    @error('email')
                                                                    <span class="text-danger">
                                                                    {{ $message }}
                                                                    </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label> رقم الجوال<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" name="phone"
                                                                               value="{{old('phone',$data->phone)}}"
                                                                               required class="form-control"
                                                                               placeholder="ادخل رقم الجوال ">
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
                                                                        <label> رقم هوية الموظف<span class="text-danger">*</span></label>
                                                                        <input type="text" value="{{old('verification_id',$data->verification_id)}}"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  name="verification_id" required class="form-control" placeholder="ادخل رقم هوية الموظف">
                                                                    </div>
                                                                    @error('verification_id')
                                                                    <span class="text-danger">
                                                        {{ $message }}
                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label> عنوان الموظف<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text"
                                                                               value="{{old('address',$data->address)}}"
                                                                               name="address" required
                                                                               class="form-control"
                                                                               placeholder="ادخل رقم عنوان الموظف">
                                                                    </div>
                                                                    @error('address')
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
                                                                        <label>صورة الموظف</label>
                                                                        <input accept="image/*" name="image"
                                                                               class="form-group" type='file'
                                                                               id="imgInp"/>
                                                                        <br>
                                                                        @if($data->image)
                                                                            <img id="blah" src="{{asset($data->image)}}"
                                                                                 style="height:100px; width: 100px; "
                                                                                 alt="your image"/></div>

                                                                    @else
                                                                        <img id="blah"
                                                                             src="{{asset('dashboard/app-assets/images/avatar.jpg')}}"
                                                                             style="height:100px; width: 100px; "
                                                                             alt="your image"/></div>

                                                                @endif
                                                            </div>
                                                        </div>
                                                </div>

                                            </div>
                                            <div class="form-actions">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-primary">تحديث البيانات <i
                                                            class="ft-thumbs-up position-right"></i></button>
                                                    <button type="reset" class="btn btn-warning">مسح البيانات <i
                                                            class="ft-refresh-cw position-right"></i></button>
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

     val_type  =$('input[name="salary_type"]:checked').val();

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
