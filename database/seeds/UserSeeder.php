<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users =  [
            [
                'user_name' => 'admin',
                'user_email' => 'admin@admin.com',
                'user_password' => '$2y$10$crmroUiuL9hDckw9bHMg3Ots26nMZANyiFyZp4s3ARich1e/wsA4S', // 123456
                'user_status' => 1,
                'user_active_key' => Str::random(20),
                'first_login' => now(),
                'last_login' => now(),
                'active_email_at' => now(),
                'remember_token' => Str::random(10),
            ],[
                'user_name' => 'analyst',
                'user_email' => 'analyst@analyst.com',
                'user_password' => '$2y$10$crmroUiuL9hDckw9bHMg3Ots26nMZANyiFyZp4s3ARich1e/wsA4S', // 123456
                'user_status' => 1,
                'user_active_key' => Str::random(20),
                'first_login' => now(),
                'last_login' => now(),
                'active_email_at' => now(),
                'remember_token' => Str::random(10),
            ],[
                'user_name' => 'cfo',
                'user_email' => 'cfo@cfo.com',
                'user_password' => '$2y$10$crmroUiuL9hDckw9bHMg3Ots26nMZANyiFyZp4s3ARich1e/wsA4S', // 123456
                'user_status' => 1,
                'user_active_key' => Str::random(20),
                'first_login' => now(),
                'last_login' => now(),
                'active_email_at' => now(),
                'remember_token' => Str::random(10),
            ]
        ];

        User::insert($users);
        $roles = [
            [
                'name'=>'admin',
                'guard_name'=>'jwt'
            ],
            [
                'name'=>'analyst',
                'guard_name'=>'jwt'
            ],
            [   'name'=>'cfo',
                'guard_name'=>'jwt'
            ],
            [   'name'=>'user',
                'guard_name'=>'jwt'
            ]
        ];
        Role::insert($roles);
        User::where('user_email','admin@admin.com')->first()->syncRoles(['admin']);
    }
}
