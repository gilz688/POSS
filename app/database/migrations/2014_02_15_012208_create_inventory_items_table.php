<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryItemsTable extends Migration {

    public function up() {
        Schema::create('inventory_items', function(Blueprint $table) {
            $table->integer('barcode');
            $table->string('name',16);
            $table->string('description',64);
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('item_categories');
            $table->integer('quantity');
            $table->primary('barcode');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('inventory_items');
    }

}
