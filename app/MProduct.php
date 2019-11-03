<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MProduct extends Model
{
    protected $table = "products";

    protected $fillable = [
        'prod_id',
        'prod_name',
        'prod_price',
        'prod_category',
        'prod_description',
        'prod_visible',
        'prod_delete',
        'prod_image'
    ];

    public $timestamps = false;
}
