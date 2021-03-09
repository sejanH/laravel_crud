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
            $table->bigInteger('category_id')->length(10)->unsigned();
            $table->string('category_parent_ids',30)->nullable();
            $table->string('title',255);
            $table->string('slug',255);
            $table->longText('body');
            $table->longText('body2')->nullable();
            $table->string('cover',60)->nullable();
            $table->string('gallery',60)->nullable();
            $table->string('thumbnail',60)->nullable();
            $table->bigInteger('created_by')->length(10)->unsigned();
            $table->boolean('published')->default(0);
            $table->boolean('featured')->default(0);
            $table->bigInteger('viewed')->default(0);
            $table->string('meta_tags',255)->nullable();
            $table->string('meta_description',255)->nullable();
            $table->timestamps();
            //constraints
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('created_by')->references('id')->on('users');
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
