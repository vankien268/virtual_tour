<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('location_id')->nullable();
            $table->bigInteger('language_id')->nullable();
            $table->string('language_code')->nullable();
            $table->string('image')->nullable();
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->longText('content')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1-sử dụng, 0 - ngừng');
            $table->integer('position')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
