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
        Schema::table('process', function (Blueprint $table) {
            $table->string('hiring')->nullable()->after('priority');
            $table->string('procedures')->nullable()->after('priority');
            $table->string('time')->nullable()->after('priority');
            $table->string('ending')->nullable()->after('priority');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process', function (Blueprint $table) {
            $table->dropColumn('hiring','procedures','time','ending');
        });
    }
};
