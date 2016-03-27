<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockCode extends Model
{

    // fillable fields
    protected $fillable = ['rbk_code'];

    // dont need timestamps
    public $timestamps = false;

}
