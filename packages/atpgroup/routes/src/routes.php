<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['namespace' => 'ATPGroup\Routes\Controllers\Admin', 'middleware' => ['web', 'auth', 'partials', 'set.language', 'check.permission']], function () {
    /**
     * Route
     */
    Route::post('route/updateStation/{route}', 'RouteController@updateStation')->name('route.updateStation');
    Route::post('route/updateSchedule/{route}', 'RouteController@updateSchedule')->name('route.updateSchedule');
    Route::get('route/getSchedules/{route}', 'RouteController@getSchedules')->name('route.getSchedules');
    Route::resource('route', 'RouteController')->except(['show']);

    /**
     * Location Requests
     */
    // Route::get('locationEmployeeRequest', 'LocationEmployeeRequestController@index')->name('locationEmployeeRequest.index');
    // Route::post('locationEmployeeRequest/changeStatus', 'LocationEmployeeRequestController@changeStatus')->name('locationEmployeeRequest.changeStatus');
    // Route::delete('locationEmployeeRequest/{locationEmployeeRequest}', 'LocationEmployeeRequestController@destroy')->name('locationEmployeeRequest.destroy');

    /**
     * Assigned Employees
     */
    Route::get('route/assignedEmployee/{routeSchedule}', 'AssignedEmployeeController@index')->name('route.assignedEmployee');

    /**
     * Trip
     */
    Route::get('route/trip/create/{route}', 'TripController@create')->name('route.createTrip');
    Route::get('route/trip/dispatch/{route}', 'TripController@dispatchTrips')->name('route.dispatchTrips');
    Route::post('route/trip/store/{route}', 'TripController@store')->name('route.storeTrip');
    Route::get('route/trip/show/{trip}', 'TripController@show')->name('route.showTrip');
    Route::get('trips', 'TripController@getAllTrips')->name('route.getAllTrips');
    Route::post('route/trip/update/{trip}', 'TripController@update')->name('route.updateTrip');
    Route::post('trips/changeStatus', 'TripController@changeStatus')->name('trips.changeStatus');
    Route::get('trips/getTrips', 'TripController@getTrips')->name('trips.getTrips');
    Route::get('trips/exportPDFTrips', 'TripController@exportPDFTrips')->name('trips.exportPDFTrips');
    Route::get('trips/exportExcelTrips', 'TripController@exportExcelTrips')->name('trips.exportExcelTrips');
    Route::get('liveTracking', 'LiveTrackingController@liveTracking')->name('trips.liveTracking');

});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::group(['namespace' => 'ATPGroup\Routes\Controllers\API', 'prefix' => '/api/trip', 'middleware' => ['auth:api', 'set.api.locale']], function () {
    /**
     * Trip and Driver Tracking
     */
    Route::post('add-driver-coordinate', 'TripController@addDriverCoordinate');
    Route::post('add-trip-coordinate', 'TripController@addTripCoordinate');
    Route::post('arrival-station-time', 'TripController@addArrivalStationTime');
    Route::post('complete-station', 'TripController@addCompleteStation');

    /**
     * Trips List
     */
    Route::get('upcoming', 'TripController@getUpcoming');
    Route::get('future', 'TripController@getFuture');
    Route::get('history', 'TripController@getHistory');
    Route::get('get-single-trip/{trip_id}', 'TripController@getSingleTrip');

    /**
     * Trip Actions
     */
    Route::post('change-status', 'TripController@tripChangeStatus');
    Route::post('update-location-employee', 'TripController@updateLocationEmployee');
    Route::post('driver-confirm', 'TripController@driverConfirm');
});
