<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
	private const path = __DIR__ . '/sql/categories_seed.sql';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::unprepared(file_get_contents(self::path));
    }
}
