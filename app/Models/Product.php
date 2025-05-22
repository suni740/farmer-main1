<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'quantity',
        'featured',  
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function isInStock($requestedQty = 1)
{
    return $this->quantity >= $requestedQty;
}

    public function orderItems()
{
    return $this->hasMany(\App\Models\OrderItem::class);
}
}
