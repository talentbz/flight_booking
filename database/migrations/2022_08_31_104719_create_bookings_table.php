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
            $table->string('air_line');
            $table->string('trip_type');
            $table->string('start_seat')->nullable();
            $table->string('start_date')->nullable();
            $table->string('return_seat')->nullable();
            $table->string('return_date')->nullable();
            $table->string('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('phone')->nullable();
            $table->double('cost');
            $table->double('outbound_bussiness_cost')->nullable();
            $table->double('outbound_economy_cost')->nullable();
            $table->double('inbound_bussiness_cost')->nullable();
            $table->double('inbound_economy_cost')->nullable();
            $table->integer('baggage_count')->nullable();
            $table->integer('payment_type');
            $table->string('payment_status');
            $table->string('created_by');
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
