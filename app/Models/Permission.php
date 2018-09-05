<?php

namespace App\Models;

/**
 * Class Permission.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Model
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
class Permission extends AbstractModel
{
    /**
     * @return BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions')->withTimestamps();
    }
}
