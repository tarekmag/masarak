<?php

namespace App\Services;

use App\Services\TripService;
use ATPGroup\Employees\Models\Employee;

class EmployeeService
{
    /**
     * Update false to all other leader in whole company and branch
     *
     * @return string
     */
    public function updateLeaderOtherEmployee($request, $employee)
    {
        if($request->filled('is_leader'))
        {
            Employee::where('company_id', $employee->company_id)->where('branch_id', $employee->branch_id)->where('id', '!=', $employee->id)->update(['is_leader' => false]);
        }
    }

    /**
     * Update false to all other leader in whole company and branch
     *
     * @return string
     */
    public function employeeObject($employee, $routeId = null, $routeScheduleId = null, $isAttended = false)
    {
        if(!$employee)
        {
            return null;
        }
        return [
            'id' => $employee->id,
            'name' => $employee->name,
            'phone' => $employee->phone,
            'email' => $employee->email,
            'image' => $employee->image_url,
            'is_leader' => $employee->is_leader,
            'can_edit' => ($routeScheduleId) ? app(TripService::class)->checkEmployeeCanEditLocation($routeId, $routeScheduleId, $employee->id) : false,
            'is_attended' => $isAttended,
        ];
    }

    /**
     * Retun Employee Name
     *
     * @return string
     */
    public function getEmployeeName($employee)
    {
        $company = $employee->company;
        $branch = $employee->branch;
        if($employee && $company && $branch)
        {
            return '<a href='.route('company.index', ['id' => $company->id]).'> '.$company->name.' </a> | <a href='.route('branch.index', ['id' => $branch->id]).'> '.$branch->name.' </a> <br> <a href='.route('employee.index', ['id' => $employee->id]).'> '.$employee->name.'<br>'.$employee->phone.' </a> ';
        }
        return '';
    }

}
