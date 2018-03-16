<?php

class UserMessageSeeder extends Seeder{

  public function run(){

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
