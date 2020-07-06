<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'name', 'code', 'qty', 'number', 'condition'
    ];
    protected $primaryKey = 'id';
    protected $table = 'coupon';

}
