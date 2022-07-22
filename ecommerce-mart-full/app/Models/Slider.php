<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = ["id","slider_image","title","description","link","authored_by"];
    

}
