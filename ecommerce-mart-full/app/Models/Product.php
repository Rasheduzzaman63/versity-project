<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ["id","name","category_id","price","short_description","long_description","image","authored_by"];
    
	public function categories_relation()
	{
		return $this->belongsTo(\App\Models\Category::class, "category_id");
	}

}
