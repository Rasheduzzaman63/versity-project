<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    protected $table = 'order_details';

    protected $fillable = ["id","order_id","product_id","product_name","product_image","quantity","price","authored_by"];
    
	public function orders_relation()
	{
		return $this->belongsTo(\App\Models\Order::class, "order_id");
	}
	public function products_relation()
	{
		return $this->belongsTo(\App\Models\Product::class, "product_id");
	}

}
