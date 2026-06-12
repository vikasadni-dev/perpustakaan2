<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = [
        'loan_id',
        'amount',
        'is_paid',
        'paid_at'
    ];

    // 🔗 Fine milik 1 Loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
