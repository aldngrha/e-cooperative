<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string("place_of_birth")->nullable();
            $table->date("date_of_birth")->nullable();
            $table->string("phone_number")->nullable();
            $table->enum("gender", ["M", "F"])->nullable();
            $table->string("position")->nullable();
            $table->text("address")->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
