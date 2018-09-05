<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Interface HasPermissionInterface.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Interface
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
interface HasPermissionInterface
{
    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany;

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany;
}
