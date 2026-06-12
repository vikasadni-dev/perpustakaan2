<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'member_id',
        'book_id',
        'loan_date',
        'due_date',
        'return_date',
        'status'
    ];

    // 🔗 Loan milik 1 Member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // 🔗 Loan milik 1 Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // 🔗 Loan punya 1 Fine
    public function fine()
    {
        return $this->hasOne(Fine::class);
    }
}
