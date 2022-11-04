<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('compani_id');
             $table->string('first_name');
             $table->string('last_name');
             $table->string('email')->unique()->nullable();
             $table->string('phone')->nullable();
             $table->timestamps();
             $table->foreign('compani_id')
            ->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employs');
    }
}
