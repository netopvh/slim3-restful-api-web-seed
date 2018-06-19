<?php

namespace App\Migrations;

use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

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
    /**
     * @var Schema
     */
    private $_schema;

    public function init()
    {
        $this->_schema = (new Capsule())->schema();
    }

    /**
     * @return Schema
     */
    public function schema()
    {
        return $this->_schema;
    }
}
