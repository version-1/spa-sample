<?php

use Illuminate\Http\Request;
use App\Models\Currency;
 use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api'], function() {
    Route::get('rate/{currency}',  function($currency) {
        $res = [ 'currency' => $currency ,'btc' => 0 , 'jpy' => 0 ];
        if ( $res['currency'] === ''){
            $res['currency'] = 'btc';
        }
        $client = new Client();
        $url = "https://coincheck.com/api/rate/${currency}_jpy";
        $response = $client->request('GET',$url);
        $res['jpy'] = json_decode($response->getBody())->rate;

        if($currency != 'btc'){
            $url = "https://coincheck.com/api/rate/${currency}_btc";
            $response = $client->request('GET',$url);
            $res['btc'] = json_decode($response->getBody())->rate;
        }

        if ($response->getStatusCode() === 200) {
            return response()->json($res);
        } else {
            return json_encode(['error']);
        }
    });
    Route::get('currencies',  function() {
        $obj = new Currency();
        $result = $obj->all();
        return json_encode($result);
    });
});
