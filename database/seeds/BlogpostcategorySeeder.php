<?php

use Illuminate\Database\Seeder;

class BlogpostcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogpost_category')->insert([
            'category' => 'tutorial',
        ]);
        DB::table('blogpost_category')->insert([
            'category' => 'solutions',
        ]);
        DB::table('blogpost_category')->insert([
            'category' => 'others',
        ]);
    }
}
