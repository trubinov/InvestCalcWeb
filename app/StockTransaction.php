<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{

    // fillable fields
    protected $fillable = ['stock_id', 's_count', 'price', 'trans_date'];

    // append our attributes
    protected $appends = ['summ'];

    protected $dates = ['trans_date'];

    /**
     * Foreign Key to StockCode table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stock() {
        return $this->belongsTo('App\StockCode', 'stock_id');
    }

    /**
     * Set our summ attribute
     *
     * @return mixed
     */
    public function getSummAttribute() {
        return $this->s_count * $this->price;
    }

}
