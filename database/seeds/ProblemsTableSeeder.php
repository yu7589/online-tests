<?php

use Illuminate\Database\Seeder;

class ProblemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //problems数据库填充器
        DB::table('problems')->insert([
            'chapter' => str_random(10),
            'section' => str_random(10),
            'stem' => str_random(10),
            'picture_url' => str_random(10),
            'answer' => str_random(10),
            'type' => str_random(10),
            'difficulty'=> 3,
            'author' => str_random(10),
        ]);
    }
}
