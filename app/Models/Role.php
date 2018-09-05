<?php

namespace App\Models;

/**
 * Class Role.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Model
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
class Role extends AbstractModel
{
    /**
     * @return BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions')->withTimestamps();
    }
}
