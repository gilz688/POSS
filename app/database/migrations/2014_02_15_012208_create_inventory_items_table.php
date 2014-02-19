<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryItemsTable extends Migration {

    public function up() {
        Schema::create('inventory_items', function(Blueprint $table) {
            $table->integer('barcode');
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
