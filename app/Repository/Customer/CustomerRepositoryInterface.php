<?php
namespace App\Repository\Customer;

use App\Repository\BaseRepositoryInterface;

interface CustomerRepositoryInterface extends BaseRepositoryInterface {
    public function get();
    public function edit($id);
}
