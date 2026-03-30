<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'kelas',
        'jurusan',
        'nipd',
        'otp',              
        'otp_expired_at',   
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp',              
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expired_at' => 'datetime',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function processedReturns()
    {
        return $this->hasMany(ReturnModel::class, 'processed_by');
    }

}

