<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        User::truncate();
        Role::truncate();
        Permission::truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::statement("SET foreign_key_checks=1");

        
        $userSAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin',
            'password' => Hash::make('Newway@2023'),
        ]);
        $userAdmin = User::create([
            'name' => 'Admin',
            'email' => 'admin',
            'password' => Hash::make('Newway@2023'),
        ]);
        $user = User::create([
            'name' => 'User',
            'email' => 'user',
            'password' => Hash::make('Newway@2023'),
        ]);

    }
}
