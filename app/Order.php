<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'customer_id', 'shipping_id', 'status', 'note', 'code'
    ];
    protected $primaryKey = 'id';
    protected $table = 'order';
}
