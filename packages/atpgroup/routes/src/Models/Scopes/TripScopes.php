<?php

namespace ATPGroup\Routes\Models\Scopes;

use Carbon\Carbon;
use App\Enums\RouteType;
use Jenssegers\Mongodb\Eloquent\Builder;

trait TripScopes
{
    /**
     * The "booted" method of the model.
     * To get all data base on company or branch
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            if (auth('api')->check() == false && auth()->check() && auth()->user()->role->is_super == false) {
                $user = auth()->user();
                if ($user->company_id) {
                    $builder->where('route.company_id', (int) $user->company_id);
                }
                if ($user->branch_id) {
                    $builder->where('route.branch_id', (int) $user->branch_id);
                }
            }
        });
    }

    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStarted($query)
    {
        return $query->where('status', RouteType::TRIP_STATUS_STARTED);
    }

    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', RouteType::TRIP_STATUS_COMPLETED);
    }

    /**
     * Get Upcoming and History.
     */
    public function scopeFilter($query, $type)
    {
        $today = now()->startOfDay();

        switch ($type) {
            case 'history':
                $query->where('trip_date', '<', $today)->orWhere('status', RouteType::TRIP_STATUS_COMPLETED)->orderBy('trip_time', 'DESC');
                break;

            case 'upcoming':
                $query->where('trip_date', '=', $today)->where('status', '!=', RouteType::TRIP_STATUS_COMPLETED)->orderBy('trip_time', 'ASC');
                break;

            case 'future':
                $query->where('trip_date', '>', $today)->orderBy('trip_time', 'DESC');
                break;
        }
    }

    /**
     * Get all of the searched.
     */
    public function scopeSearch($query, $request)
    {
        foreach ($request->all() as $key => $row) {
            if ($row != '') {
                switch ($key) {
                    case in_array($key, ['start_date', 'end_date']):
                        $startDate = Carbon::parse($request->start_date)->startOfDay();
                        $endDate = Carbon::parse($request->end_date)->endOfDay();
                        $query->whereBetween('trip_date', [$startDate, $endDate]);
                        break;

                    case in_array($key, ['route_id']):
                        $query->where('route_id', (int) $row);
                        break;

                    case in_array($key, ['company_id']):
                        $query->where('route.company_id', (int) $row);
                        break;

                    case in_array($key, ['branch_id']):
                        $query->where('route.branch_id', (int) $row);
                        break;

                    case in_array($key, ['status']):
                        $query->where('status', $row);
                        break;

                    case in_array($key, ['vehicle_id']):
                        $query->where('vehicle_id', (int) $row);
                        break;

                    case in_array($key, ['supplier_id']):
                        $query->where('supplier_id', (int) $row);
                        break;

                    case in_array($key, ['driver_id']):
                        $query->where('driver_id', (int) $row);
                        break;

                    case in_array($key, ['rider_code']):
                        $query->where('rider_code', (string) $row);
                        break;

                    case in_array($key, ['ids']):
                        $query->whereIn('_id', $row);
                        break;

                    case in_array($key, ['bus_model']):
                        $query->where('bus_model_en', 'LIKE', "%{$row}%")->orWhere('bus_model_ar', 'LIKE', "%{$row}%");
                        break;
                }
            }
        }
    }
}
