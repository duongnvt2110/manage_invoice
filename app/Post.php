<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\PostFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Post extends Model
{
    //
    protected $guarded = [];

    protected static function booted()
    {
        // static::addGlobalScope('id', function (Builder $builder) {
        //     $builder->where('id', '>', 1);
        // });
        foreach (static::getModelEvent() as $eventName) {
            static::$eventName(function (Model $model) use ($eventName) {
                $model->content = htmlentities($model->content);
                $model->slug = Str::slug($model->title,'-');
                $model->created_by = auth()->user()->id;
                $model->updated_by = auth()->user()->id;
            });
        }

    }

    public function scopeFilter($query,PostFilters $filters){
        return $filters->apply($query);
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }

    protected static function getModelEvent(){
        return [
            'updating',
            'creating'
        ];
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
