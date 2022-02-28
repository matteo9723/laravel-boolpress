<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();

            // creo colonna per la FK di posts
            $table->unsignedBigInteger('post_id');
            // creo la FK pe la colonna appena creata
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade'); // all'eleimiazione di un post o un tag viene eliminato in cascata il record

            // creo colonna per la FK di tags
            $table->unsignedBigInteger('tag_id');
            // creo la FK pe la colonna appena creata
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade'); // all'eleimiazione di un post o un tag viene eliminato in cascata il record

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
