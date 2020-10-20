<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $guarded = [];

    public function loanApplication(){
        return $this->belongsTo(LoanApplication::class,'id','status_id');
    }
}
