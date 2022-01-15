<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = json_decode(file_get_contents(__DIR__ .'/../rawjson/data.json'));
        foreach($json as $data){
            DB::table('products')->insert([
                'id_produk' => $data->id_produk,
                'nama_produk' => $data->nama_produk,
                'harga' => (int) $data->harga,
                'kategori' => $data->kategori,
                'status' => $data->status,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
}
