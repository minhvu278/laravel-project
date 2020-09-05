<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'address', 'phone', 'email', 'notes', 'method'
    ];
    protected $primaryKey = 'id';
    protected $table = 'shipping';
}
