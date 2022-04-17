<?php

namespace App\Listeners;

use App\Events\LowIngredientStock;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLowIngredientStockMail
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
     * @param  \App\Events\LowIngredientStock  $event
     * @return void
     */
    public function handle(LowIngredientStock $event)
    {
        $ingredient = $event->ingredient;

        Mail::send(new \App\Mail\LowIngredientStock($ingredient));

        $ingredient->update(['alert_email_sent' => true]);
    }
}
