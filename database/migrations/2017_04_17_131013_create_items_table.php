<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('items', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->integer('category_id');
          $table->string('name')->default("");
          $table->string('description')->default("");
          $table->boolean('new')->default(true);
          $table->integer('use_time')->default(0);
          $table->integer('use_type')->default(0);
          $table->integer('settings_new')->default(0);
          $table->integer('settings_use_time')->default(0);
          $table->integer('settings_use_type')->default(0);
          $table->integer('views')->default(0);
          $table->integer('interested')->default(0);
          $table->integer('status')->default(0);
          $table->string('avatar')->default("");
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
      Schema::dropIfExists('items');
    }
}
