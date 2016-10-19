<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tenant_id');
            $table->foreign('tenant_id')->on('tenants')->references('id');
            $table->integer('user_id');
            $table->foreign('user_id')->on('users')->references('id');
            $table->boolean('enabled')->default(true);
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
        Schema::drop('users_tenants');
    }
}
