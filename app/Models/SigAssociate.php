<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SigAssociate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "sig_associates"; 

    protected $fillable = [
        'user_id',
        'appointment_date',
        'code_associate',
        'notes'
    ];

    protected $dates = [
        'appointment_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
