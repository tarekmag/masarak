<?php

namespace ATPGroup\Dashboard\Controllers;

use Carbon\Carbon;
use App\Enums\RouteType;
use Illuminate\Http\Request;
use ATPGroup\Users\Models\User;
use ATPGroup\Routes\Models\Trip;
use ATPGroup\Routes\Models\Route;
use ATPGroup\Drivers\Models\Driver;
use App\Http\Controllers\Controller;
use ATPGroup\Stations\Models\Station;
use ATPGroup\Vehicles\Models\Vehicle;
use Illuminate\Support\Facades\Cache;
use ATPGroup\Companies\Models\Company;
use ATPGroup\Employees\Models\Employee;
use ATPGroup\Suppliers\Models\Supplier;
use ATPGroup\Routes\Models\RouteSchedule;

class DashboardController extends Controller
{
    protected $request;

    /**
     * Clear Admin Cache
     */
    public function clearAdminCache()
    {
        Cache::forget('dashboardGetAdminDashboardStatistics');
        Cache::forget('dashboardGetTripsStatus');
        Cache::forget('dashboardGetTripsReports');

        return redirect()->back()->with('success', __('dashboard::language.message.cleared'));
    }

    /**
     * Clear Company Cache
     */
    public function clearCompanyCache()
    {
        $user = auth()->user();
        Cache::forget('dashboardGetCompanyDashboardStatistics-' . $user->company_id);
        return redirect()->back()->with('success', __('dashboard::language.message.cleared'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->request = $request;
        $user = auth()->user();

        if ($user->is_blank_dashboard) {
            return view('dashboard::blank');
        }

        if ($user->company) {
            return $this->getCompany($user);
        }

        return $this->getAdmin($user);
    }

    /**
     * Admin
     */
    private function getAdmin($user)
    {
        $data = [
            'dashboardStatistics' => $this->getDashboardStatistics(),
            'tripsStatus' => $this->getTripsStatus(),
            'tripsReports' => $this->getTripsReports(),
        ];

        return view('dashboard::admin')->with($data);
    }

    /**
     * Company
     */
    private function getCompany($user)
    {
        $data = [
            'dashboardStatistics' => $this->getCompanyDashboardStatistics($user),
            'tripsReports' => $this->getCompanyTripsReports($user),
        ];

        return view('dashboard::company')->with($data);
    }

    /**
     * Admin (Get dashboard statistics)
     */
    private function getDashboardStatistics()
    {
        // Cache::forget('dashboardGetAdminDashboardStatistics');
        $data = Cache::remember('dashboardGetAdminDashboardStatistics', now()->addHour(), function () {
            $data['drivers'] = Driver::count();
            $data['vehicles'] = Vehicle::count();
            $data['companies'] = Company::parent()->count();
            $data['routes'] = Route::count();
            $data['suppliers'] = Supplier::count();
            $data['stations'] = Station::count();
            $data['employees'] = Employee::count();
            $data['adminUsers'] = User::count();
            $data['totalTrips'] = Trip::count();
            return $data;
        });

        $data['totalLiveTrips'] = Trip::started()->count();
        return $data;
    }

    /**
     * Admin (Get trips with status)
     */
    private function getTripsStatus()
    {
        $tripStatus = collect([
            RouteType::TRIP_STATUS_AVAILABLE,
            RouteType::TRIP_STATUS_NOT_STARTED,
            RouteType::TRIP_STATUS_STARTED,
            RouteType::TRIP_STATUS_COMPLETED,
            RouteType::TRIP_STATUS_CANCELLED,
            RouteType::TRIP_STATUS_STOPPED,
        ]);

        $tripsResults = collect();

        // Cache::forget('dashboardGetTripsStatus');
        return Cache::remember('dashboardGetTripsStatus', now()->addHour(), function () use ($tripStatus, $tripsResults) {
            $tripStatus->each(function ($status) use (&$tripsResults) {
                $tripsCount = Trip::where('status', $status)->count();
                $tripsResults->push(['name' => __('route::language.field.trip.status.' . $status), 'value' => $tripsCount]);
            });

            $statusTranslated = $tripsResults->map(function ($item) {
                return $item['name'];
            });

            return ['all' => json_encode($statusTranslated, JSON_NUMERIC_CHECK), 'result' => json_encode($tripsResults, JSON_NUMERIC_CHECK)];
        });
    }

    /**
     * Admin (Get trips with months report)
     */
    private function getTripsReports()
    {
        $year = now()->format('Y');

        $months = collect(['1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0, '12' => 0]);
        $tripStatus = collect([
            RouteType::TRIP_STATUS_AVAILABLE,
            RouteType::TRIP_STATUS_NOT_STARTED,
            RouteType::TRIP_STATUS_STARTED,
            RouteType::TRIP_STATUS_COMPLETED,
            RouteType::TRIP_STATUS_CANCELLED,
            RouteType::TRIP_STATUS_STOPPED,
        ]);
        $resultAll = collect();

        // Cache::forget('dashboardGetTripsReports');
        return Cache::remember('dashboardGetTripsReports', now()->addDay(), function () use ($year, $months, $tripStatus, &$resultAll) {
            $tripStatus->each(function ($status) use ($year, $months, &$resultAll) {

                $result = $months->map(function ($value, $month) use ($status, $year) {
                    $startDate = Carbon::parse($year . '-' . $month)->startOfDay();
                    $endDate = Carbon::parse($year . '-' . $month)->lastOfMonth()->endOfDay();
                    return Trip::where('status', $status)->whereBetween('trip_date', [$startDate, $endDate])->count();
                });

                $replacedResult = $months->replace($result);

                $resultAll->push([
                    'name' => __('route::language.field.trip.status.' . $status),
                    'type' => 'bar',
                    'data' => $replacedResult->values()->all(),
                    'itemStyle' => ['normal' => ['label' => 'show']],
                ]);
            });

            $statusTranslated = $resultAll->map(function ($item) {
                return $item['name'];
            });

            return ['status' => json_encode($statusTranslated->toArray()), 'result' => json_encode($resultAll->toArray(), JSON_NUMERIC_CHECK)];
        });
    }

    /**
     * Company (Get dashboard statistics)
     */
    private function getCompanyDashboardStatistics($user)
    {
        // Cache::forget('dashboardGetCompanyDashboardStatistics-'.$user->company_id);
        return Cache::remember('dashboardGetCompanyDashboardStatistics-' . $user->company_id, now()->addHour(), function () use ($user) {
            $data['drivers'] = Driver::count();
            $data['vehicles'] = Vehicle::count();
            $data['routes'] = Route::count();
            $data['routeSchedule'] = RouteSchedule::whereIn('route_id', $user->company->routes->pluck('id'))->count();
            $data['employees'] = Employee::count();
            $data['stations'] = Station::count();
            $data['totalCompletedTrips'] = number_format(Trip::completed()->count());
            $data['totalbBudgetCompletedTrips'] = number_format(Trip::completed()->sum('client_price'));
            return $data;
        });
    }

    /**
     * Company (Get trips with months report)
     */
    private function getCompanyTripsReports($user)
    {
        $year = now()->format('Y');
        $months = collect(['1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0, '12' => 0]);
        $resultAll = collect();

        // Cache::forget('dashboardGetCompanyTripsReports-'.$user->company_id);
        return Cache::remember('dashboardGetCompanyTripsReports-' . $user->company_id, now()->addDay(), function () use ($year, $months, &$resultAll) {
            $resultCount = $months->map(function ($value, $month) use ($year) {
                $startDate = Carbon::parse($year . '-' . $month)->startOfDay();
                $endDate = Carbon::parse($year . '-' . $month)->lastOfMonth()->endOfDay();
                return Trip::completed()->whereBetween('trip_date', [$startDate, $endDate])->count();
            });

            $resultCost = $months->map(function ($value, $month) use ($year) {
                $startDate = Carbon::parse($year . '-' . $month)->startOfDay();
                $endDate = Carbon::parse($year . '-' . $month)->lastOfMonth()->endOfDay();
                return Trip::completed()->whereBetween('trip_date', [$startDate, $endDate])->sum('client_price');
            });

            $replacedResultCount = $months->replace($resultCount);
            $replacedResultCost = $months->replace($resultCost);

            $resultAll->push([
                'name' => __('dashboard::language.charts.Total Trips Count'),
                'type' => 'bar',
                'data' => $replacedResultCount->values()->all(),
                'itemStyle' => ['normal' => ['label' => 'show']],
            ]);

            $resultAll->push([
                'name' => __('dashboard::language.charts.Total Trips Budget'),
                'type' => 'bar',
                'data' => $replacedResultCost->values()->all(),
                'itemStyle' => ['normal' => ['label' => 'show']],
            ]);

            $statusTranslated = $resultAll->map(function ($item) {
                return $item['name'];
            });
            return ['status' => json_encode($statusTranslated->toArray()), 'result' => json_encode($resultAll->toArray(), JSON_NUMERIC_CHECK)];
        });
    }
}
