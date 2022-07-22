<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = ["id","payment_method","trx_num","member_id","payment_from_mobile","payment_to_mobile","authored_by"];
    
	public function members_relation()
	{
		return $this->belongsTo(\App\Models\Member::class, "member_id");
	}

}
