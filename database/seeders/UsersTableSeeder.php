<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Anatoliy',
                'email' => 'anatoliy.darma@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$FvJBjYJuFDs5XzqinGYDl.86Oq01RQSed/2XwvnQOVcUfzgs270I.',
                'remember_token' => NULL,
                'created_at' => '2022-11-06 15:33:30',
                'updated_at' => '2022-11-06 15:33:30',
            ),
        ));
        
        
    }
}