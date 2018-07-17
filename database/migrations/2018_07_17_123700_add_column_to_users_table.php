<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ranktitle')->nullable();
            $table->string('rank1')->nullable();
            $table->string('rank2')->nullable();
            $table->string('rank3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ranktitle')->nullable(false);
            $table->dropColumn('rank1')->nullable(false);
            $table->dropColumn('rank2')->nullable(false);
            $table->dropColumn('rank3')->nullable(false);
        });
    }
}
