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
        Schema::create('scannings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('zone_id')->nullable();
            $table->bigInteger('location_id')->nullable();
            $table->bigInteger('presentation_id')->nullable();
            $table->bigInteger('language_id')->nullable();
            $table->timestamp('scanned_at')->nullable();
            $table->string('ip')->nullable();
            $table->string('user_agent',2000)->nullable();
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
        Schema::dropIfExists('scannings');
    }
};
