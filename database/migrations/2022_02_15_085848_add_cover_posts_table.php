<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoverPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // in cover viene salvato il percoso dell'immagine con nome generato da laravel
            $table->string('cover')->nullable()->after('slug');
            // voglio mantenere anche il nome originale dell'immagine
            $table->string('cover_original_name')->nullable()->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('cover');
            $table->dropColumn('cover_original_name');
        });
    }
}
