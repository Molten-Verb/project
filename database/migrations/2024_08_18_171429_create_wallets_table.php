<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('USD')->nullable();
            $table->string('EUR')->nullable();
            $table->string('BGN')->nullable();
            $table->string('BRL')->nullable();
            $table->string('CAD')->nullable();
            $table->string('CHF')->nullable();
            $table->string('CNY')->nullable();
            $table->string('CZK')->nullable();
            $table->string('DKK')->nullable();
            $table->string('GBP')->nullable();
            $table->string('HKD')->nullable();
            $table->string('HRK')->nullable();
            $table->string('HUF')->nullable();
            $table->string('IDR')->nullable();
            $table->string('ILS')->nullable();
            $table->string('INR')->nullable();
            $table->string('ISK')->nullable();
            $table->string('JPY')->nullable();
            $table->string('KRW')->nullable();
            $table->string('MXN')->nullable();
            $table->string('MYR')->nullable();
            $table->string('NOK')->nullable();
            $table->string('NZD')->nullable(); 
            $table->string('PHP')->nullable();
            $table->string('PLN')->nullable();
            $table->string('RON')->nullable();
            $table->string('RUB')->nullable();
            $table->string('SEK')->nullable();
            $table->string('SGD')->nullable();
            $table->string('THB')->nullable();
            $table->string('ZAR')->nullable();
            $table->string('TRY')->nullable();
		    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
