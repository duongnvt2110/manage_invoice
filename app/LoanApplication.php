<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    //
    protected $guarded = [];

    public function status(){
        return $this->belongsTo(Status::class,'status_id','id');
    }

    public function userAnalyst(){
        return $this->belongsTo(User::class,'analyst_id','id');
    }

    public function userCfo(){
        return $this->belongsTo(User::class,'cfo_id','id');
    }
}
