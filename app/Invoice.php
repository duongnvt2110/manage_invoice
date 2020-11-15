<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $guarded = [];

    public function customer(){
        return $this->belongsTo(Customer::class,'id','customer_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
