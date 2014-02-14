<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    public function up()
    {
        Schema::create("users", function(Blueprint $table)
        {
            $table->increments("id");
            
            $table->string("username", 16)->unique();
            $table->string("password", 64);
            
            $table->enum("role", array('clerk','auditor','admin'))->default('clerk');
            
            $table->string("email", 255)->nullable()->default(null);
            
            $table->string("firstname", 24)->nullable()->default(null);
            $table->string("middlename", 24)->nullable()->default(null);
            $table->string("lastname", 24)->nullable()->default(null);
            
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists("users");
    }
}