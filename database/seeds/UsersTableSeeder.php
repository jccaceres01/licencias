<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'name' => 'Julio Caceres',
        'email' => 'jcesar01@hotmail.es',
        'password' => \Hash::make('password1'),
        'remember_token' => str_random(100)
      ]);
    }
}
