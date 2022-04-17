<?php

namespace App\Models;

use App\Events\LowIngredientStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Mail;

class Ingredient extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function getStockIsLowAttribute(): bool
    {
        return $this->stock <= $this->low_stock_amount;
    }

    public function getShouldAlertLowStockAttribute()
    {
        return $this->stock_is_low && !$this->alert_email_sent;
    }

    public static function boot()
    {
        parent::boot();

        static::updated(function ($ingredient) {
            if ($ingredient->should_alert_low_stock) {
               event(new LowIngredientStock($ingredient));
            }
        });
    }
}
