<?php

namespace App\Listeners;

use App\Events\UserOrderItems;
use App\Services\ProductStockManagerService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateRemovingItemsInStock
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserOrderItems  $event
     * @return void
     */
    public function handle(UserOrderItems $event)
    {
        (new ProductStockManagerService($event->userOrder))->removeProductFromStock();
    }
}
