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

    public function findRole($role_uuid)
    {
        return self::where('uuid', $role_uuid)->firstOrFail();
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
    
    // Eloquent Relationship Methods
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
