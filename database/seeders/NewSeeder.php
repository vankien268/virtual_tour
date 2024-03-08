<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        DB::table('news')->insert([
                [
                    'location_id' => 1,
                    'language_id' => 1,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)
                ],
                [
                    'location_id' => 1,
                    'language_id' => 2,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)
                ],
                [
                    'location_id' => 1,
                    'language_id' => 2,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)
                ],
                [
                    'location_id' => 2,
                    'language_id' => 1,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)
                ],
                [
                    'location_id' => 2,
                    'language_id' => 2,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)
                ],
                [
                    'location_id' => 2,
                    'language_id' => 2,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)
                ],
                [
                    'location_id' => 3,
                    'language_id' => 1,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)
                ],
                [
                    'location_id' => 3,
                    'language_id' => 2,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)
                ],
                [
                    'location_id' => 4,
                    'language_id' => 1,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)
                ],
                [
                    'location_id' => 4,
                    'language_id' => 2,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)
                ],
                [
                    'location_id' => 5,
                    'language_id' => 1,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)

                ],
                [
                    'location_id' => 5,
                    'language_id' => 2,
                    'name' => $this->faker->sentence(2),
                    'slug' => Str::slug($this->faker->sentence(2), '-'),
                    'content' => $this->faker->paragraph(),
                    'status' => 1,
                    'image' => $this->faker->imageUrl(640, 480, 'animals', true)

                ],
            ]
        );
    }
}
