<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function __construct()
    {


        $this->middleware('permission:read_admins', ['only' => ['index','show']]);
        $this->middleware('permission:create_admins', ['only' => ['create','store']]);
        $this->middleware('permission:update_admins', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_admins', ['only' => ['destroy']]);



    }
    public function index()
    {
        $data  = Admin::orderby('id','desc')->get();

        return  view('admin.admins.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return  view('admin.admins.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {

        $request->validate([

            'email'=> 'required|email|unique:admins,email',

        ]);
        try{


            $data['name'] = $request->name ;
            $data['email'] = $request->email ;
            $data['phone'] = $request->phone;
            $data['address'] = $request->address;
            $data['status'] = $request->status == 'on' ? 1 : 0;
            $data['roles_name'] = $request->roles_name ;


            $data['password'] = Hash::make($request->password);
            if ($request->has('file')) {
                $request->validate([
                    'file' => 'required|mimes:png,jpg,jpeg,pdf|max:2000',
                ]);

                $the_file_path = uploadFile('uploads/admins', $request->file);
                $data['image'] = $the_file_path;

            }
            $admin = Admin::create($data);
            $admin->assignRole($request->input('roles_name'));
            session()->flash('success',__('site.added_success'));
            return redirect()->route('admins.index');
            // ->with('success','تم اضافة المستخدم بنجاح');

        } catch (\Exception $ex) {

            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Admin::find($id);
        $roles = Role::pluck('name','name')->all();
        $adminRoles = $data->roles->pluck('name','name')->all();
        return view('admin.admins.edit',compact('data','roles','adminRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $admin_id = Admin::where('id',$id)->first();
        $request->validate([
            'email'=> 'required|email|unique:admins,email,'.$admin_id->id,

        ]);
        try{
            $admin = Admin::where('id',$id)->first();
            //check the not exits
            if (empty($admin)) {
                return redirect()->back()->with(['error' => __('site.page_not_found')]);

            }



            $data['name'] = $request->name ;
            $data['email'] = $request->email ;
            $data['phone'] = $request->phone;
            $data['address'] = $request->address;
            $data['status'] = $request->status == 'on' ? 1 : 0;
            $data['roles_name'] = $request->roles_name ;


            if ( trim($request->password) != '') {
                $data['password'] = bcrypt($request->password);
            }

            if ($request->has('image')) {
                $request->validate([
                    'image' => 'required|mimes:png,jpg,jpeg|max:2000',
                ]);
                $the_old_path = $admin->image;
                if (file_exists('uploads/admins/' . $the_old_path) and !empty($the_old_path)) {
                    unlink('uploads/admins/' . $the_old_path);
                }
                $the_file_path = uploadFile('uploads/admins', $request->image);
                $data['image'] = $the_file_path;

            }
            $admin->update($data);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $admin->assignRole($request->input('roles_name'));
            session()->flash('success','تم تحديث البيانات بنجاح');
            return redirect()->route('admins.index');


        } catch (\Exception $ex) {

            return redirect()->back()->with(['error' => $ex->getmessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request)
    {

        try {

            $admin = Admin::find($request->id);
            //check the not exits
            if (empty($admin)) {
                return redirect()->back()->with(['error' =>__('site.page_not_found')]);

            }

            if (file_exists('uploads/admins/'.$admin->image) and !empty($admin->image)) {
                unlink('uploads/admins/'.$admin->image);
            }
            $admin->delete();
            session()->flash('success',__('site.deleted_success'));
            return redirect()->route('admins.index');
        }catch
        (\Exception $ex) {

            return redirect()->back()->with(['error' => $ex->getmessage()]);

        } //
    }
}
