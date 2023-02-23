<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurplusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surpluses', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->integer("users_id");
            $table->string("surplus_code")->unique();
            $table->integer("amount_withdraw");
            $table->string("status");
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surpluses');
    }
}
