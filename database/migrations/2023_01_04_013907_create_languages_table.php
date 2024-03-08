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
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->comment('Tên tiếng việt');
            $table->string('localization')->nullable()->comment('Tên theo ngôn ngữ');
            $table->string('code')->nullable()->comment('Mã ngôn ngữ');
            $table->tinyInteger('status')->default(1)->comment('1-sử dụng, 0 - ngừng');
            $table->tinyInteger('default')->default(0)->comment('1-mặc định');
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
        Schema::dropIfExists('languages');
    }
};
