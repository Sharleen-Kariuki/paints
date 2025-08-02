<?php

namespace App\Listeners;

use App\Events\ApprovedOrder;
use App\Models\User;
use App\Notifications\AdminApprovedAlert;
use App\Notifications\ManufacturerOrderAlert;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendApprovedOrderNotifications
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ApprovedOrder $event): void
    {
          $order = $event->order;

        //notify the manufacturer
         $manufacturer = User::where('role', 'manufacturer')->first();
        if ($manufacturer) {
            $manufacturer->notify(new ManufacturerOrderAlert($order));
        }

        //Notify the admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notify(new AdminApprovedAlert($order));
        }
    }
}
