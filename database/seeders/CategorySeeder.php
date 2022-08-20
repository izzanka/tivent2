<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = ['concert','festival','game','fashion','exhibition','sport','education','culture'];

        for ($i=0; $i < count($categories) ; $i++) { 
            DB::table('categories')->insert([
                'name' => $categories[$i]
            ]);
        }

    }
}
