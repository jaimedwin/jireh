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
        DB::table('users')->delete();
        DB::table('role_user')->delete();

        $adminRole = Role::where('name','admin')->first();
        $userRole = Role::where('name','user')->first();

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
        $user->roles()->attach($userRole);
    }
}
