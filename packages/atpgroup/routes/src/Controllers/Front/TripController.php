<?php

namespace ATPGroup\Routes\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ATPGroup\Routes\Requests\Admin\EmployeeCancelTripRequest;

class TripController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function employeeCancelTrip(Request $request)
  {
    return view('route::front.employee-cancel-trip');
  }

  
}
