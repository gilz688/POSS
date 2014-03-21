<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasedItemsTable extends Migration {

    public function up() {
        Schema::create('purchased_items', function(Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->bigInteger('barcode')->unsigned();
            $table->foreign('id')->references('id')->on('transactions');
            $table->foreign('barcode')->references('barcode')->on('items');
            $table->integer('quantity');
            $table->timestamps();
            $table->primary(array('id', 'barcode'));
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('purchased_items');
    }

}
