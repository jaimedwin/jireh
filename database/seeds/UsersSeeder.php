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
            'id' => '1',
            'name' => 'Administrador',
            'email' => 'juridicasjireh@hotmail.com',
            'password' => bcrypt('1234'),
        ]);
    }
}
