<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('zones')->insert(
            [
                [
                    'name' => 'Việt Nam',
                    'address' => 'Việt Nam',
                    'overview' => 'Nước Cộng hoà Xã hội chủ nghĩa Việt Nam là một dải đất hình chữ S, nằm ở trung tâm khu vực Đông Nam Á, ở phía đông bán đảo Đông Dương',
                    'status' => 1,
                ],
            ]);
    }
}
