<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {

        $this->middleware('permission:read_users', ['only' => ['index','show']]);
        $this->middleware('permission:create_users', ['only' => ['create','store']]);
        $this->middleware('permission:update_users', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_users', ['only' => ['destroy']]);
    }


    public function index()
    {
        $data = User::get();
        return view('admin.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {

        try {
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['status'] = $request->status == 'on' ? 1 : 0;
            $data['verification_id'] = $request->verification_id;

            if ($request->file('image')) {


                $the_file_path = uploadFile('uploads/users', $request->image);
                $data['image'] = $the_file_path;

            }

            User::create($data);

            session()->flash('success','تم اضافة البيانات بنجاح');
            return redirect()->route('users.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        return view('admin.users.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $data = User::find($id);
        return view('admin.users.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        try {
            $user = User::find($id);
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['status'] = $request->status == 'on' ? 1 : 0;
            $data['verification_id'] = $request->verification_id;

            if ($request->file('image')) {


                $the_file_path = uploadFile('uploads/users', $request->image);
                $data['image'] = $the_file_path;

            }

            $user->update($data);

            session()->flash('success','تم تحديث البيانات بنجاح');
            return redirect()->route('users.index');
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
            $user = User::find($id);
            $user->delete();

            session()->flash('success','تم حذف البيانات بنجاح');
            return redirect()->route('users.index');
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }
}
