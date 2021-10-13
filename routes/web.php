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

Route::get('btc2',[BtcController::class, 'update']);

Route::get('/btc', function () {
    //$tasks = DB::table('tasks')->get();
    //$tasks = App\Models\Task::all();
    //$tasks = App\Models\Task::incomplete();
    //$btc['name'] = 'btc';
    //$btc['value'] = App\Models\Btc::get_api();
    $value = App\Models\Btc::get_api();
    //App\Models\Btc::create($btc);
    
    //DB::table('btcs')->insert( ['name' => 'btc', 'value' => $value] );
    
    //dd($value);
    //return view('tasks.index', compact('btc'));


    //$res = DB::table('btcs')->where('name', 'btc')->get();

    // DB::table('btcs')->where('name', 'btc')->update(array(
    //     'value'=>$value,
    // ));

    $data['name'] = 'btc';
    $data['value'] = $value;

    //$value = App\Models\Btc::set($value);

    $Btc = App\Models\Btc::find(1);

    $Btc->value = $value;

    $Btc->save();

    //dd($value);

    $res = DB::table('btcs')->where('name', 'btc')->first();

    


    dd($res->value);
    
});

Route::get('btc1', function () {
    /*
    $price = DB::table('users')->get();
    
    return dd($price);
    */
    $client = new Client();

    //$client->setSslVerification(false);

    //$client->getClient()->setDefaultOption('config/curl/' . CURLOPT_SSL_VERIFYPEER, false);

     $url = 'https://min-api.cryptocompare.com/data/price?fsym=BTC&tsyms=USD';
    //$url = 'https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=BTC,USD,EUR';
    //$api_key = '&api_key=18b9e066bdd4ab3edf4d4c6cf4cc7d0ded538d0a99ac785571cfdc27da5e32ac';

    //$url .= $api_key;

    $response = $client->request('GET', $url);
    
    
    $res = json_decode($response->getBody()->getContents())->USD; 
    
        return dd($res);
        
});




//Route::get('btc',[BtcController::class, 'index']);
    

Route::get('/', function () {
    return view('welcome');
});