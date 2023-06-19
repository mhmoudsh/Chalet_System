<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employe;
use App\Repository\Services\EmployeeServices;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $empolyee_service;

    public function __construct(EmployeeServices $empolyee_service)
    {
        $this->empolyee_service = $empolyee_service;

        $this->middleware('permission:read_employees', ['only' => ['index','show']]);
        $this->middleware('permission:create_employees', ['only' => ['create','store']]);
        $this->middleware('permission:update_employees', ['only' => ['edit','update']]);
        $this->middleware('permission:delete_employees', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = $this->empolyee_service->getData();
        return view('admin.employees.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        return $this->empolyee_service->saveData($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->empolyee_service->findById($id);

        return view('admin.employees.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $data = $this->empolyee_service->findById($id);

        return view('admin.employees.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id)
    {
    return    $this->empolyee_service->updateData($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        return $this->empolyee_service->deleteData($request);
    }
}
