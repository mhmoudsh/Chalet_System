<?php

namespace App\Repository\Services;

use App\Http\Requests\CatchReceiptRequest;
use App\Models\CatchReceipt;
use App\Models\Employe;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use App\Repository\CatchReceiptRepository;
use App\Repository\ServicesRepository;
use App\Repository\SubscriptionRepository;
use App\Repository\UserSubscriptionRepository;
use App\Traits\getSubscriptionFunctionsTrait;
use App\Traits\InvoiceTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSubscriptionServices
{
    use getSubscriptionFunctionsTrait, InvoiceTrait;

    private UserSubscriptionRepository $userSubscriptionRepository;

    public function __construct(UserSubscriptionRepository $userSubscriptionRepository)
    {

        $this->userSubscriptionRepository = $userSubscriptionRepository;
    }


    public function getData()
    {

        $data = UserSubscription::orderByDesc('id')->paginate(10);
        $user_ids = [];
        foreach ($data as $info){
            array_push($user_ids,$info->user_id);
        }


        $users = User::orderByDesc('id')->whereNotIn('id',$user_ids)->get();


        $subscriptions = Subscription::get();
        $users_update = User::get();

        return ['data' => $data, 'users' => $users,'users_update'=>$users_update, 'subscriptions' => $subscriptions];
    }


    public function saveData($request)
    {
        try {
            DB::beginTransaction();
            $data['user_id'] = $request->user_id;
            $data['subscription_id'] = $request->subscription_id;
            $subscription = Subscription::find($request->subscription_id);
            $data['price'] = $subscription->price;
            $data['duration'] = $subscription->duration;
            $duration = $this->getDuration($data['duration']);
            $data['start_at'] = $duration['start_at'];
            $data['end_at'] = $duration['end_at'];
            $data['status'] = 1; // active


            $user_subscription = UserSubscription::create($data);
            $user = User::find($request->user_id);

            $invoice_inputs = [
                'user_name' => $user->name,
                'subscription_name' => $subscription->name,
                'user_subscription_id' => $user_subscription->id,
                'user_id' => $request->user_id,
                'duration' => $subscription->duration,
                'total' => $subscription->price,
                'status' => Invoice::STATUS['unpaid'],
                'type' => '1',//subscription
            ];

            $this->createInvoice($invoice_inputs);
            $this->addToBalance($user->id, $subscription->price);

            DB::commit();
            session()->flash('success', 'تم اضافة البيانات بنجاح');
            return redirect()->route('user_subscriptions.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    public function findById($id)
    {

        return UserSubscription::find($id);
    }

    public function updateData($request)
    {

        try {

            DB::beginTransaction();
            $data['user_id'] = $request['user_id'];
            $data['subscription_id'] = $request['new_subscription_id'];
            $subscription = Subscription::find($request['new_subscription_id']);
            $data['price'] = $subscription->price;
            $data['duration'] = $subscription->duration;
            $duration = $this->getDuration($data['duration']);
            $data['start_at'] = $duration['start_at'];
            $data['end_at'] = $duration['end_at'];
            $data['status'] = 1; // active


            $user_subscription = UserSubscription::find($request['user_subscription_id']);
            $user_subscription->update($data);
            $user = User::find($request['user_id']);

            $invoice_inputs = [
                'user_name' => $user->name,
                'subscription_name' => $subscription->name,
                'user_subscription_id' => $user_subscription->id,
                'user_id' => $user->id,
                'duration' => $subscription->duration,
                'total' => $subscription->price,
                'status' => Invoice::STATUS['unpaid'],
                'type' => '1',//subscription
            ];

            $this->createInvoice($invoice_inputs);
            $this->addToBalance($user->id, $subscription->price);

            DB::commit();
            session()->flash('success', 'تم تغيير  الاشتراك  بنجاح');
            return redirect()->route('user_subscriptions.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    public function calculateDuration($inputs)
    {

        // count of day subscription
        $subscription = Subscription::find($inputs->subscription_old_id);
        $duration = $this->getDuration($subscription->duration);
        $toDate_subscription = Carbon::parse($duration['start_at']);
        $fromDate_subscription = Carbon::parse($duration['end_at']);
        $count_of_day_subscription = $toDate_subscription->diffInDays($fromDate_subscription);

        // count of pass  day subscription
        $user_subscription = UserSubscription::where('id', $inputs->user_subscription_old_id)->where('user_id', $inputs->user_id)->first();
        $toDate_user_subscription = Carbon::parse($user_subscription->start_at);
        $fromDate_user_subscription = Carbon::parse(date('Y-m-d'));
        $count_of_days_passed = $toDate_user_subscription->diffInDays($fromDate_user_subscription);
        $price = $user_subscription->price;

        $user = User::find($inputs->user_id);


        // the old subscription
        if ($count_of_day_subscription > $price) {

            $cost_day = $count_of_day_subscription / $price; //153 /100 =1.53
            $different_day = $cost_day * $count_of_days_passed; //1.53 * 30 = 45.9
            $total = $price - $different_day; //100 -45.9 = 54.1

        } else {
            $cost_day = $price / $count_of_day_subscription; //153 /100 =1.53
            $different_day = $cost_day * $count_of_days_passed; //1.53 * 30 = 45.9
            $total = $price - $different_day; //100 -45.9 = 54.1

        }

        if ($user_subscription->status == 1) {
            //add to _balance user
            $user->balance -= $total;
            $user->save();
        }


        //archive old invoice
//        $invoice = Invoice::where('user_subscription_id', $inputs->user_subscription_old_id)
//            ->where('user_id', $inputs->user_id)->first();
//        if ($invoice)
//            $invoice->delete();


    }

    public function changeSubscription($inputs)
    {

        $this->calculateDuration($inputs);
        $data['user_id'] = $inputs->user_id;
        $data['user_subscription_id'] = $inputs->user_subscription_old_id;
        $data['new_subscription_id'] = $inputs->user_subscription_new_id;
        // the new subscription
        return $this->updateData($data);

    }


    public function renewSubscription($inputs)
    {

        try {
            DB::beginTransaction();
            $user_id = $inputs->user_id;
            $user = User::find($user_id);
            $user_subscription_id = $inputs->user_subscription_id;

            $user_subscription = $this->findById($user_subscription_id);
            $subscription = Subscription::find($user_subscription->subscription_id);
            $duration = $this->getDuration($user_subscription->duration);
            $data['start_at'] = $duration['start_at'];
            $data['end_at'] = $duration['end_at'];

            $invoice_inputs = [
                'user_name' => $user->name,
                'subscription_name' => $subscription->name,
                'user_id' => $user_id,
                'user_subscription_id' => $user_subscription->id,
                'duration' => $subscription->duration,
                'total' => $subscription->price,
                'status' => Invoice::STATUS['unpaid'],
                'type' => '1',//subscription
            ];
            $user_subscription->update(['status' => 1, 'start_at' => $data['start_at'], 'end_at' => $data['end_at']]);


            $this->createInvoice($invoice_inputs);
            $this->addToBalance($user->id, $subscription->price);
            DB::commit();
            session()->flash('success', 'تم تجديد الاشتراك بنجاح البيانات بنجاح');
            return redirect()->route('user_subscriptions.index');

        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    public function addToBalance($user_id, $price)
    {

        $user = User::find($user_id);
        $user->balance = $user->balance + $price;
        $user->save();


    }

    public function deleteData($request)
    {


        try {
            $id = $request->user_subscription_old_id;
            $user_subscription = $this->findById($id);
            $user_subscription->update(['status' => 2]);
            $this->calculateDuration($request);


            session()->flash('success', 'تم انهاء الاشتراك بنجاح');
            return redirect()->route('user_subscriptions.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }


    }
}
