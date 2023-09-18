<?php

namespace App\Models;

use App\Enums\ConsumeLocation;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // public function setConsumeLocationAttribute($value)
    // {
    //     if (in_array($value, ConsumeLocation::values())) {
    //         $this->attributes['consume_location'] = $value;
    //     }
    // }

    // public function setStatusAttribute($value)
    // {
    //     if (in_array($value, OrderStatus::values())) {
    //         $this->attributes['status'] = $value;
    //     }
    // }
}
