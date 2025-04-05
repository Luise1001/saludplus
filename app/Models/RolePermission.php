<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;
use App\Models\Role;

class RolePermission extends Model
{
    protected $table = 'role_permissions';

    protected $fillable = [
        'role_id',
        'permission_id',
    ];

    public function permission()
    {
        return $this->hasMany(Permission::class);
    }

    public function role()
    {
        return $this->hasMany(Role::class);
    }
}
