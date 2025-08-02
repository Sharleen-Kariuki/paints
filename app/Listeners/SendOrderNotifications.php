<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\User;
use App\Notifications\AdminOrderAlert;
use App\Notifications\OrderPlacedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderNotifications
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
    public function handle(OrderPlaced $event): void
    {
        $order = $event->order;

        //notify the user
        $order->user->notify(new OrderPlacedNotification($order));

        //Notify the admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notify(new AdminOrderAlert($order));
        }
    }
}
