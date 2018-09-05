<?php

use App\Models\User;
use Phinx\Seed\AbstractSeed;

/**
 * Class UserSeeder.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Seed
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
class UserSeeder extends AbstractSeed
{
    public function run()
    {
        User::insert([
            [
                'email' => 'admin@mail.com',
                'forename' => 'Andrew',
                'password' => 'ea2959d87ea2974afcd45c6224d2e5322bc349db8e65f8a3c7460e2a8fb9a883',
                'salt' => '>TrKAx^/<E^+aX!-5K|}pL!Po9(gH_Fr',
                'surname' => 'Dyer',
                'username' => 'admin',
                'created_at' => '2017-12-20 08:00:00',
                'updated_at' => '2017-12-20 08:00:00',
            ],
        ]);
    }
}
