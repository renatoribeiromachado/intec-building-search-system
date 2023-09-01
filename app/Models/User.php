<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // App methods
    public function allUsers($where = [])
    {
        $user = self::select('users.*');

        if (request()->name) {
            $where[]  = ['users.name', 'like', '%'.request()->name.'%'];
        }

        if (request()->email) {
            $where[]  = ['users.email', 'like', '%'.request()->email.'%'];
        }

        return $user
            ->where($where)
            ->orderBy('users.id', 'asc')
            ->paginate(50);
    }

    // Eloquent relationship methods
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }
    
    public function sigs()
    {
        return $this->hasMany(Sig::class, 'user_id');
    }
    
    public function sigCompanies()
    {
        return $this->hasMany(SigCompany::class, 'user_id');
    }
}
