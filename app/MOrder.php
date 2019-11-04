<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MOrder extends Model
{
    protected $table = "order";

    protected $fillable = [
        'ord_id',
        'ord_mesa',
        'ord_value',
        'ord_status',
        'ord_date'

    ];

    public $timestamps = false;
}
