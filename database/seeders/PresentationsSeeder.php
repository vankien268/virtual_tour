<?php

namespace Database\Seeders;

use App\Models\Presentation;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresentationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        DB::table('presentations')->insert([
           [
               'location_id' => 1,
               'language_id' => 1,
               'language_code' => $this->faker->numerify('code-####'),
               'name' => $this->faker->sentence(3),
               'overview' => $this->faker->sentence(3),
               'content' => $this->faker->paragraph(),
               'audio' => 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/172245994',
               'video' => 'https://www.youtube.com/embed/5Jm9g0YdGDU',
               'status' => 1,
               'image' => $this->faker->imageUrl(640, 480, 'animals', true)
           ],
            [
                'location_id' => 1,
                'language_id' => 2,
                'language_code' => $this->faker->numerify('code-####'),
                'name' => $this->faker->sentence(3),
                'overview' => $this->faker->sentence(3),
                'content' => $this->faker->paragraph(),
                'audio' => 'https://chiasenhac.vn/embed/mp3/hana-cam-tien-tvk-qinn/vuong-van-tiktok-remix-tsv66wvwqkk929.html',
                'video' => 'https://www.youtube.com/embed/5Jm9g0YdGDU',
                'status' => 1,
                'image' => $this->faker->imageUrl(640, 480, 'animals', true)

            ],
            [
                'location_id' => 1,
                'language_id' => 3,
                'language_code' => $this->faker->numerify('code-####'),
                'name' => $this->faker->sentence(3),
                'overview' => $this->faker->sentence(3),
                'content' => $this->faker->paragraph(),
                'audio' => 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/172245994',
                'video' => 'https://www.youtube.com/embed/5Jm9g0YdGDU',
                'status' => 1,
                'image' => $this->faker->imageUrl(640, 480, 'animals', true)
            ],
            [
                'location_id' => 2,
                'language_id' => 1,
                'language_code' => $this->faker->numerify('code-####'),
                'name' => $this->faker->sentence(3),
                'overview' => $this->faker->sentence(3),
                'content' => $this->faker->paragraph(),
                'audio' => 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/172245994',
                'video' => 'https://www.youtube.com/embed/5Jm9g0YdGDU',
                'status' => 1,
                'image' => $this->faker->imageUrl(640, 480, 'animals', true)
            ],
            [
                'location_id' => 2,
                'language_id' => 2,
                'language_code' => $this->faker->numerify('code-####'),
                'name' => $this->faker->sentence(3),
                'overview' => $this->faker->sentence(3),
                'content' => $this->faker->paragraph(),
                'audio' => 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/172245994',
                'video' => 'https://www.youtube.com/embed/5Jm9g0YdGDU',
                'status' => 1,
                'image' => $this->faker->imageUrl(640, 480, 'animals', true)
            ],
            [
                'location_id' => 2,
                'language_id' => 3,
                'language_code' => $this->faker->numerify('code-####'),
                'name' => $this->faker->sentence(3),
                'overview' => $this->faker->sentence(3),
                'content' => $this->faker->paragraph(),
                'audio' => 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/172245994',
                'video' => 'https://www.youtube.com/embed/5Jm9g0YdGDU',
                'status' => 1,
                'image' => $this->faker->imageUrl(640, 480, 'animals', true)
            ],
            [
                'location_id' => 3,
                'language_id' => 1,
                'language_code' => $this->faker->numerify('code-####'),
                'name' => $this->faker->sentence(3),
                'overview' => $this->faker->sentence(3),
                'content' => $this->faker->paragraph(),
                'audio' => 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/172245994',
                'video' => 'https://www.youtube.com/embed/5Jm9g0YdGDU',
                'status' => 1,
                'image' => $this->faker->imageUrl(640, 480, 'animals', true)
            ],
            [
                'location_id' => 3,
                'language_id' => 2,
                'language_code' => $this->faker->numerify('code-####'),
                'name' => $this->faker->sentence(3),
                'overview' => $this->faker->sentence(3),
                'content' => $this->faker->paragraph(),
                'audio' => 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/172245994',
                'video' => 'https://www.youtube.com/embed/5Jm9g0YdGDU',
                'status' => 1,
                'image' => $this->faker->imageUrl(640, 480, 'animals', true)
            ],
            [
                'location_id' => 3,
                'language_id' => 2,
                'language_code' => $this->faker->numerify('code-####'),
                'name' => $this->faker->sentence(3),
                'overview' => $this->faker->sentence(3),
                'content' => $this->faker->paragraph(),
                'audio' => 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/172245994',
                'video' => 'https://www.youtube.com/embed/5Jm9g0YdGDU',
                'status' => 1,
                'image' => $this->faker->imageUrl(640, 480, 'animals', true)
            ],
            [
                'location_id' => 3,
                'language_id' => 3,
                'language_code' => $this->faker->numerify('code-####'),
                'name' => $this->faker->sentence(3),
                'overview' => $this->faker->sentence(3),
                'content' => $this->faker->paragraph(),
                'audio' => 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/172245994',
                'video' => 'https://www.youtube.com/embed/5Jm9g0YdGDU',
                'status' => 1,
                'image' => $this->faker->imageUrl(640, 480, 'animals', true)
            ],
       ]);
    }
}
