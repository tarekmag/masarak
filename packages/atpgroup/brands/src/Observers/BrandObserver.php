<?php

namespace ATPGroup\Brands\Observers;

use Illuminate\Http\Request;
use ATPGroup\Brands\Models\Brand;

class BrandObserver
{
    /**
     * Handle the Brand "saving" event.
     *
     * @param  \ATPGroup\Brands\Models\Brand  $brand
     * @return void
     */
    public function saving($brand)
    {
        $request = request();
        $brand->fill($request->all());
    }

    /**
     * Handle the Brand "saved" event.
     *
     * @param  \ATPGroup\Brands\Models\Brand  $brand
     * @return void
     */
    public function saved($brand)
    {
        
    }

    /**
     * Handle the Brand "deleting" event.
     *
     * @param  \ATPGroup\Brands\Models\Brand  $brand
     * @return void
     */
    public function deleting($brand)
    {
        //
    }

}
