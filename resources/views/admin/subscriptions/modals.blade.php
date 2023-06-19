<!-- Modal create -->
<div class="modal fade text-left" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel33">اضافة اشتراك جديد</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('subscriptions.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label>اسم الاشتراك: </label>
                    <div class="form-group">
                        <input type="text" value="{{old('name')}}" name="name" required class="form-control"
                               data-validation-required-message="This field is required"
                               placeholder="ادخل  اسم الاشتراك ">
                    </div>
                    @error('name')
                    <span class="text-danger">
                         {{ $message }}
                         </span>
                    @enderror

                    <div class="form-group">

                        <label>سعر الاشتراك <span class="text-danger">*</span></label>
                        <br>
                        <input type="text"
                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                               value="{{old('price')}}" name="price" required class="form-control"
                               data-validation-required-message="This field is required"
                               placeholder="ادخل سعر الاشتراك ">
                    </div>
                    @error('price')
                    <span class="text-danger">
                                {{ $message }}
                             </span>
                    @enderror


                    <div class="form-group">

                        <label>مدة الاشتراك (شهرياً) <span class="text-danger">*</span></label>
                        <br>
                        <input type="text"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                               value="{{old('duration')}}" name="duration" required class="form-control"
                               data-validation-required-message="This field is required"
                               placeholder="ادخل مدة الاشتراك ">
                    </div>
                    @error('duration')
                    <span class="text-danger">
                                {{ $message }}
                             </span>
                    @enderror


                    <div class="d-block-flex ">
                        <div class="form-group ">
                            <label>الخدمات<span class="text-danger">*</span></label>
                            <br>
                            <select required class="select2 form-control " name="service_ids[]"
                                    style="width: 470px" multiple="multiple">

                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->name}}</option>

                                @endforeach


                            </select>
                            @error('service_ids')
                            <span class="text-danger">
                                {{ $message }}
                             </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group ">

                        <label>حالة الاشتراك <span class="text-danger">*</span></label>
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
                <label class="modal-title text-text-bold-600" id="myModalLabel33">تعديل الاشتراك </label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('subscriptions.update','update')}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body">
                    <label>اسم الاشتراك: </label>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <input type="text" value="{{old('name')}}" id="name" name="name" required
                               class="form-control"
                               data-validation-required-message="This field is required"
                               placeholder="ادخل  اسم الاشتراك ">
                    </div>
                    @error('name')
                    <span class="text-danger">
                         {{ $message }}
                         </span>
                    @enderror

                    <div class="form-group">

                        <label>سعر الاشتراك <span class="text-danger">*</span></label>
                        <br>
                        <input type="text" id="price"
                               oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                               value="{{old('price')}}" name="price" required class="form-control"
                               data-validation-required-message="This field is required"
                               placeholder="ادخل سعر الاشتراك ">
                    </div>
                    @error('price')
                    <span class="text-danger">
                                {{ $message }}
                             </span>
                    @enderror


                    <div class="form-group">

                        <label>مدة الاشتراك (شهرياً) <span class="text-danger">*</span></label>
                        <br>
                        <input type="text" id="duration"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*?)\..*/g, '$1');"
                               value="{{old('duration')}}" name="duration" required class="form-control"
                               data-validation-required-message="This field is required"
                               placeholder="ادخل مدة الاشتراك ">
                    </div>
                    @error('duration')
                    <span class="text-danger">
                                {{ $message }}
                             </span>
                    @enderror


                    <div class="d-block-flex ">
                        <div class="form-group ">
                            <label>الخدمات<span class="text-danger">*</span></label>
                            <br>
                            <select required class="select2 form-control " id="service_ids" name="service_ids[]"
                                    style="width: 470px" multiple="multiple">

                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->name}}</option>

                                @endforeach


                            </select>
                            @error('service_ids')
                            <span class="text-danger">
                                {{ $message }}
                             </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group ">

                        <label>حالة الاشتراك <span class="text-danger">*</span></label>
                        <br>

                        <input type="checkbox" name="status" class="status  switch" id="switch8"
                               data-on-title="1"
                               data-off-label="غير مفعل"
                               data-on-label="مفعل" data-off-title="0" data-switch-always checked/>
                    </div>
                    @error('status')
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
<!-- Modal delete -->
<div class="modal fade text-left" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger white">
                <h4 class="modal-title white" id="delete">حذف الاشتراك</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('subscriptions.destroy','delete')}}" method="post">
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

<!-- Modal show -->
<div class="modal fade text-left" id="show" tabindex="-1" role="dialog" aria-labelledby="show"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary white">
                <h4 class="modal-title white" id="delete">الخدمات المقدمة</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="modal-body">
                    <div class="d-block-flex ">
                        <div class="form-group ">
                            <label>الخدمات<span class="text-danger">*</span></label>
                            <br>
                            <select disabled required class="select2 form-control " id="service_ids_show" name="service_ids[]"
                                    style="width: 470px" multiple="multiple">

                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->name}}</option>

                                @endforeach


                            </select>
                            @error('service_ids')
                            <span class="text-danger">
                                {{ $message }}
                             </span>
                            @enderror

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">الغاء
                    </button>

                </div>
            </form>


        </div>
    </div>
</div>
