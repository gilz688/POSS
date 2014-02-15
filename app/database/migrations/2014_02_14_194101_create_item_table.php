<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 Schema::create("items", function(Blueprint $table)
        {
			$table->increments("id");
            
			$table->string("itemName", 30)->unique();
			$table->double("price", 255);
			$table->integer("quantity", 255);
			$table->string("description",200);
			$table->integer("categoryId", 255);
			
			$table->foreign("category_id")->references("id")->on("category");
			
			$table->timestamps();
		 });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	Schema::dropIfExists("items");
	}

}