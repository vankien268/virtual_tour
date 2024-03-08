<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingFooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'language_id' => '1',
                'key' => 'pagoda',
                'value' => 'Chùa Bái Đính.'
            ],
            [
                'language_id' => '2',
                'key' => 'pagoda',
                'value' => 'Bai Dinh Pagoda.'
            ],
            [
                'language_id' => '1',
                'key' => 'address',
                'value' => 'Địa chỉ: xã Gia Sinh, huyện Gia Viễn, tỉnh Ninh Bình.'
            ],
            [
                'language_id' => '2',
                'key' => 'address',
                'value' => 'Address: Gia Sinh ward, Gia Vien district, Ninh Binh province.'
            ],
        ]);
    }
}
