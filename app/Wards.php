<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'type', 'maqh'
    ];
    protected $primaryKey = 'xaid';
    protected $table = 'xaphuongthitran';
}
