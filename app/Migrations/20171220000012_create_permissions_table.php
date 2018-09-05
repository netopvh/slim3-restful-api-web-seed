<?php

use App\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePermissionsTable.
 */
class CreatePermissionsTable extends Migration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->schema()->create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->string('name', 100);
            $table->timestamps();
        });
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->schema()->drop('permissions');
    }
}
