<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogdetails', function (Blueprint $table) {
            $table->string('blog_name',30);
            $table->string('blog_description',300);
            $table->string('blog_type',20);
            $table->string('blog_logo_url',255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop("blogdetails");
    }
}
