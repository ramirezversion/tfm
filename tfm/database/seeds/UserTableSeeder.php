<?php

class UserTableSeeder extends Seeder{

  public function run(){

    DB::table('users')->delete();

    DB::table('users')->insert(
      [
        'username' => 'admin',
        'password' => Hash:make('admin'),
        'super' => 'true'
      ],

      [
        'username' => 'readonly',
        'password' => Hash:make('readonly'),
        'super' => 'false'
      ]
    );

  }

}
