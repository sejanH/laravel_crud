<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPostDetails extends Model
{
	public $incrementing = false;
    public $fillable = ['id','clicked','likes','dislikes','category'];
}
