<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'member_id', 'product_id', 'product_name', 'product_image', 'quantity', 'price',
    ];

    public function shipping(){
    	return $this->belongsTo(Shipping::class,'shipping_id','id');
    }

    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
