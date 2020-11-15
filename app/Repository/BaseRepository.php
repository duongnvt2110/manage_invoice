<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    protected $model;
    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

     /**
     * all
     *
     * @return void
     */
    public function all(){
        return $this->model->all();
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id){
        return $this->model->findOrFail($id);
    }

    /**
     * create
     *
     * @param  mixed $data
     * @return void
     */
    public function create($data){
        return $this->model->firstOrCreate([
            $data
        ])->where();
    }

    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return void
     */
    public function update($id,$data){
        return $this->model->find($id)->update([
            $data
        ]);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id){
        return $this->model->find($id)->delete();
    }

    /**
     * paginate
     *
     * @param  mixed $off
     * @return void
     */
    public function paginate($off){
        return $this->model->paginate($off);
    }

    /**
     * with
     *
     * @param  mixed $relations
     * @return void
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
