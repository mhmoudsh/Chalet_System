<?php

namespace App\Repository\Services;

use App\Http\Requests\CatchReceiptRequest;
use App\Models\CatchReceipt;
use App\Models\Employe;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\User;
use App\Repository\CatchReceiptRepository;
use App\Repository\ServicesRepository;
use App\Repository\SubscriptionRepository;
use App\Traits\InvoiceTrait;
use Illuminate\Http\Request;

class SubscriptionServices
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {

        $this->subscriptionRepository = $subscriptionRepository;
    }


    public function getData()
    {

        $services = Service::get();
        $data = Subscription::get();
        return ['data' => $data, 'services' => $services];
    }


    public function saveData($request)
    {
        try {
            $data['name'] = $request->name;
            $data['price'] = $request->price;
            $data['duration'] = $request->duration;
            $data['service_ids'] = json_encode($request->service_ids);
            $data['status'] = $request->status == 'on' ? 1 : 0;


            $this->subscriptionRepository->storeData($data);

            session()->flash('success', 'تم اضافة البيانات بنجاح');
            return redirect()->route('subscriptions.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    public function findById($id)
    {

        return Subscription::find($id);
    }

    public function updateData($request, $id)
    {
        try {
            $subscription = $this->findById($request->id);
            $data['name'] = $request->name;
            $data['price'] = $request->price;
            $data['duration'] = $request->duration;
            $data['service_ids'] = json_encode($request->service_ids);
            $data['status'] = $request->status == 'on' ? 1 : 0;


            $this->subscriptionRepository->updateData($subscription, $data);
            session()->flash('success', 'تم تحديث البيانات بنجاح');
            return redirect()->route('subscriptions.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }

    }


    public function deleteData($request)
    {


        try {
            $subscription = $this->findById($request->id);
            if($subscription->has('userSubscriptions')){
                session()->flash('error','لايمكنك حذف الاشتراك لانها مستخدمة');
                return redirect()->route('subscriptions.index');
            }
            $this->subscriptionRepository->deleteData($subscription);


            session()->flash('success', 'تم حذف البيانات بنجاح');
            return redirect()->route('subscriptions.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }


    }
}
