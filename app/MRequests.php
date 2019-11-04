<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MRequests extends Model
{
    protected $table = "requests";

    protected $fillable = [
        'req_id',
        'req_order',
        'req_product',
        'req_qty',
        'req_value'
    ];

    public $timestamps = false;
}
