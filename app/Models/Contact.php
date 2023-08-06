<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $fillable = [
        'work_id',
        'position_id',
        'company_id',
        'user_id',
        'name',
        'ddd',
        'main_phone',
        'ddd_fax',
        'fax',
        'email',
        'secondary_email',
        'tertiary_email',
        'ddd_two',
        'phone_two',
        'ddd_three',
        'phone_three',
        'ddd_four',
        'phone_four',
        'phone_type_one',
        'phone_type_two',
        'phone_type_three',
        'is_active',
        'created_by',
        'updated_by',
    ];

    // Eloquent relationshiop methods
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
