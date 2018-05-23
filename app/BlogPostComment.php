<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPostComment extends Model
{
    public $fillable = ['user','post_id','comment'];
}
