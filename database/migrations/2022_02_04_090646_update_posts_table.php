<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // per prima cosa creo la colonna della FK
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            // assegno la FK alla colonna creata
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
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
            // 1 eliminare la FK
            $table->dropForeign(['category_id']);
            // 2 elimino la colonna
            $table->dropColumn('category_id');
        });
    }
}
