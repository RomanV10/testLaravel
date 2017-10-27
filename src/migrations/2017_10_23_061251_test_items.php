<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TestItems extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    if (!Schema::hasTable('items')) {
      Schema::create('items', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title');
        $table->string('second_title')->default('');
        $table->string('slug');
        $table->string('image_path');
        $table->timestamps();
      });
    }

    if (!Schema::hasTable('rates')) {
      Schema::create('rates', function (Blueprint $table) {
        $table->integer('item_id');
        $table->integer('rate')->default(0);
        $table->timestamp('updated_at');
      });
    }

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('rates');
    Schema::dropIfExists('items');
  }
}
