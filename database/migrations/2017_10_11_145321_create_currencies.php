<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Currency;

class CreateCurrencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('name_ja');
            $table->string('name_en');
            $table->timestamps();
        });

        $data = [
            ['key' => 'btc','name_ja' => 'ビットコイン' , 'name_en' => 'BitCoin'],
            ['key' => 'bch','name_ja' => 'ビットコインキャッシュ' , 'name_en' => 'BitCoinCash'],
            ['key' => 'eth','name_ja' => 'イーサリアム' , 'name_en' => 'Etherium'],
            ['key' => 'etc','name_ja' => 'イーサリアムクラシック' , 'name_en' => 'Etherium Classic'],
            ['key' => 'dao','name_ja' => 'DAO' , 'name_en' => 'DAO'],
            ['key' => 'lsk','name_ja' => 'リスクコイン' , 'name_en' => 'BitCoin'],
            ['key' => 'fct','name_ja' => 'ファクトム' , 'name_en' => 'Factom'],
            ['key' => 'xmr','name_ja' => 'モネロ' , 'name_en' => 'Monero'],
            ['key' => 'rep','name_ja' => 'オーガー' , 'name_en' => 'Augur'],
            ['key' => 'xrp','name_ja' => 'リップル' , 'name_en' => 'Ripple'],
            ['key' => 'zec','name_ja' => 'ジーキャッシュ' , 'name_en' => 'Zcach'],
            ['key' => 'xem','name_ja' => 'ネム' , 'name_en' => 'Xem'],
            ['key' => 'ltc','name_ja' => 'ライトコイン' , 'name_en' => 'Litecoin'],
            ['key' => 'dash','name_ja' => 'DASH' , 'name_en' => 'DASH'],
        ];
        Currency::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('currencies');
    }
}
