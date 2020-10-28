<?php

namespace App;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    //
    use Auditable;

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

    public function logs(){
        return $this->morphMany(AuditLog::class,'subject_id');
    }
}
