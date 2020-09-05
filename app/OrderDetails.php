<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'order_code', 'product_id', 'name', 'price', 'quantity', 'coupon', 'feeship'
    ];
    protected $primaryKey = 'id';
    protected $table = 'order_details';
}
