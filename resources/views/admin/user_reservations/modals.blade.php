<!-- Modal create -->
<div class="modal fade text-left" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel33">اضافة حجز جديد</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('user_reservations.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="d-block-flex ">
                        <label>نوع  السمتخدم: </label>
                        <div class="form-group">
                            <label>جديد<span class="text-danger">*</span></label>
                            <input type="radio" value="1" name="type_user" required
                                   data-validation-required-message="This field is required"
                                   placeholder="ادخل  المستلم ">

                            <label>مسجل مسبقاً <span class="text-danger">*</span></label>
                            <input type="radio" value="2" name="type_user" required
                                   data-validation-required-message="This field is required"
                                   placeholder="ادخل  المستلم ">

                        <div class="form-group new_user " >
                            <label>اسم المستخدم<span class="text-danger">*</span></label>
                            <br>
                            <select  required   class="selectize form-control select88 "  name="user_id"
                                    style="width: 470px">
                                <option value="">--اختر--</option>

                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>

                                @endforeach


                            </select>
                            @error('user_id')
                            <span class="text-danger">
                                {{ $message }}
                             </span>
                            @enderror

                        </div>

                            <div class="form-group old_user " >
                                <label>اسم المستخدم<span class="text-danger">*</span></label>
                                <br>
                                <input type="text"
                                       value="{{old('name')}}" name="name" id="name" required class="form-control"
                                       data-validation-required-message="This field is required"
                                       placeholder="اسم المستخدم ">
                                @error('name')
                                <span class="text-danger">
                                {{ $message }}
                             </span>
                                @enderror
                                <label>رقم الجوال<span class="text-danger">*</span></label>
                                <br>
                                <input type="text"
                                       value="{{old('phone')}}" name="phone" id="phone" required class="form-control"
                                       data-validation-required-message="This field is required"
                                       placeholder="رقم الجوال">
                                @error('phone')
                                <span class="text-danger">
                                {{ $message }}
                             </span>
                                @enderror

                                <label>رقم الهوية<span class="text-danger">*</span></label>
                                <br>
                                <input type="text"
                                       value="{{old('verification_id')}}" name="verification_id" id="verification_id" required class="form-control"
                                       data-validation-required-message="This field is required"
                                       placeholder="رقم الهوية">
                                @error('verification_id')
                                <span class="text-danger">
                                {{ $message }}
                             </span>
                                @enderror
                            </div>
                    </div>

                    <div class="d-block-flex ">
                        <div class="form-group ">
                            <label>اسم الاشتراك<span class="text-danger">*</span></label>
                            <br>
                            <select required class="selectize form-control " name="subscription_id" id="subscription_id"
                                    style="width: 470px">
                                <option value="">--اختر--</option>

{{--                                @foreach($subscriptions as $subscription)--}}

{{--                                    <option value="{{$subscription->id}}">{{$subscription->name}}</option>--}}

{{--                                @endforeach--}}


                            </select>
                            @error('subscription_id')
                            <span class="text-danger">
                                {{ $message }}
                             </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">

                        <label>سعر الاشتراك <span class="text-danger">*</span></label>
                        <br>
                        <input type="text" readonly
                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                               value="{{old('price')}}" name="price" id="price" required class="form-control"
                               data-validation-required-message="This field is required"
                               placeholder=" سعر الاشتراك ">
                    </div>
                    @error('price')
                    <span class="text-danger">
                                {{ $message }}
                             </span>
                    @enderror


                    <div class="form-group">

                        <label>مدة الاشتراك (شهرياً) <span class="text-danger">*</span></label>
                        <br>
                        <input type="text" readonly
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                               value="{{old('duration')}}" id="duration" name="duration" required class="form-control"
                               data-validation-required-message="This field is required"
                               placeholder=" مدة الاشتراك ">
                    </div>
                    @error('duration')
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
                <label class="modal-title text-text-bold-600" id="myModalLabel33">تغيير  الاشتراك </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('user_subscriptions.update','update')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="d-block-flex ">
                        <div class="form-group ">

                            <input type="hidden" name="subscription_old_id" id="subscription_old_id">
                            <input type="hidden" name="user_subscription_old_id" id="user_subscription_old_id">
                            <input type="hidden" name="user_id" id="user_id">
                            <label>اسم المشترك<span class="text-danger">*</span></label>

                            <br>
                            <select disabled=""  required class=" selectize form-control " name="user_id"  id="name_edit"
                                    style="width: 470px">

{{--                                @foreach($users_update as $user)--}}
{{--                                    <option  value="{{$user->id}}">{{$user->name}}</option>--}}

{{--                                @endforeach--}}


                            </select>

                            @error('user_id')
                            <span class="text-danger">
                                {{ $message }}
                             </span>
                            @enderror

                        </div>
                    </div>
                    <div class="d-block-flex ">
                        <div class="form-group ">
                            <label>اسم الاشتراك<span class="text-danger">*</span></label>
                            <br>
                            <select required class=" selectize form-control " name="user_subscription_new_id" id="subscription_edit"
                                    style="width: 470px">

{{--                                @foreach($subscriptions as $subscription)--}}
{{--                                    <option value="{{$subscription->id}}">{{$subscription->name}}</option>--}}

{{--                                @endforeach--}}


                            </select>
                            @error('subscription_id')
                            <span class="text-danger">
                                {{ $message }}
                             </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">

                        <label>سعر الاشتراك <span class="text-danger">*</span></label>
                        <br>
                        <input type="text" readonly
                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                               value="{{old('price')}}" name="price"  required class="form-control" id="price_edit"
                               data-validation-required-message="This field is required"
                               placeholder=" سعر الاشتراك ">
                    </div>
                    @error('price')
                    <span class="text-danger">
                                {{ $message }}
                             </span>
                    @enderror


                    <div class="form-group">

                        <label>مدة الاشتراك (شهرياً) <span class="text-danger">*</span></label>
                        <br>
                        <input type="text" readonly
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                               value="{{old('duration')}}" name="duration"  required class="form-control"
                               data-validation-required-message="This field is required" id="duration_edit"
                               placeholder=" مدة الاشتراك ">
                    </div>
                    @error('duration')
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


