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
        'username',
        'password',
        'role',
        'kelas',
        'jurusan',
        'nisn',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
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