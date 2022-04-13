<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }
}
