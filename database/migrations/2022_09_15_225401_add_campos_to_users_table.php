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
        Schema::table('users', function (Blueprint $table) {
            $table->string('identification_card',15)->nullable()->unique()->after('name');
            $table->string('signature',255)->nullable()->after('name');
            $table->string('signature_password',255)->nullable()->after('name');
            $table->string('profile_photo_path',255)->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('identification_card','signature','signature_password','profile_photo_path');
        });
    }
};
