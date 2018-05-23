<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $fillable = ['adminId','username','password','email','roleId','pin','address','fullName'];
}
