<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('birthday')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('character1')->nullable();
            $table->string('character2')->nullable();
            $table->string('hobby')->nullable();
            $table->string('charmpoint')->nullable();
            $table->string('dream')->nullable();
            $table->string('app')->nullable();
            $table->string('content')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
