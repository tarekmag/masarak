<?php

namespace ATPGroup\Employees\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ATPGroup\Companies\Models\Company;
use ATPGroup\Employees\Models\Employee;
use ATPGroup\Employees\Requests\StoreEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['result'] = Employee::search($request)->orderBy('id', 'DESC')->paginate(config('helpers.paginate'));
        return view('employee::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee::create')->with('employee', new Employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = new Employee;
        $employee->save();
        return redirect()->route('employee.index')->with('success', __('employee::language.message.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Employee $employee)
    {
        return view('employee::edit')->with('employee', $employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        $employee->save();
        return redirect()->route('employee.index')->with('success', __('employee::language.message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(['status' => 'ok', 'message' => __('employee::language.message.deleted')]);
    }
}
