<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class BtcController extends Controller
{
    public static function update(){

        $value = App\Models\Btc::get_api();

        $Btc = App\Models\Btc::find(1);
        //добавить если null, то создание
        $Btc->value = $value;
        $Btc->save();

        return $Btc->value;

    }
}
