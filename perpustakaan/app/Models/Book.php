<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'publisher', 'year', 'stock', 'description'
    ];

    // 🔗 1 Book bisa dipinjam berkali-kali
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
