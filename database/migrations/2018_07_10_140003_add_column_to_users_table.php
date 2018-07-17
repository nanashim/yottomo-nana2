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
            $table->string('birthday')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('character1')->nullable();
            $table->string('character2')->nullable();
            $table->string('hobby')->nullable();
            $table->string('charmpoint')->nullable();
            $table->string('dream')->nullable();
            $table->string('app')->nullable();
            $table->string('content')->nullable();
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
            $table->dropColumn('birthday')->nullable(false);
            $table->dropColumn('birthplace')->nullable(false);
            $table->dropColumn('character1')->nullable(false);
            $table->dropColumn('character2')->nullable(false);
            $table->dropColumn('hobby')->nullable(false);
            $table->dropColumn('charmpoint')->nullable(false);
            $table->dropColumn('dream')->nullable(false);
            $table->dropColumn('app')->nullable(false);
            $table->dropColumn('content')->nullable(false);
            $table->dropColumn('ranktitle')->nullable(false);
            $table->dropColumn('rank1')->nullable(false);
            $table->dropColumn('rank2')->nullable(false);
            $table->dropColumn('rank3')->nullable(false);
        });
    }
}
