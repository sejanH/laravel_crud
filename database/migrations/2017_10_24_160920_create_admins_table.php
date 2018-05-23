<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 'adminId','username','password','email','role','pin','address','fullName'
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->string('id',11)->primary();
            $table->string('username',30)->unique();
            $table->string('password',100);
            $table->string('email',200);
            $table->integer('roleId');
            $table->integer('pin');
            $table->text('address');
            $table->string('fullName',200);
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
        Schema::dropIfExists('admins');
    }
}
