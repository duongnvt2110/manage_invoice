<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\PostFilters;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    //
    protected $guarded = [];

    protected static function booted()
    {
        // static::addGlobalScope('id', function (Builder $builder) {
        //     $builder->where('id', '>', 1);
        // });
    }

    public function scopeFilter($query,PostFilters $filters){
        return $filters->apply($query);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();;
    }

}
