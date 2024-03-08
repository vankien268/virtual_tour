<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelatedLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('related_locations')->insert(
            [
                [
                    'location_id' => 1,
                    'related_location_id' => 2,
                    'position' => 1,
                    'status' => 1,
                ],
                [
                    'location_id' => 1,
                    'related_location_id' => 3,
                    'position' => 1,
                    'status' => 1,
                ],
                [
                    'location_id' => 1,
                    'related_location_id' => 4,
                    'position' => 1,
                    'status' => 1,
                ],
                [
                    'location_id' => 2,
                    'related_location_id' => 3,
                    'position' => 1,
                    'status' => 1,
                ],
                [
                    'location_id' => 2,
                    'related_location_id' => 5,
                    'position' => 1,
                    'status' => 1,
                ],
                [
                    'location_id' => 3,
                    'related_location_id' => 6,
                    'position' => 1,
                    'status' => 1,
                ],
                [
                    'location_id' => 3,
                    'related_location_id' => 7,
                    'position' => 1,
                    'status' => 1,
                ],
                [
                    'location_id' => 4,
                    'related_location_id' => 5,
                    'position' => 1,
                    'status' => 1,
                ],
            ]);
    }
}
