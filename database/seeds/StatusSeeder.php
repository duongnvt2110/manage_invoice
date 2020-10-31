<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $statuses = [
            ['status'=>'Processing'],
            ['status'=>'Analyst Processing'],
            ['status'=>'Analyst Approve'],
            ['status'=>'Analyst Reject'],
            ['status'=>'CFO Processing'],
            ['status'=>'CFO Approve'],
            ['status'=>'CFO Reject'],
            ['status'=>'Approved'],
            ['status'=>'Reject']
        ];

        Status::insert($statuses);
    }
}
