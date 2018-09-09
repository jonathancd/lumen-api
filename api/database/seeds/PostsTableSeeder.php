<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title' => 'My First Post', 
                'content' => 'lorem ipsum dolor sit ammet',
                'id_user' => 1,
                'id_sport' => 1
            ], [
                'title' => 'My second Post', 
                'content' => 'lorem ipsum dolor sit ammet',
                'id_user' => 1,
                'id_sport' => 1
            ], [
                'title' => 'My third Post', 
                'content' => 'lorem ipsum dolor sit ammet',
                'id_user' => 1,
                'id_sport' => 2
            ]
        ]);
    }
}
