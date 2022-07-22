<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ["id","member_id","payment_id","order_no","order_total","shipping_date","address","status","authored_by"];
    
	public function members_relation()
	{
		return $this->belongsTo(\App\Models\Member::class, "member_id");
	}
	public function payments_relation()
	{
		return $this->belongsTo(\App\Models\Payment::class, "payment_id");
	}

}
