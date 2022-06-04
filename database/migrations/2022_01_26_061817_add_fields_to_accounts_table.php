<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->integer('parent_account_id')->nullable();
            $table->string('parent_account')->nullable();
            $table->integer('level')->nullable();
            $table->string('account_nature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('parent_account_id');
            $table->dropColumn('parent_account');
            $table->dropColumn('level');
            $table->dropColumn('account_nature');
        });
    }
}
