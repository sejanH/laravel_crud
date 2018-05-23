<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('userposts', function (Blueprint $table) {
            $table->string('id',11);
            $table->string('postedby',30);
            $table->text('title');
            $table->longtext('body');
            $table->longtext('file')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop("userposts");
    }
}
