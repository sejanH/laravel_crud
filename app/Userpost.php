<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userpost extends Model
{
	public $incrementing = false;
    public $fillable = ['id','postedby','title','body','file'];
}
