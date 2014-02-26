<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryItemsTable extends Migration {

    public function up() {
        Schema::create('inventory_items', function(Blueprint $table) {
            $table->bigInteger('barcode');
            $table->integer('quantity');
            $table->decimal('price',5,2);
            $table->foreign('barcode')->references('barcode')->on('items');
            $table->primary('barcode');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('inventory_items');
    }

}
