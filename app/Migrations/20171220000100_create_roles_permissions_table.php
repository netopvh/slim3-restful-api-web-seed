<?php

use App\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateRolesPermissionsTable.
 */
class CreateRolesPermissionsTable extends Migration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->schema()->create('roles_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
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
        $this->schema()->drop('roles_permissions');
    }
}
