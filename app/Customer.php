<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customer extends Model
{
    //
    protected $guarded = [];

    public function getContentAttribute($value){
        return json_decode($value,1);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class,'customer_id','id');
    }

    protected static function getModelEvent(){
        return [
            'updating',
            'creating'
        ];
    }
}
