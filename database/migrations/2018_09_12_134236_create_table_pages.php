<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->boolean('active')->default(1);
            $table->string('image', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. <<<[[[[[
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
