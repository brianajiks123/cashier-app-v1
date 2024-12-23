<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_code',
        'total',
        'status',
    ];

    // Relations
    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
