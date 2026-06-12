<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address'];

    // 🔗 1 Member punya banyak Loan
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
