<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    public function orderItemOptions()
    {
        return $this->belongsToMany(OrderItemOption::class);
    }

    public function values()
    {
        return $this->belongsToMany(OptionValue::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_options');
    }
}
