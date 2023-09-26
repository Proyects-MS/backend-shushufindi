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
        Schema::create('hiring', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_processtype')->nullable();
            $table->foreign('id_processtype')->references('id')->on('process_type')->onDelete('cascade');
            $table->string('name')->nullable();
            
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
        Schema::dropIfExists('hiring');
    }
};
