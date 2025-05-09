<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_code',
        'name',
        'price',
        'stock',
    ];

    // Relations
    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
