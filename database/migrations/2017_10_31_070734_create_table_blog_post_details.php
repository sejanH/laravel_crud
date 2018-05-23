<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBlogpostDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('blog_post_details', function (Blueprint $table) {
            $table->string('id',11)->references('id')->on('userposts')->primary();
            $table->bigInteger('clicked',0);
            $table->Integer('likes',0);
            $table->Integer('dislikes',0);
            $table->string('category');
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
        //
    }
}
