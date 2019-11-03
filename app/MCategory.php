<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MCategory extends Model
{
    protected $table = "category";
    protected $fillable = ['cat_id','cat_name','cat_active','cat_delete'];

    public $timestamps = false;
}
