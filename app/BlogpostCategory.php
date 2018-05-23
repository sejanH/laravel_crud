<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogpostCategory extends Model
{
	protected $table = 'blogpost_category';
    protected $fillable = ['category_name','category_icon','description'];
}
