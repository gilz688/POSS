<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

    public function up() {
        Schema::create('items', function(Blueprint $table) {
            $table->integer('barcode');
            $table->string('name',32);
            $table->string('description',128);
            $table->string('size_or_weight',32);
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('item_categories');
            $table->primary('barcode');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('items');
    }

}

