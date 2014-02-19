<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasedItemsTable extends Migration {

    public function up() {
        Schema::create('purchased_items', function(Blueprint $table) {
            $table->integer('transaction_id')->unsigned();
            $table->integer('barcode')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('barcode')->references('barcode')->on('items');
            $table->integer('quantity');
            $table->timestamps();
            $table->primary(array('transaction_id', 'barcode'));
        });
    }

    public function down() {
        Schema::dropIfExists('purchased_items');
    }

}
