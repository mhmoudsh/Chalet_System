<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesRequest;
use App\Models\Expenses;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{

    public function __construct()
    {

        $this->middleware('permission:read_expenses', ['only' => ['index','show']]);
        $this->middleware('permission:create_expenses', ['only' => ['create','store']]);
        $this->middleware('permission:update_expenses', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_expenses', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Expenses::get();
       return view('admin.expenses.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpensesRequest $request)
    {
        try {
            $data['name'] = $request->name;


            Expenses::create($data);

            session()->flash('success','تم اضافة البيانات بنجاح');
            return redirect()->route('expenses.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpensesRequest $request)
    {

        try {
            $id = $request->id;

            $expenses = Expenses::find($id);
            $data['name'] = $request->name;


            $expenses->update($data);

            session()->flash('success','تم تحديث البيانات بنجاح');
            return redirect()->route('expenses.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            $expenses = Expenses::find($id);
            if($expenses->has('receipts')){
                session()->flash('error','لايمكنك حذف المصروف  لوجود سندات صرف');
                return redirect()->route('expenses.index');
            }

            $expenses->delete();

            session()->flash('success','تم حذف البيانات بنجاح');
            return redirect()->route('expenses.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }
}
