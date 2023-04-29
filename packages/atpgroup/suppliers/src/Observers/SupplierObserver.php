<?php

namespace ATPGroup\Suppliers\Observers;

class SupplierObserver
{
    /**
     * Handle the Supplier "saving" event.
     *
     * @param  \ATPGroup\Suppliers\Models\Supplier  $supplier
     * @return void
     */
    public function saving($supplier)
    {
        $request = request();
        $supplier->fill($request->all());
    }

    /**
     * Handle the Supplier "saved" event.
     *
     * @param  \ATPGroup\Suppliers\Models\Supplier  $supplier
     * @return void
     */
    public function saved($supplier)
    {
        
    }

    /**
     * Handle the Supplier "deleting" event.
     *
     * @param  \ATPGroup\Suppliers\Models\Supplier  $supplier
     * @return void
     */
    public function deleting($supplier)
    {
        //
    }

}
