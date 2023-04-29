<?php

namespace ATPGroup\PricingLists\Observers;

class PricingListObserver
{
    /**
     * Handle the Pricing List "saving" event.
     *
     * @param \ATPGroup\PricingLists\Models\PricingList $pricingList
     * @return void
     */
    public function saving($pricingList)
    {
        $request = request();
        $pricingList->fill($request->all());
    }

    /**
     * Handle the Pricing List "saved" event.
     *
     * @param \ATPGroup\PricingLists\Models\PricingList $pricingList
     * @return void
     */
    public function saved($pricingList)
    {

    }

    /**
     * Handle the Pricing List "deleting" event.
     *
     * @param \ATPGroup\PricingLists\Models\PricingList $pricingList
     * @return void
     */
    public function deleting($pricingList)
    {
        //
    }

}
