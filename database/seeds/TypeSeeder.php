<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('types')->insert([
            'type' => 'Danh từ',
        ]);
        DB::table('types')->insert([
            'type' => 'Động từ',
        ]);
        DB::table('types')->insert([
            'type' => 'Tính từ',
        ]);
        DB::table('types')->insert([
            'type' => 'Trạng từ',
        ]);
        DB::table('types')->insert([
            'type' => 'Đại từ',
        ]);
        DB::table('types')->insert([
            'type' => 'Hạn định từ',
        ]);
        DB::table('types')->insert([
            'type' => 'Giới từ',
        ]);
        DB::table('types')->insert([
            'type' => 'Liên từ',
        ]);
    }
}
