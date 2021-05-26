<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('cust_id', true);
            $table->integer('emp_id');
            $table->string('soe', 10);
            $table->string('cust_name', 15);
            $table->string('cust_mobile',10);
            $table->string('brand', 10);
            $table->string('model', 10);
            $table->string('mop', 10);
            $table->string('status', 10);
            $table->date('nd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
