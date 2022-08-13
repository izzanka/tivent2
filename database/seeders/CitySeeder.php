<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
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
        ])->get('http://api.rajaongkir.com/starter/city');
        
        $cities =  $response['rajaongkir']['results'];

        foreach($cities as $city){
            $data_city[] = [
               'id' => $city['city_id'],
               'province_id' => $city['province_id'],
               'type' => $city['type'],
               'name' => $city['city_name'],
               'postal_code' => $city['postal_code'],
            ];
        }

       DB::table('cities')->insert($data_city);
    }
}
