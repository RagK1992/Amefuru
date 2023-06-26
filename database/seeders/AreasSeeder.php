<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $areas = [
            ['prefecture' => '北海道', 'area_id' => 1],
            ['prefecture' => '青森県', 'area_id' => 2],
            ['prefecture' => '岩手県', 'area_id' => 3],
            ['prefecture' => '宮城道', 'area_id' => 4],
            ['prefecture' => '秋田県', 'area_id' => 5],
            ['prefecture' => '山形県', 'area_id' => 6],
            ['prefecture' => '福島道', 'area_id' => 7],
            ['prefecture' => '茨城県', 'area_id' => 8],
            ['prefecture' => '栃木県', 'area_id' => 9],
            ['prefecture' => '群馬道', 'area_id' => 10],
            ['prefecture' => '埼玉県', 'area_id' => 11],
            ['prefecture' => '千葉県', 'area_id' => 12],
            ['prefecture' => '東京都', 'area_id' => 13],
            ['prefecture' => '神奈川県', 'area_id' => 14],
            ['prefecture' => '新潟県', 'area_id' => 15],
            ['prefecture' => '富山県', 'area_id' => 16],
            ['prefecture' => '石川県', 'area_id' => 17],
            ['prefecture' => '福井県', 'area_id' => 18],
            ['prefecture' => '山梨県', 'area_id' => 19],
            ['prefecture' => '長野県', 'area_id' => 20],
            ['prefecture' => '岐阜県', 'area_id' => 21],
            ['prefecture' => '静岡県', 'area_id' => 22],
            ['prefecture' => '愛知県', 'area_id' => 23],
            ['prefecture' => '三重県', 'area_id' => 24],
            ['prefecture' => '滋賀県', 'area_id' => 25],
            ['prefecture' => '京都府', 'area_id' => 26],
            ['prefecture' => '大阪府', 'area_id' => 27],
            ['prefecture' => '兵庫県', 'area_id' => 28],
            ['prefecture' => '奈良県', 'area_id' => 29],
            ['prefecture' => '和歌山県', 'area_id' => 30],
            ['prefecture' => '鳥取県', 'area_id' => 31],
            ['prefecture' => '島根県', 'area_id' => 32],
            ['prefecture' => '岡山県', 'area_id' => 33],
            ['prefecture' => '広島県', 'area_id' => 34],
            ['prefecture' => '山口県', 'area_id' => 35],
            ['prefecture' => '徳島県', 'area_id' => 36],
            ['prefecture' => '香川県', 'area_id' => 37],
            ['prefecture' => '愛媛県', 'area_id' => 38],
            ['prefecture' => '高知県', 'area_id' => 39],
            ['prefecture' => '福岡県', 'area_id' => 40],
            ['prefecture' => '佐賀県', 'area_id' => 41],
            ['prefecture' => '長崎県', 'area_id' => 42],
            ['prefecture' => '熊本県', 'area_id' => 43],
            ['prefecture' => '大分県', 'area_id' => 44],
            ['prefecture' => '宮崎県', 'area_id' => 45],
            ['prefecture' => '鹿児島県', 'area_id' => 46],
            ['prefecture' => '沖縄県', 'area_id' => 47],
        ];

        DB::table('areas')->insert($areas);
    }
}
