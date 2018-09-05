<?php

use App\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateUsersRolesTable.
 */
class CreateUsersRolesTable extends Migration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->schema()->create('users_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->timestamps();
        });
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->schema()->drop('users_roles');
    }
}
