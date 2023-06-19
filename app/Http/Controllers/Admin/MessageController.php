<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Message::get();
        $users = User::get();
        return view('admin.sms_message.index', compact('data', 'users'));
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
    public function store(Request $request)
    {
        try {


            $data['user_ids'] = json_encode($request->users);
            $data['content'] = $request->message;
            $data['time_sent'] = $request->time_sent;


            Message::create($data);


            session()->flash('success', 'تم اضافة البيانات بنجاح');
            return redirect()->route('MessageSms.index');
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
    public function update(Request $request, string $id)
    {
        try {
            $id =  $request->id;
            $message =  Message::find($id);

            $data['user_ids'] = json_encode($request->users);
            $data['content'] = $request->message;
            $data['time_sent'] = $request->time_sent;


            $message->update($data);


            session()->flash('success','تم اضافة البيانات بنجاح');
            return redirect()->route('MessageSms.index');
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
            $interval =  Message::find($id)->delete();

            session()->flash('success','تم حذف البيانات بنجاح');
            return redirect()->route('MessageSms.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }
}
