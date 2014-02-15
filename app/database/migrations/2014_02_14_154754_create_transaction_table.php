<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration {
    public function up()
    {
        Schema::create("transactions", function(Blueprint $table)
        {
            $table->increments("id");
            
           // $table->string("item_name", 30)->unique();
			$table->string("status", 10)->nullable()->default(null);
			$table->string("description", 200)->nullable()->default(null);
			$table->integer("user_id")->unsigned();
			$table->integer("item_id")->unsigned();
            
			//foreign keys
            $table->foreign("user_id")->references("id")->on("users");
			$table->foreign("item_id")->references("item_id")->on("item");
            
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists("transactions");
    }
}