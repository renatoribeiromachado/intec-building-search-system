<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug'
    ];

    // App methods
    public function allPermissions($where = [], $withPagination = true, $orderBy = 'asc', $sortBy = 'id')
    {
        if (request()->search_name) {
            $where[] = ['name', 'like', '%'.request()->search_name.'%'];
        }

        $result = self::where($where)->orderBy($sortBy, $orderBy);

        if ($withPagination) {
            return $result->paginate(1000);
        }

        return $result->get();
    }

    // Eloquent relationship methods
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
