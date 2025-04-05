<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Menu;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = [
        'menu_id',
        'route',
        'name',
        'display_name',
        'description',
        'active',
        'level',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
