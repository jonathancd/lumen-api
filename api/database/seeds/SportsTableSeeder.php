<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sports')->insert([
            [
                'name' => 'Baseball'
            ], [
                'name' => 'Basketball'
            ], [
                'name' => 'Football'
            ]
        ]);
    }
}
