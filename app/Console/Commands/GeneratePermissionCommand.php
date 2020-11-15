<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class GeneratePermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->generatePermissionsData();
    }

    public function getModel(){
        $app_path = app_path();
        $permission_name = [];
        $results = scandir($app_path);
        foreach($results as $result){
            if(strpos($result,'php')){
                $permission_name[] = strtolower(str_replace('.php','',$result));
            }
        }
        return $permission_name;
    }

    public function generatePermissionsData(){
        $permissonData = $this->getModel();
        $permission_config_name = config('cms.names');
        $permissons = [];
        foreach($permissonData as $modelName){
            $permissons = array_merge($permissons,str_replace('{{model}}',$modelName,$permission_config_name));
        }
        foreach($permissons as $permisson_name){
            Permission::updateOrCreate([
                'name'=>$permisson_name
            ]);
        }
    }
}
