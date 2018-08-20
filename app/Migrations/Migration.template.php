<?php

use App\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class $className.
 *
 * @author John Doe <john.doe@example.com>
 *
 * @category Migration
 *
 * @see https://example.com
 */
class $className extends $baseClassName
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->schema()->create('', function (Blueprint $table) {
            $table->increments('id');

            // ...

            $table->timestamps();
        });
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->schema()->drop('');
    }
}
