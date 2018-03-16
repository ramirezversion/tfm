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

    DB::table('messages')->delete();

    DB::table('messages')->insert(
      [
        'name' => 'hola',
        'email' => 'holamail',
        'message' => 'holamessage'
      ],

      [
        'name' => 'adios',
        'email' => 'adiosmail',
        'message' => 'adiosmessage'
      ]
    );

  }

}
