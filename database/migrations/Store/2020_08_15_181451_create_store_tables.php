<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('stores')) {
            Schema::create('stores', function (Blueprint $table) {
                $table->integer('id')->primary();
                $table->string('nombre');
                $table->date('fecha_apertura');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->integer('id')->primary();
                $table->string('nombre');
                $table->string('sku')->unique();
                $table->string('descripcion');
                $table->double('valor');
                $table->integer('id_tienda');
                $table->string('imagen');
                $table->timestamps();
                $table->foreign('id_tienda')->references('id')->on('stores')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
        Schema::dropIfExists('products');
    }
}
