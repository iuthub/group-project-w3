<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('metaTitle')->nullable();
            $table->text('slug')->nullable();
            $table->string('author')->nullable();
            $table->text('title');
            $table->text('sample')->nullable();
            $table->text('subheading')->nullable();
            $table->text('body')->nullable();
            $table->string('status')->default('inactive');//[inactive,active,finished]
            $table->integer('category_id');
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
        Schema::dropIfExists('posts');
    }
}
