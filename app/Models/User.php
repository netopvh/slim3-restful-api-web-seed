<?php

namespace App\Models;

use Anddye\Interfaces\JwtSubjectInterface;
use App\Interfaces\HasPermissionInterface;
use App\Traits\HasPermissionTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class User.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Model
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
class User extends AbstractModel implements HasPermissionInterface, JwtSubjectInterface
{
    use HasPermissionTrait;

    /**
     * @param int $length optional
     *
     * @return string
     */
    public function generateSalt(int $length = 32): string
    {
        $salt = '';
        $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\][{}\";:?.>,<!@#$%^&*()-_=+|";
        for ($x = 0; $x < $length; ++$x) {
            $salt .= $charset[mt_rand(0, strlen($charset) - 1)];
        }

        return $salt;
    }

    /**
     * @return int
     */
    public function getJwtIdentifier()
    {
        return $this->id;
    }

    /**
     * @param string $password
     *
     * @return string
     */
    public function hashPassword(string $password): string
    {
        return hash('sha256', $password);
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'users_permissions')->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles')->withTimestamps();
    }

    /**
     * @param string $password
     *
     * @return bool
     */
    public function verifyPassword(string $password): bool
    {
        return $this->password === $this->hashPassword($password.$this->salt);
    }
}
