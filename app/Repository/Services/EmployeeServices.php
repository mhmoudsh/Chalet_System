<?php

namespace App\Repository\Services;

use App\Http\Requests\CatchReceiptRequest;
use App\Interfaces\GeneralInterface;
use App\Models\CatchReceipt;
use App\Models\Employe;
use App\Models\Receipt;
use App\Models\User;
use App\Repository\CatchReceiptRepository;
use App\Repository\EmployeeRepository;
use App\Repository\ReceiptRepository;
use App\Traits\InvoiceTrait;
use Illuminate\Http\Request;

class EmployeeServices implements GeneralInterface
{
    private EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {

        $this->employeeRepository = $employeeRepository;
    }


    public function getData()
    {

        $data = Employe::get();

        return $data;
    }

    public function findById($id)
    {

        $data = Employe::find($id);

        return $data;
    }


    public function saveData($request)
    {
        try {
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['verification_id'] = $request->verification_id;

            if ($request->file('image')) {


                $the_file_path = uploadFile('uploads/employess', $request->image);
                $data['image'] = $the_file_path;

            }
            $this->employeeRepository->storeData($data);


            session()->flash('success', 'تم اضافة البيانات بنجاح');
            return redirect()->route('employees.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }


    public function updateData($request, $id)
    {

        try {
            $employee = Employe::find($id);
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['verification_id'] = $request->verification_id;


            if ($request->file('image')) {


                $the_file_path = uploadFile('uploads/employees', $request->image);
                $data['image'] = $the_file_path;

            }

            $this->employeeRepository->updateData($employee, $data);

            session()->flash('success', 'تم تحديث البيانات بنجاح');
            return redirect()->route('employees.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    public function deleteData($data)
    {
        try {
            $id = $data->id;
            $employee = $this->findById($id);

            $this->employeeRepository->deleteData($employee, $id);

            session()->flash('success', 'تم حذف البيانات بنجاح');
            return redirect()->route('employees.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }
}
