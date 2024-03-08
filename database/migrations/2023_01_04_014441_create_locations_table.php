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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('zone_id')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->decimal('lat', 20, 8)->nullable();
            $table->decimal('long', 20, 8)->nullable();
            $table->longText('overview')->nullable();
            $table->integer('position')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1-sử dụng, 0 - ngừng');
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
        Schema::dropIfExists('locations');
    }
};
