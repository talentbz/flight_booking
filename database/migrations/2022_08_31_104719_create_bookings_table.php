<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_no');
            $table->string('schedule_id');
            $table->string('seat_type_id');
            $table->string('seat_no');
            $table->string('air_line');
            $table->string('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('phone')->nullable();
            $table->integer('guest');
            $table->string('cost');
            $table->integer('payment_type');
            $table->string('payment_status');
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
        Schema::dropIfExists('bookings');
    }
}