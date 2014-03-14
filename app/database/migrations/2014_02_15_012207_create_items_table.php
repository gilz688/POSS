<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('items', function(Blueprint $table) {
            $table->bigInteger('barcode');
            $table->primary('barcode');
            $table->string('itemName', 50);
            $table->double('price', 30, 2);
            $table->string('itemDescription', 300);
            $table->string('label', 32);
            $table->integer('quantity');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('item_categories');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('items');
    }

}
