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
        Schema::create('template', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();

            $table->string('priority')->nullable();

            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');

            $table->unsignedBigInteger('type_process_id')->nullable();
            $table->foreign('type_process_id')->references('id')->on('process_type')->onDelete('cascade');

            $table->unsignedBigInteger('hiring_id')->nullable();
            $table->foreign('hiring_id')->references('id')->on('hiring')->onDelete('cascade');

            $table->unsignedBigInteger('procedure_id')->nullable();
            $table->foreign('procedure_id')->references('id')->on('procedure')->onDelete('cascade');

            $table->longText('description')->nullable();

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
        Schema::dropIfExists('template');
    }
};
