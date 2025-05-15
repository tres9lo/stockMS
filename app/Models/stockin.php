<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stockin extends Model
{
    protected $table = 'stockins';
    protected $primaryKey = 'stockin_id';
    protected $fillable = [
        'product_id',
        'quantity',
        'unit_price', 
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
