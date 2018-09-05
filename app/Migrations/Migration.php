<?php

namespace App\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Phinx\Migration\AbstractMigration;

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
    protected $schema;

    public function init()
    {
        $this->schema = (new Capsule())->schema();
    }

    /**
     * @return Schema
     */
    public function schema()
    {
        return $this->schema;
    }
}
