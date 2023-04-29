<?php

namespace ATPGroup\Companies\Observers;

use App\Services\CompanyService;
use App\Services\OpenStreetMapService;

class CompanyObserver
{
    /**
     * Handle the Company "saving" event.
     *
     * @param  \ATPGroup\Companies\Models\Company  $company
     * @return void
     */
    public function saving($company)
    {
        $request = request();
        if($request->filled('main_branch'))
        {
            $request->merge(['main_branch' => true]);
        }else{
            $request->merge(['main_branch' => false]);
        }
        if($request->filled('display_employee_image'))
        {
            $request->merge(['display_employee_image' => true]);
        }else{
            $request->merge(['display_employee_image' => false]);
        }
        
        if($request->filled('lat')){
            $response = app(OpenStreetMapService::class)->getCoordinatesAddressTitle($request->lat, $request->lng);
            if($response['status'])
            {
                $data = $response['data'];
                $request->merge(['address_ar' => $data['address_ar'], 'address_en' => $data['address_en']]);
            }
        }

        app(CompanyService::class)->updateLeaderOtherEmployee($request, $company);
        $company->fill($request->all());
    }

    /**
     * Handle the Company "saved" event.
     *
     * @param  \ATPGroup\Companies\Models\Company  $company
     * @return void
     */
    public function saved($company)
    {
        
    }

    /**
     * Handle the Company "deleting" event.
     *
     * @param  \ATPGroup\Companies\Models\Company  $company
     * @return void
     */
    public function deleting($company)
    {
        //
    }

}
