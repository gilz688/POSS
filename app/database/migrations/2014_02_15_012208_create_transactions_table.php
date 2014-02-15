<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

    public function up() {
        Schema::create('transactions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('cashier_number');
            $table->integer('creator_id')->unsigned();
            $table->integer('voider_id')->unsigned();
            $table->foreign('creator_id')->references('id')->on('users');
            $table->foreign('voider_id')->references('id')->on('users')->nullable()->unsigned();

            $table->timestamp('created_at');
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('transactions');
    }

}
