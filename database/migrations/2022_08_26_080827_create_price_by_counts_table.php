<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceByCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_by_counts', function (Blueprint $table) {
            $table->id();
            $table->string('seat_count');
            $table->string('percentage');
            $table->integer('min_count');
            $table->integer('max_count');
            $table->integer('seat_type_id');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('price_by_counts');
    }
}
