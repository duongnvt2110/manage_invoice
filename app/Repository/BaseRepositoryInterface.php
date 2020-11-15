<?php

namespace App\Repository;

interface BaseRepositoryInterface {

    public function all();

    public function show($id);

    public function create($data);

    public function update($id,$data);

    public function delete($id);

    public function paginate($off);

    public function with($relations);
}
