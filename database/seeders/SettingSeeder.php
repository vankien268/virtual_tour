<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
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
               'language_id'=>'1',
               'key'=>'home',
               'value'=>'Trang chủ.'
           ],
            [
                'language_id'=>'2',
                'key'=>'home',
                'value'=>'Home.'
            ],
            [
                'language_id'=>'1',
                'key'=>'list-related-location',
                'value'=>'Danh sách địa điểm lân cận.'
            ],
            [
                'language_id'=>'2',
                'key'=>'list-related-location',
                'value'=>'List of nearby locations.'
            ],
            [
                'language_id'=>'1',
                'key'=>'list-related-zone',
                'value'=>'Danh sách địa điểm cùng hệ thống.'
            ],
            [
                'language_id'=>'2',
                'key'=>'list-related-zone',
                'value'=>'List of locations in the same system..'
            ],
            [
                'language_id'=>'1',
                'key'=>'alert-location',
                'value'=>'Hiện chưa có thuyết minh cho ngôn ngữ: '
            ],
            [
                'language_id'=>'2',
                'key'=>'alert-location',
                'value'=>'There are currently no voiceovers for the language: '
            ],
            [
                'language_id'=>'1',
                'key'=>'alert-related-location',
                'value'=>'Hiện tại chưa có địa điểm nào lân cận.'
            ],
            [
                'language_id'=>'2',
                'key'=>'alert-related-location',
                'value'=>'There are currently no locations nearby.'
            ],
            [
                'language_id'=>'1',
                'key'=>'alert-related-zone',
                'value'=>'Hiện tại chưa có địa điểm nào cùng hệ thống.'
            ],
            [
                'language_id'=>'2',
                'key'=>'alert-related-zone',
                'value'=>'There are currently no locations in the system.'
            ],
            [
                'language_id'=>'1',
                'key'=>'top-location',
                'value'=>'Top 5 địa điểm.'
            ],
            [
                'language_id'=>'2',
                'key'=>'top-location',
                'value'=>'Top 5 places.'
            ],
            [
                'language_id'=>'1',
                'key'=>'detail',
                'value'=>'Chi tiết.'
            ],
            [
                'language_id'=>'2',
                'key'=>'detail',
                'value'=>'Detail.'
            ],
            [
                'language_id'=>'1',
                'key'=>'top-news',
                'value'=>'Tin mới nhất.'
            ],
            [
                'language_id'=>'2',
                'key'=>'top-news',
                'value'=>'Latest news.'
            ],
            [
                'language_id'=>'1',
                'key'=>'see-more',
                'value'=>'Xem thêm.'
            ],
            [
                'language_id'=>'2',
                'key'=>'see-more',
                'value'=>'See more.'
            ],

        ]);
    }
}
