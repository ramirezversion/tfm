<?php

class UserTableSeeder extends Seeder{

  public function run(){

    DB::table('users')->delete();

    DB::table('users')->insert(
      [
        'username' => 'admin',
        'password' => bcrypt('admin'),
        'super' => 'true',
      ],

      [
        'username' => 'readonly',
        'password' => bcrypt('readonly'),
        'super' => 'false',
      ]
    );

  }

}
