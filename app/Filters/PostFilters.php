<?php

namespace App\Filters;

use App\Filters\Filters;

class PostFilters extends Filters{

    protected $filters = ['test'];

    public function test($id){

        return $this->builder->where('category_id','=',$id)->paginate(1);
    }


}
