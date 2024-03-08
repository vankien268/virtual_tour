<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert(
            [
                [
                    'name' => 'Việt Nam',
                    'localization' => 'vn',
                    'code' => 'vn',
                    'status' => 1,
                    'default' => 1
                ],
                [
                    'name' => 'English',
                    'localization' => 'en',
                    'code' => 'en',
                    'status' => 1,
                    'default' => 0
                ],
                [
                    'name' => 'China',
                    'localization' => 'cn',
                    'code' => 'cn',
                    'status' => 1,
                    'default' => 0
                ]
            ]);
    }
}
