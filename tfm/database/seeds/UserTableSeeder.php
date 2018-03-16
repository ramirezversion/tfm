<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder{

  public function run(){

    DB::table('users')->delete();

    DB::table('users')->insert(
      [
        'username' => 'admin',
        'password' => bcrypt('admin'),
        'super' => '1',
      ],

      [
        'username' => 'readonly',
        'password' => bcrypt('readonly'),
        'super' => '0',
      ]
    );

  }

}
