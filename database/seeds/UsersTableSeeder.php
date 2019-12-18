<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Matteo Meloni',
            'email' => 'matteo.meloni@smart-contact.it',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'avatar' => generateAvatar()
        ]);

        DB::table('users')->insert([
            'name' => 'Mario Rossi',
            'email' => 'mariorossi@mail.xyz',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'avatar' => generateAvatar()
        ]);
    }
}
