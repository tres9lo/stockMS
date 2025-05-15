<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'product_Code',
        'quantity',
        'unit_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stockins()
    {
        return $this->hasMany(stockin::class, 'product_id');
    }
    public function stockouts()
    {
        return $this->hasMany(stockout::class, 'product_id');
    }
}
