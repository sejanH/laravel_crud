<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogdetails extends Model
{
    public $fillable = ['blog_name','blog_description','blog_type','blog_logo_url'];
}
