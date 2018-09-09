<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Jonathan Cuotto', 
                'email' => 'jonathan@email.com',
                'password' => '123456789'
            ]
        );

        factory(App\User::class, 4)->create();
    }
}
