<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_data', function (Blueprint $table) {
            $table->id();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('gender')->nullable();

            $table->text('street')->nullable();
            $table->text('street_number')->nullable();

            $table->integer('zip')->nullable();

            $table->text('city')->nullable();

            $table->integer('customer_number')->nullable();
            $table->integer('invoice_number')->nullable();
            $table->integer('units')->nullable();
            $table->integer('cost_per_unit')->nullable();
            $table->integer('amount')->nullable();

            $table->date('invoice_date')->nullable();

            $table->text('token')->nullable();

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
        Schema::dropIfExists('customer_data');
    }
}
