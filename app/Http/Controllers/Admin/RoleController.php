<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

        $this->middleware('permission:read_roles', ['only' => ['index','show']]);
        $this->middleware('permission:create_roles', ['only' => ['create','store']]);
        $this->middleware('permission:update_roles', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_roles', ['only' => ['destroy']]);

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Role::orderBy('id','DESC')->paginate(5);
        return view('admin.roles.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function search_name(Request $request) {
        // get the search term
        $name = $request->name;
        $role_id = $request->role_id;

        // search the members table
        $patients = Role::where('name', 'Like', "$name")->where('id','!=',$role_id)->exists();



        // return the results
        return Response::json($patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create',compact('permission'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ],['name.required'=>'اسم الصلاحية مطلوب','name.unique'=>'اسم الصلاحية يجب أن لايتكرر','permission.required'=>' الصلاحيات مطلوبة']);
        $role = Role::create(['guard_name' => 'admin','name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
            ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    $permission = Permission::get();
        $role = Role::find($id);
//        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
//            ->where("role_has_permissions.role_id",$id)
//            ->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)  //id
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.show',compact('role','rolePermissions','permission'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id); //$id role name

//        $admin =Admin::find(1);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)  //id
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.edit',compact('role','permission','rolePermissions'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ],['name.required'=>'اسم الصلاحية مطلوب','name.unique'=>'اسم الصلاحية يجب أن لايتكرر','permission.required'=>' الصلاحيات مطلوبة']);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        session()->flash('success', 'تم عملية  تحديث الصلاحيات بنجاح ');
        return redirect()->route('roles.index');;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id ;
        DB::table("roles")->where('id',$id)->delete();
        session()->flash('success',__('تم حذف الصلاحية بنجاح'));
        return redirect()->route('roles.index');;
    }
}
