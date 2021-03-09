<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->length(10)->nullable();
            $table->integer('level')->length(10)->default(0);
            $table->string('name',255);
            $table->string('slug',255);
            $table->boolean('is_active')->default(true);
            $table->boolean('show_on_menu')->default(true);
            $table->string('meta_tags',255)->nullable();
            $table->string('meta_description',255)->nullable();
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
        Schema::dropIfExists('categories');
    }
}
