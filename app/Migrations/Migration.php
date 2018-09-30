<?php

namespace App\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Schema\MySqlBuilder as Schema;

/**
 * Class Migration.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Migration
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 *  */
class Migration extends AbstractMigration
{
    /** @var Schema */
    private $schema;

    /**
     * Create a schema builder instance.
     */
    public function init()
    {
        $this->schema = (new Capsule())->schema();
    }

    /**
     * Get the schema builder instance.
     *
     * @return Schema
     */
    public function schema(): Schema
    {
        return $this->schema;
    }
}
