<?php

namespace App\Repository\Services;

use App\Http\Requests\CatchReceiptRequest;
use App\Models\CatchReceipt;
use App\Models\Employe;
use App\Models\Service;
use App\Models\User;
use App\Repository\CatchReceiptRepository;
use App\Repository\ServicesRepository;
use App\Traits\InvoiceTrait;
use Illuminate\Http\Request;

class Services
{
    private ServicesRepository $servicesRepository ;
    public function __construct(ServicesRepository $servicesRepository)
    {

        $this->servicesRepository = $servicesRepository;
    }


    public  function getData(){

       $data =  Service::get() ;
        return $data;
    }


    public  function  saveData($request){

        try {
            $data['name'] = $request->name;
            $data['status'] = $request->status == 'on' ? 1 : 0;

            if ($request->file('image')) {

                $the_file_path = uploadFile('uploads/services', $request->image);
                $data['image'] = $the_file_path;

            }
            $this->servicesRepository->storeData($data);


            session()->flash('success','تم اضافة البيانات بنجاح');
            return redirect()->route('services.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    public function  findById($id){

        return Service::find($id);
    }
    public  function  updateData($request,$id){


        try {
            $id =  $request->id;
            $services = $this->findById($id);
            $data['name'] = $request->name;
            $data['status'] = $request->status == 'on' ? 1 : 0;

            if ($request->file('image')) {

                $the_file_path = uploadFile('uploads/services', $request->image);
                $data['image'] = $the_file_path;

            }


            $this->servicesRepository->updateData($services,$data);

            session()->flash('success','تم تحديث البيانات بنجاح');
            return redirect()->route('services.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }


    public function deleteData($request){

        try {
            $id = $request->id;
            $services = $this->findById($id) ;
            if($services->has('subscriptions')){
                session()->flash('error','لايمكنك حذف الخدمة لانها مستخدمة');
                return redirect()->route('services.index');
            }

            $this->servicesRepository->deleteData($services);
            session()->flash('success','تم حذف البيانات بنجاح');
            return redirect()->route('services.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }

    }
}
