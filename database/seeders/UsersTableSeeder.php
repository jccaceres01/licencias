<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
        'password' => \Hash::make('Password1'),
        'remember_token' => str_random(100)
      ]);

      for($i=1; $i<16; $i++) {
        User::create([
          'name' => 'name '.$i,
          'email' => 'mail'.$i.'@mail.com',
          'password' => \Hash::make('Password1'),
          'remember_token' => str_random(100)
        ]);
      }
    }
}
