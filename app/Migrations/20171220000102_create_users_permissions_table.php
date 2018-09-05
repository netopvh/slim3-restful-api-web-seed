<?php

use App\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateUsersPermissionsTable.
 */
class CreateUsersPermissionsTable extends Migration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->schema()->create('users_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('permission_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->timestamps();
        });
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->schema()->drop('users_permissions');
    }
}
