<?php

namespace ATPGroup\Routes\Rules;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class CheckOldDatesOnRouteSchedule implements Rule
{
    protected $errors;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->errors = collect();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $request = $this->request;
        $scheduleNumber = 1;

        foreach ((isset($request->route_schedule_ids)) ? $request->route_schedule_ids : [] as $key => $route_schedule_id) {
            if ($route_schedule_id == 0) {
                $nowDate = Carbon::now()->startOfDay();

                $startDate = Carbon::parse($request->start_dates[$key]);
                // if (!$startDate->gte($nowDate)) {
                //     $message = __(
                //         "route::language.validation.updateSchedule.checkStartDates",
                //         [
                //             'start_date' => $startDate->format(config('helpers.dateFormat')),
                //             'date_now' => $nowDate->format(config('helpers.dateFormat')),
                //             'start_time' => (isset($request->times[$key])) ? $request->times[$key] : $scheduleNumber
                //         ]
                //     );

                //     $this->errors->push($message);
                // }

                if ($request->end_dates[$key]) {
                    $endDate = Carbon::parse($request->end_dates[$key])->startOfDay();
                    if (!$endDate->gte($startDate)) {
                        $message = __(
                            "route::language.validation.updateSchedule.checkEndDates",
                            [
                                'end_date' => $request->end_dates[$key],
                                'start_date' => $startDate->format(config('helpers.dateFormat')),
                                'start_time' => (isset($request->times[$key])) ? $request->times[$key] : $scheduleNumber
                            ]
                        );

                        $this->errors->push($message);
                    }
                }
            }
            $scheduleNumber++;
        }

        return ($this->errors->count() > 0) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errors->implode(', ');
    }
}
