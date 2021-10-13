<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Btc extends Model
{
    use HasFactory;

    public static function get_api()
    {
        $client = new Client();

        $url = 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD';
        
        $response = $client->request('GET', $url);
        
        $res = json_decode($response->getBody()->getContents())->USD;
        return $res;
    }

    // public function update(array $data)
    // {
    //     $name = $data['name'];
    //     $value = $data['value'];
        
    //     $product = new Btc();
    //     $product->name = $name;
    //     $product->value = $value;
    //     $product->save();

    //     // $res = DB::table('btcs')->where('name', $name)->update(array(
    //     //         'value'=>$value,
    //     // ));

    //     return $product;
    // }

    public function set($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public static function create(array $data)
    {

        DB::table('btc')->insert( ['name' => $data['name'], 'value' => $data['value']] );

        return DB::table('btc')->insert( ['name' => $data['name'], 'value' => $data['value']] );
    }
}
