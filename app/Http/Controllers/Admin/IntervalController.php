<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IntervalRequest;
use App\Models\Interval;
use Illuminate\Http\Request;

class IntervalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Interval::get();
        return view('admin.settings.interval',compact('data'));
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
    public function store(IntervalRequest $request)
    {
        try {



            $data['name'] = $request->name;
            $data['price'] = $request->price;
            $data['start_time'] = $request->start_time;
            $data['end_time'] = $request->end_time;


            Interval::create($data);


            session()->flash('success','تم اضافة البيانات بنجاح');
            return redirect()->route('Intervals.index');
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
    public function update(IntervalRequest $request)
    {


        try {
            $id =  $request->id;
            $interval =  Interval::find($id);
            $data['name'] = $request->name;
            $data['price'] = $request->price;
            $data['start_time'] = $request->start_time;
            $data['end_time'] = $request->end_time;


            $interval->update($data);


            session()->flash('success','تم اضافة البيانات بنجاح');
            return redirect()->route('Intervals.index');
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
            $interval =  Interval::find($id)->delete();

            session()->flash('success','تم حذف البيانات بنجاح');
            return redirect()->route('Intervals.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }
}
