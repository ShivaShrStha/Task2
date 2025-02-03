<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('options')->insert([
            ['option_name' => 'Male'],
            ['option_name' => 'Female'],
            ['option_name' => 'Other'],
            ['option_name' => 'Parent'],
            ['option_name' => 'Sibling'],
            ['option_name' => 'Spouse'],
            ['option_name' => 'Friend'],
            ['option_name' => 'Single'],
            ['option_name' => 'Married'],
            ['option_name' => 'Divorced'],
            ['option_name' => 'Widowed'],
        ]);
    }
}
