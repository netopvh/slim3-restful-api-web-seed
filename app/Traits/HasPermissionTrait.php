<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

/**
 * Trait HasPermissionTrait.
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 *
 * @category Trait
 *
 * @see https://github.com/andrewdyer/slim3-restful-api-web-seed
 */
trait HasPermissionTrait
{
    /**
     * @return $this
     */
    public function giveAllPermissions(): self
    {
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            if (!$this->permissions->contains($permission)) {
                $this->permissions()->save($permission);
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function giveAllRoles(): self
    {
        $roles = Role::all();
        foreach ($roles as $role) {
            if (!$this->roles->contains($role)) {
                $this->roles()->save($role);
            }
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function givePermission(string $name): self
    {
        if (($permission = Permission::where('name', $name)->first()) and !$this->permissions->contains($permission)) {
            $this->permissions()->save($permission);
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function giveRole(string $name): self
    {
        if (($role = Role::where('name', $name)->first()) and !$this->roles->contains($role)) {
            $this->roles()->save($role);
        }

        return $this;
    }

    /**
     * @param Permission $permission
     *
     * @return bool
     */
    protected function hasPermission(Permission $permission): bool
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    /**
     * @param Permission $permission
     *
     * @return bool
     */
    protected function hasPermissionThroughRole(Permission $permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Permission $permission
     *
     * @return bool
     */
    protected function hasPermissionTo(Permission $permission): bool
    {
        return $this->hasPermissionThroughRole($permission) or $this->hasPermission($permission);
    }

    /**
     * @param Role $role
     *
     * @return bool
     */
    public function hasRole(Role $role): bool
    {
        return (bool) $this->roles->where('name', $role->name)->count();
    }

    /**
     * @return bool
     */
    public function isGranted(string $role): bool
    {
        if (!$role = Role::where('name', $role)->first()) {
            return false;
        }

        return $this->hasRole($role);
    }

    /**
     * @param string $permission
     *
     * @return bool
     */
    public function isPermitted(string $permission): bool
    {
        if (!$permission = Permission::where('name', $permission)->first()) {
            return false;
        }

        return $this->hasPermissionTo($permission);
    }

    /**
     * @return $this
     */
    public function removeAllPermissions(): self
    {
        $this->permissions()->detach();

        return $this;
    }

    /**
     * @return $this
     */
    public function removeAllRoles(): self
    {
        $this->roles()->detach();

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function removePermission(string $name): self
    {
        if (($permission = Permission::where('name', $name)->first())) {
            $this->permissions()->detach($name);
        }

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function removeRole(string $name): self
    {
        if (($role = Role::where('name', $name)->first())) {
            $this->roles()->detach($role);
        }

        return $this;
    }
}
