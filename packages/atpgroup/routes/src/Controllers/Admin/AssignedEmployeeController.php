<?php

namespace ATPGroup\Routes\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ATPGroup\Routes\Models\RouteSchedule;
use ATPGroup\Routes\Models\RouteScheduleEmployee;

class AssignedEmployeeController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, RouteSchedule $routeSchedule)
    {
        $data['routeSchedule'] = $routeSchedule;
        return view ('route::assignedEmployee.index')->with($data);
    }
}
