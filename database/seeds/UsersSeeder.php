<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;  
use Illuminate\Support\Str;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name','admin')->first();
        $userRole1 = Role::where('name','user')->first();
        $userRole2 = Role::where('name','download_csv')->first();
        $userRole3 = Role::where('name','delete')->first();

        $admin = User::create([
                'name' => 'Administrador',
                'email' => 'juridicasjireh@hotmail.com',
                'password' => bcrypt('1234'),
                'remember_token' => Str::random(60),
            
        ]);

        $user = User::create([
                'name' => 'Manuel',
                'email' => 'manuel@juridicasjireh.com',
                'password' => bcrypt('1234'),
                'remember_token' => Str::random(60),
            
        ]);

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole1);
        $user->roles()->attach($userRole2);
        $user->roles()->attach($userRole3);
    }
}
