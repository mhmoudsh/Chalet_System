<div id="search"  class="table-responsive">
    <table  class="table  table-striped table-bordered sourced-data">

        <thead>
        <tr>
            <th>#</th>
            <th>اسم المشترك</th>
            <th>اسم الاشتراك</th>
            <th>الحالة</th>
            <th>السعر</th>
            <th>المدة(شهرياً)</th>
            <th>تاريخ البداية</th>
            <th>تاريخ الانتهاء</th>
            {{--                                    <th> الفاتورة</th>--}}
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $info)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$info->user->name}}</td>
                <td>   <span class="bg-primary text-white"> {{$info->subscription->name}}</span></td>

                <td>
                    @if( $info->status == 1)
                        <span class="bg-success text-white">مفعل</span>
                    @else
                        <span class="bg-danger text-white">منتهي</span>
                    @endif

                </td>
                <td>{{$info->price}}</td>
                <td>{{$info->duration}} شهور</td>
                <td>{{$info->start_at}}</td>
                <td>{{$info->end_at}}</td>
                {{--                                        <td>--}}
                {{--                                            <a href="#show"  data-service_ids="{{$info->service_ids }}" data-id="{{$info->id}}" data-toggle="modal"--}}
                {{--                                               data-target="#show" class="btn btn-sm btn-primary ">عرض</a>--}}
                {{--                                        </td>--}}
                <td>

                    @if($info->status !=2)

                        @can('update_user_subscriptions')
                            <a href="#edit" data-user_subscription_old_id="{{$info->id}}" data-name_edit="{{$info->user->id}}"
                               data-subscription_old_id="{{$info->subscription->id}}"
                               data-duration_edit="{{$info->duration}}" data-price_edit="{{$info->price}}"
                               data-toggle="modal"
                               data-target="#edit" class="btn btn-sm btn-success ">تغيير الاشتراك</a>

                        @endcan
                        @can('delete_user_subscriptions')
                            <a href="#delete" data-user_subscription_old_id="{{$info->id}}" data-user_id="{{$info->user->id}}"
                               data-subscription_old_id="{{$info->subscription->id}}"
                               data-duration_edit="{{$info->duration}}" data-price_edit="{{$info->price}}" data-toggle="modal"
                               data-target="#delete" class="btn btn-sm btn-danger ">انهاء الاشتراك</a>
                        @endcan
                    @else
                        @can('update_user_subscriptions')
                            <a href="#edit" data-user_subscription_old_id="{{$info->id}}" data-name_edit="{{$info->user->id}}"
                               data-subscription_old_id="{{$info->subscription->id}}"
                               data-duration_edit="{{$info->duration}}" data-price_edit="{{$info->price}}"
                               data-toggle="modal"
                               data-target="#edit" class="btn btn-sm btn-success ">تغيير الاشتراك</a>
                        @endcan
                        @can('renew_user_subscriptions')
                            <a href="#renewal" data-user_subscription_id="{{$info->id}}" data-user_id="{{$info->user->id}}" data-toggle="modal"
                               data-target="#renewal" class="btn btn-sm btn-primary ">تجديد الاشتراك</a>
                        @endcan
                    @endif

                </td>
            </tr>

        @endforeach


        </tbody>

    </table>
    <br>
    <div class="col-md-12" id="ajax_pagination_in_search">
        {{ $data->links() }}
    </div>
</div>
