<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardingModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boarding_models', function (Blueprint $table) {
            $table->string("fat")->primary();
            $table->string("client")->nullable();;
            $table->string("agent")->nullable();
            $table->dateTime("date_doc")->nullable();;
            $table->dateTime("date_delivery")->nullable();;
            $table->dateTime("date_loading")->nullable();;
            $table->dateTime("date_boarding")->nullable();;
            $table->dateTime("date_prod")->nullable();;
            $table->string("obs")->nullable();;
            $table->boolean("status")->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boarding_models');
    }
}
