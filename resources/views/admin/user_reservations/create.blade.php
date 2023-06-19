@extends('admin.layouts.master')
@section('title')
    اضافة حجز جديد
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
    المشتركين
@endsection
@section('content')
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">اضافة حجز جديد</h4>
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
                                                    <form action="{{route('user_reservations.store')}}" method="post"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label>نوع المستخدم<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-group">
                                                                        <label>جديد<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="radio" checked value="1"
                                                                               name="type_user" required
                                                                               placeholder="ادخل  المستلم ">

                                                                        <label>مسجل مسبقاً <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="radio" value="2" name="type_user"
                                                                               required
                                                                               placeholder="ادخل  المستلم ">
                                                                    </div>

                                                                </div>

                                                                <div class="col-md-4 old_user" style="display:none;">
                                                                    <div class="form-group ">
                                                                        <label>اسم المستخدم<span
                                                                                class="text-danger">*</span></label>
                                                                        <br>
                                                                        <select
                                                                            class="selectize form-control select88 "
                                                                            name="user_id" id="user_id"
                                                                        >
                                                                            <option value="">--اختر--</option>

                                                                            @foreach($users as $user)
                                                                                <option
                                                                                    value="{{$user->id}}">{{$user->name}}</option>

                                                                            @endforeach


                                                                        </select>
                                                                        @error('user_id')
                                                                        <span class="text-danger">
                                            {{ $message }}
                                    </span>
                                                                        @enderror

                                                                    </div>
                                                                </div>


                                                                <div class="col-md-4 new_user">
                                                                    <div class="form-group">
                                                                        <label> اسم المستخدم<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" value="{{old('name')}}"
                                                                               name="name" id="name"
                                                                               class="form-control"
                                                                               placeholder="ادخل  اسم المشترك ">
                                                                    </div>
                                                                    @error('name')
                                                                    <span class="text-danger">
                                {{ $message }}
                                </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4 new_user">
                                                                    <div class="form-group">
                                                                        <label> رقم الجوال<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" name="phone" id="phone"
                                                                               value="{{old('phone')}}"
                                                                               class="form-control"
                                                                               placeholder="ادخل رقم الجوال ">
                                                                    </div>
                                                                    @error('phone')
                                                                    <span class="text-danger">
                                {{ $message }}
                                </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4 new_user">
                                                                    <div class="form-group">
                                                                        <label> رقم هوية المستخدم<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text"
                                                                               value="{{old('verification_id')}}"
                                                                               id="verification_id" maxlength="9"
                                                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                               name="verification_id"
                                                                               class="form-control"
                                                                               placeholder="ادخل رقم عنوان الموظف">
                                                                    </div>
                                                                    @error('verification_id')
                                                                    <span class="text-danger">
                    {{ $message }}
                    </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-4 new_user">
                                                                    <div class="form-group">
                                                                        <label> عنوان المشترك<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" id="address"
                                                                               value="{{old('address')}}"
                                                                               name="address"
                                                                               class="form-control"
                                                                               placeholder="ادخل رقم عنوان المشترك">
                                                                    </div>
                                                                    @error('address')
                                                                    <span class="text-danger">
                                {{ $message }}
                                </span>
                                                                    @enderror
                                                                </div>


                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label> تاريخ الحجز<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="date" value="{{old('date')}}"
                                                                               id="date"
                                                                               name="date" required class="form-control"
                                                                               placeholder="ادخل تاريخ الحجز">
                                                                    </div>
                                                                    @error('date')
                                                                    <span class="text-danger">
                                {{ $message }}
                                </span>
                                                                    @enderror

                                                                </div>
                                                            </div>
                                                            <div class="row">


                                                                <div class="col-md-4">
                                                                    <div class="form-group">

                                                                        <label> الفترة الزمنية<span class="text-danger">*</span></label>
                                                                        <select required class=" form-control select88 "
                                                                                id="interval_id" name="interval_id">

                                                                            <option value="">--اختر--</option>

{{--                                                                            @foreach($intervals as $interval)--}}
{{--                                                                                <option--}}
{{--                                                                                    value="{{$interval->id}}">{{$interval->name}}</option>--}}

{{--                                                                            @endforeach--}}
                                                                            <option value="spacial">تخصيص</option>


                                                                        </select>
                                                                        <span class="text-danger alert" style="display: none" >  </span>

                                                                    </div>
                                                                </div>


                                                                <div class="col-md-4 spacial" style="display: none">
                                                                    <div class="form-group">
                                                                        <label> من (ساعة) <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="time" id="start_custom_time"
                                                                               value="{{old('start_custom_time')}}"
                                                                               name="start_custom_time"
                                                                               class="form-control"
                                                                               placeholder="ادخل بداية الوقت">
                                                                    </div>
                                                                    @error('start_custom_time')
                                                                    <span class="text-danger">
                                {{ $message }}
                                </span>
                                                                    @enderror
                                                                </div>


                                                                <div class="col-md-4 spacial" style="display: none">
                                                                    <div class="form-group">
                                                                        <label>إلى (ساعة )<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="time" id="end_custom_time"
                                                                               value="{{old('end_custom_time')}}"
                                                                               name="end_custom_time"
                                                                               class="form-control"
                                                                               placeholder="ادخل نهاية الوقت">
                                                                    </div>
                                                                    @error('end_custom_time')
                                                                    <span class="text-danger">
                                {{ $message }}
                                </span>
                                                                    @enderror
                                                                </div>


                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label> السعر الأساسي<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" id="basic_price"
                                                                               value="{{old('basic_price')}}" readonly
                                                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"

                                                                               name="basic_price" required
                                                                               class="form-control"

                                                                               placeholder="السعر  الأساسي">
                                                                    </div>
                                                                    @error('basic_price')
                                                                    <span class="text-danger">
                                {{ $message }}
                                </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label> السعر المدخل<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" id="manual_price"
                                                                               value="{{old('manual_price')}}"
                                                                               name="manual_price" required
                                                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"

                                                                               class="form-control"

                                                                               placeholder="السعر  المدخل">
                                                                    </div>
                                                                    @error('manual_price')
                                                                    <span class="text-danger">
                                {{ $message }}
                                </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label> السعر المدفوع<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" id="amount_paid" min="0"
                                                                               value="{{old('amount_paid',0)}}"
                                                                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"

                                                                               name="amount_paid" required
                                                                               class="form-control"

                                                                               placeholder="السعر  المدفوع">
                                                                    </div>
                                                                    @error('amount_paid')
                                                                    <span class="text-danger">
                                {{ $message }}
                                </span>
                                                                    @enderror
                                                                </div>


                                                            </div>
                                                            <br>


                                                        </div>
                                                        <div class="form-actions">
                                                            <h2 class="alert" style="display: none;color: red">لاتتوفر حجوزات في هذا اليوم</h2>
                                                            <div class="text-right">
                                                                <button type="submit" class="btn btn-primary">حفظ <i
                                                                        class="ft-thumbs-up position-right"></i>
                                                                </button>
                                                                <button type="reset" class="btn btn-warning">مسح
                                                                    البيانات <i
                                                                        class="ft-refresh-cw position-right"></i>
                                                                </button>
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
    <script>

        $('input[type=radio][name=type_user]').change(function () {

            if (this.value == '1') {

                $('.old_user').hide();
                $('.new_user').show();
                $('#name').prop('required', true);
                $('#phone').prop('required', true);
                $('#verification_id').prop('required', true);
                $('#address').prop('required', true);
                $('#user_id').prop('required', false);

            } else {

                $('.old_user').show();
                $('.new_user').hide();
                $('#name').prop('required', false);
                $('#phone').prop('required', false);
                $('#verification_id').prop('required', false);
                $('#address').prop('required', false);
                $('#user_id').prop('required', true);

            }


        });

        $('#interval_id').on('change', function (e) {

            if (this.value == 'spacial') {
                $('.spacial').show();
                $('#basic_price').val('0');
                $('#manual_price').val('0');
                $('#start_custom_time').prop('required', true);
                $('#end_custom_time').prop('required', true);
            } else {
                $('.spacial').hide();
                $('#start_custom_time').prop('required', false);
                $('#end_custom_time').prop('required', false);

                $.ajax({
                    type: "POST",
                    url: "{{route('admin.get_intervals_price')}}",
                    data: {
                        id: this.value,
                        _token: "{{csrf_token()}}"
                    },
                    success: function (response) {
                        $('#basic_price').val(response.price);
                        $('#manual_price').val(response.price);


                    },
                    error: function () {
                        $('#basic_price').val('0');
                        $('#manual_price').val('0');
                    }
                });
            }


        });


        $('#date').on('change', function (e) {

            $.ajax({
                type: "POST",
                url: "{{route('admin.checkDateReservation')}}",
                data: {
                    date: this.value,
                    _token: "{{csrf_token()}}"
                },
                success: function (response) {
                    $('#interval_id').empty();
                    // Loop through reservation_exits
                    // $.each(response.reservation_exits, function(index, reservation_exit) {
                    //     // Perform operations on each reservation_exit
                    //     console.log("Reservation Exit " + (index + 1) + ":");
                    //     console.log("ID: " + reservation_exit.id);
                    // });

                    var selectElement = $('#interval_id');

                    var defaultOption = $('<option></option>');
                    defaultOption.attr('value', '');
                    defaultOption.attr('selected', 'true');
                    defaultOption.text('اختر');


                    $.each(response.intervals, function(index, interval) {

                        var option = $('<option></option>');
                        option.val(interval.id);
                        option.text(interval.name);
                        selectElement.append(option);
                    });
                    selectElement.append(defaultOption);
                    if (response.length !=0){

                    var spacialOption = $('<option></option>');
                    spacialOption.attr('value', 'spacial');
                    spacialOption.text('تخصيص');
                    selectElement.append(spacialOption);


                    }
                    if(response.length  == 0){
                       alert('لايوجد فترات للحجز ') ;
                        $('.alert').show();
                       $('.alert').text('عذراً لايتوفر حجوزات في هذا اليوم ')

                    }else {
                        $('.alert').hide();
                    }


                },
                error: function () {

                }
            });


        });
    </script>
@endsection
