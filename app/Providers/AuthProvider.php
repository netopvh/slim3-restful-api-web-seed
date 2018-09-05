<?php

namespace App\Providers;

use Anddye\Interfaces\AuthServiceProvider;
use App\Models\User;

/**
 * Class AuthProvider.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Provider
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
class AuthProvider implements AuthServiceProvider
{
    public function byCredentials($username, $password)
    {
        if (!$user = User::where('email', $username)->first()) {
            return null;
        }

        if (!$user->verifyPassword($password)) {
            return null;
        }

        return $user;
    }

    public function byId($id)
    {
        return User::find($id);
    }
}
