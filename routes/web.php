<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\BtcController;
use GuzzleHttp\Client;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('btc2',[BtcController::class, 'update']);

Route::get('/btc', function () {
    $value = App\Models\Btc::get_api();

    $Btc = App\Models\Btc::find(1);
    $Btc->value = $value;
    $Btc->save();

    $res = DB::table('btcs')->where('name', 'btc')->first();

    dd($res->value);
    
});

Route::get('btc1', function () {
    $client = new Client();
    $url = 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD';
    $response = $client->request('GET', $url);
    $res = json_decode($response->getBody()->getContents())->USD; 
    
    return dd($res); 
});