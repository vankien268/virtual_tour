<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        DB::table('locations')->insert(
            [
                [
                    'zone_id' => 1,
                    'name' => 'Haiphong',
                    'address' => 'Haiphong',
                    'lat' => '20.865139',
                    'long' => '106.683830',
                    'overview' => $this->faker->sentence(),
                    'position' => 1,
                    'status' => 1,
                ],
                [
                    'zone_id' => 2,
                    'name' => 'Hanoi',
                    'address' => 'Hanoi',
                    'lat' => '21.028511',
                    'long' => '105.804817',
                    'overview' => $this->faker->sentence(),
                    'position' => 2,
                    'status' => 1,
                ],
                [
                    'zone_id' => 1,
                    'name' => 'Ha Long',
                    'address' => 'Ha Long',
                    'lat' => '20.959902',
                    'long' => '107.042542',
                    'overview' => $this->faker->sentence(),
                    'position' => 4,
                    'status' => 1,
                ],
                [
                    'zone_id' => 1,
                    'name' => 'Da Nang',
                    'address' => 'Da Nang',
                    'lat' => '16.047079',
                    'long' => '108.206230',
                    'overview' => $this->faker->sentence(),
                    'position' => 5,
                    'status' => 1,
                ],
                [
                    'zone_id' => 1,
                    'name' => 'Cần Thơ',
                    'address' => 'Cần Thơ',
                    'lat' => '10.045162',
                    'long' => '105.746857',
                    'overview' => $this->faker->sentence(),
                    'position' => 6,
                    'status' => 1,
                ],
                [
                    'zone_id' => 1,
                    'name' => 'Ho Chi Minh',
                    'address' => 'Ho Chi Minh',
                    'lat' => '	10.762622',
                    'long' => '	10.762622',
                    'overview' => $this->faker->sentence(),
                    'position' => 7,
                    'status' => 1,
                ],
            ]);
    }
}
