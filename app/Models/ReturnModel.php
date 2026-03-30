<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    protected $table = 'returns';

    protected $fillable = [
        'borrowing_id',
        'return_date',
        'fine',
        'condition_note',
        'processed_by'
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
