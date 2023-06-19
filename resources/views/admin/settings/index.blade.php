@extends('admin.layouts.master')
@section('title')
    الإعدادت العامة
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
    الإعدادت العامة
@endsection
@section('title_head')
    الإعدادت العامة
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <!-- row -->
        <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('settings.update','settings') }}" data-parsley-validate="" method="post"
                              enctype="multipart/form-data"
                              autocomplete="off">
                            {{ csrf_field() }}
                            @method('put')
                            {{-- 1 --}}
                            <div class="row">

                                <div class="col mg-b-0">
                                    <label for="website_title" class="control-label">اسم الشاليه <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="website_title"
                                           value="{{old('website_title',isset($data->website_title) ?$data->website_title :"")}}"
                                           required="يرجي ادخال اسم المركز" name="website_title"
                                           title="يرجي ادخال اسم المركز">

                                    @error('website_title')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>
                                <div class="col mg-b-0">
                                    <label for="phone" class="control-label">رقم الهاتف <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone"
                                           value="{{old('phone',isset($data->phone) ?$data->phone :"")}}"
                                           required="يرجي ادخال رقم الهاتف  " name="phone"
                                           title="يرجي ادخال رقم الهاتف  ">
                                    @error('phone')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>

                                <div class="col mg-b-0">
                                    <label for="phone2" class="control-label">رقم الهاتف2 <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone2"
                                           value="{{old('phone2',isset($data->phone2) ?$data->phone2 :"")}}"
                                           required="يرجي ادخال رقم الهاتف  " name="phone2"
                                           title="يرجي ادخال رقم الهاتف  ">
                                    @error('phone2')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>

                                <div class="col mg-b-0">
                                    <label for="iwebsite_email" class="control-label">إيميل </label>
                                    <input type="email" class="form-control" id="website_email"
                                           value="{{old('website_email',isset($data->website_email) ?$data->website_email :"")}}"
                                           required="يرجي ادخال إيميل " name="website_email"
                                           title="يرجي ادخال إيميل  ">
                                    @error('website_email')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>

                            </div>
                            <br>
                            {{-- 2 --}}
                            <div class="row">


                                <div class="col mg-b-0">
                                    <label for="facebook_link" class="control-label"> رابط الفيس بوك <span
                                            class="text-danger">*</span></label>
                                    <input type="url" class="form-control" id="facebook_link"
                                           value="{{old('facebook_link',isset($data->facebook_link) ?$data->facebook_link :"")}}"
                                           required="يرجي ادخال رابط الفيس بوك " name="facebook_link"
                                           title="يرجي ادخالرابط الفيس بوك  ">
                                    @error('facebook_link')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>
                                <div class="col mg-b-0">
                                    <label for="twitter_link" class="control-label"> رابط تويتر <span
                                            class="text-danger">*</span></label>
                                    <input type="url" class="form-control" id="twitter_link"
                                           value="{{old('twitter_link',isset($data->twitter_link) ?$data->twitter_link:"")}}"
                                           required="يرجي ادخال رابط تويتر " name="twitter_link"
                                           title="يرجي ادخال رابط تويتر  ">
                                    @error('twitter_link')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>


                                <div class="col mg-b-0">
                                    <label for="instagram_link" class="control-label"> رابط الانستغرام <span
                                            class="text-danger">*</span></label>
                                    <input type="url" class="form-control" id="instagram_link"
                                           value="{{old('instagram_link',isset($data->instagram_link) ?$data->instagram_link :"")}}"
                                           required="يرجي ادخال رابط الانستغرام " name="instagram_link"
                                           title="يرجي ادخال رابط الانستغرام  ">
                                    @error('instagram_link')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>


                                <div class="col mg-b-0">
                                    <label for="whatsapp_link" class="control-label"> رابط الواتس اب <span
                                            class="text-danger">*</span></label>
                                    <input type="url" class="form-control" id="whatsapp_link"
                                           value="{{old('whatsapp_link',isset($data->whatsapp_link) ?$data->whatsapp_link :"")}}"
                                           required="يرجي ادخال رابط الانستغرام " name="whatsapp_link"
                                           title="يرجي ادخال رابط الانستغرام  ">
                                    @error('whatsapp_link')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>


                            </div>

                            <br>
                            {{-- 2 --}}
                            <div class="row">


                                <div class="col mg-b-0">
                                    <label for="facebook_link" class="control-label"> رابط تليجرام <span
                                            class="text-danger">*</span></label>
                                    <input type="url" class="form-control" id="another_link"
                                           value="{{old('another_link',isset($data->another_link) ?$data->another_link :"")}}"
                                           required="يرجي ادخال رابط تليجرام " name="another_link"
                                           title="يرجي ادخالرابط تليجرام  ">
                                    @error('another_link')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>


                                <div class="col mg-b-0">
                                    <label for="another_link" class="control-label"> رقم التسجيل <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="registration_number"
                                           value="{{old('registration_number',isset($data->registration_number) ?$data->registration_number :"")}}"
                                           required="يرجي ادخال رقم التسجيل  " name="registration_number"
                                           title="يرجي ادخال رقم التسجيل  ">
                                    @error('registration_number')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>


                                <div class="col mg-b-0">
                                    <label for="another_link" class="control-label"> رقم الضريبي <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tax_number"
                                           value="{{old('tax_number',isset($data->tax_number) ?$data->tax_number :"")}}"
                                           required="يرجي ادخال رقم الضريبي  " name="tax_number"
                                           title="يرجي ادخال رقم الضريبي  ">
                                    @error('tax_number')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>


                                <div class="col mg-b-0">
                                    <label for="another_link" class="control-label"> العنوان <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address"
                                           value="{{old('address',isset($data->address) ?$data->address :"")}}"
                                           required="يرجي ادخال العنوان  " name="address"
                                           title="يرجي ادخال العنوان  ">
                                    @error('address')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>


                            </div>
                            <br>

                            <div class="row">


                                <div class="col mg-b-0">
                                    <label for="initial_message" class="control-label"> رسالةالأولية للحجز <span
                                            class="text-danger">*</span></label>
                                    <textarea  class="form-control" id="another_link" name="initial_message"
                                              required="يرجي ادخال رسالةالأولية للحجز "
                                              title="يرجي ادخال رسالةالأولية للحجز  ">{{old('initial_message',isset($data->initial_message) ? $data->initial_message :"")}}</textarea>
                                    @error('initial_message')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>


                                <div class="col mg-b-0">
                                    <label for="initial_message" class="control-label"> رسالة تأكيد الحجز <span
                                            class="text-danger">*</span></label>
                                    <textarea  class="form-control" id="confirm_message" name="confirm_message"
                                              required="يرجي ادخال رسالة تأكيد الحجز "
                                              title="يرجي ادخال رسالة تأكيد الحجز  ">{{old('confirm_message',isset($data->confirm_message) ? $data->confirm_message :"")}}</textarea>
                                    @error('confirm_message')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>

                                <div class="col mg-b-0">
                                    <label for="initial_message" class="control-label"> رسالة إلغاء الحجز <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="cancel_message" name="cancel_message"
                                              required="يرجي ادخال رسالة إلغاء الحجز "
                                              title="يرجي ادخال رسالة إلغاء الحجز  ">{{old('cancel_message',isset($data->cancel_message) ? $data->cancel_message :"")}}</textarea>
                                    @error('cancel_message')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>


                                <div class="col mg-b-0">
                                    <label for="whatsapp_link" class="control-label">(بساعة) مدة الغاء الحجز <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="cancel_time"
                                           value="{{old('cancel_time',isset($data->cancel_time) ?$data->cancel_time :"")}}"
                                           required="يرجي ادخال مدة الغاء الحجز" name="cancel_time"
                                           title="يرجي ادخال مدة الغاء الحجز">
                                    @error('cancel_time')

                                    <span class="text-danger">
                             {{ $message }}
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="row">


                                <div class="col-sm-12 col-md-12">
                                    <div class="col mg-b-0">

                                        <h5 class="card-title">شعار الشاليه</h5>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <input name="image" accept="image/*" class="form-group"
                                                       type='file' id="imgInp"/>
                                                <br>
                                                @if(isset($data->website_logo))
                                                    <img id="blah"
                                                         src="{{asset($data->website_logo)}}"
                                                         style="height:100px; width: 100px; "
                                                         alt="your image"/></div>

                                            @else
                                                <img id="blah"
                                                     src="{{asset('dashboard/app-assets/images/avatar.jpg')}}"
                                                     style="height:100px; width: 100px; "
                                                     alt="your image"/>

                                            @endif
                                        </div>

                                    </div>

                                    <div id="oldimage" class="col-sm-12 col-md-12">

                                        <br>


                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                                        </div>
                                    </div>
                                    <br>


                                </div>
                            </div>

                        </form>
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
        $(document).ready(function () {


            $(document).on('click', '#update_image', function (e) {
                e.preventDefault();
                if (!$('#photo').length) {
                    $('#oldimage').html('<input accept="image/*" onchange="loadFile(event)" type="file" name="image" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />');

                    $('#update_image').hide();
                    $('#cancel_image').show();
                }
            });


            $(document).on('click', '#cancel_image', function (e) {
                e.preventDefault();

                $('#update_image').show();
                $('#cancel_image').hide();
                $('#oldimage').html('');

                return false;
            });
        });
    </script>
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
            if (status == 1) {
                $('.status').prop('checked', true)
            } else {
                $('.status').prop('checked', false)
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
