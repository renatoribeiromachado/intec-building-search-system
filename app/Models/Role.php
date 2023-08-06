<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    // App methods
    public function allRoles()
    {
        return self::paginate(15);
    }

    public function findRole($id)
    {
        return self::where('id', $id)->firstOrFail();
    }

    public function findRoles($paginate = true)
    {
        $where = [];
        
        if (Auth::user()->role->name != 'Webmaster') {
            $where[] = ['name', '!=', 'Webmaster'];
        }

        if ($paginate) {
            self::where($where)->paginate(15);
        }
        
        return self::where($where)->get();
    }

    // Scopes
    public static function scopeUserRole($query, $role)
    {
        return $query->where('name', $role);
    }

    public static function scopeUserRoleIsNot($query, $name)
    {
        return $query->where('name', '!=', $name);
    }
    
    // Eloquent Relationship Methods
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
