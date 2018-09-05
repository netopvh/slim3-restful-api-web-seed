<?php

use App\Models\Role;
use Phinx\Seed\AbstractSeed;

/**
 * Class RoleSeeder.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Seed
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
class RoleSeeder extends AbstractSeed
{
    public function run()
    {
        Role::insert([
            [
                'name' => 'admin',
                'description' => '',
                'created_at' => '2017-12-20 08:00:00',
                'updated_at' => '2017-12-20 08:00:00',
            ],
            [
                'name' => 'superadmin',
                'description' => '',
                'created_at' => '2017-12-20 08:00:00',
                'updated_at' => '2017-12-20 08:00:00',
            ],
        ]);
    }
}
