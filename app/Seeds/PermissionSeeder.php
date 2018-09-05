<?php

use App\Models\Permission;
use Phinx\Seed\AbstractSeed;

/**
 * Class PermissionSeeder.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Seed
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
class PermissionSeeder extends AbstractSeed
{
    public function run()
    {
        Permission::insert([
            [
                'name' => 'delete users',
                'description' => '',
                'created_at' => '2017-12-20 08:00:00',
                'updated_at' => '2017-12-20 08:00:00',
            ],
            [
                'name' => 'manage roles',
                'description' => '',
                'created_at' => '2017-12-20 08:00:00',
                'updated_at' => '2017-12-20 08:00:00',
            ],
            [
                'name' => 'edit users',
                'description' => '',
                'created_at' => '2017-12-20 08:00:00',
                'updated_at' => '2017-12-20 08:00:00',
            ],
            [
                'name' => 'edit admins',
                'description' => '',
                'created_at' => '2017-12-20 08:00:00',
                'updated_at' => '2017-12-20 08:00:00',
            ],
            [
                'name' => 'view admin pages',
                'description' => '',
                'created_at' => '2017-12-20 08:00:00',
                'updated_at' => '2017-12-20 08:00:00',
            ],
            [
                'name' => 'make admin',
                'description' => '',
                'created_at' => '2017-12-20 08:00:00',
                'updated_at' => '2017-12-20 08:00:00',
            ],
        ]);
    }
}
