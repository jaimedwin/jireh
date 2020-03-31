<?php

use Illuminate\Database\Seeder;
use App\User;
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

        User::insert([
            'name' => 'Administrador',
            'email' => 'administrador@email.com',
            'password' => bcrypt('1234'),
        ]);
    }
}
