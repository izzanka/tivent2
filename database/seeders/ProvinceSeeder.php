<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::withHeaders([
            'key' => env('API_RAJA_ONGKIR_KEY')
        ])->get('http://api.rajaongkir.com/starter/province');

        $provinces = $response['rajaongkir']['results'];

        foreach($provinces as $province){
             $data_province[] = [
                'id' => $province['province_id'],
                'name' => $province['province'],
             ];
        }

        DB::table('provinces')->insert($data_province);
    }
}
