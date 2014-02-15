<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemCategoriesTable extends Migration {

    public function up() {
        Schema::create('item_categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',32);
            $table->string('description',128);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('item_categories');
    }

}
