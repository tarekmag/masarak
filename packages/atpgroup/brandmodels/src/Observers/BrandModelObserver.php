<?php

namespace ATPGroup\BrandModels\Observers;

class BrandModelObserver
{
    /**
     * Handle the BrandeModel "saving" event.
     *
     * @param  \ATPGroup\BrandModels\Models\BrandeModel  $brandeModel
     * @return void
     */
    public function saving($brandeModel)
    {
        $request = request();
        $brandeModel->fill($request->all());
    }

    /**
     * Handle the BrandeModel "saved" event.
     *
     * @param  \ATPGroup\BrandModels\Models\BrandeModel  $brandeModel
     * @return void
     */
    public function saved($brandeModel)
    {
        
    }

    /**
     * Handle the BrandeModel "deleting" event.
     *
     * @param  \ATPGroup\BrandModels\Models\BrandeModel  $brandeModel
     * @return void
     */
    public function deleting($brandeModel)
    {
        //
    }

}
