<?php

namespace App\Mail;

use App\Models\Ingredient;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LowIngredientStock extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ingredient)
    {
        $this->ingredient = $ingredient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $merchant = Setting::firstWhere('key', 'merchant')->value;

        return $this->to($merchant->email, 'Omar Kamal')
            ->subject('Low Stock Alert')
            ->markdown('emails.low_ingredient_stock', [
                'merchantName' => $merchant->name,
                'ingredient' => $this->ingredient
            ]);

    }
}
