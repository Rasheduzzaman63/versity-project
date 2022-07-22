<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = ["id","name","email","password","phone","address","status","image","remember_token","authored_by"];

    protected $hidden = ['password', 'remember_token'];
    

}
