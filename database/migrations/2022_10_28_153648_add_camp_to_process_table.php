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
            $table->string('hiring_class')->nullable()->after('hiring');
            $table->string('sequential')->nullable()->after('hiring');
            $table->string('last_assign_date')->nullable()->after('hiring');
        
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
            $table->dropColumn('hiring_class', 'sequential', 'last_assign_date');
    
        });
    }
};
