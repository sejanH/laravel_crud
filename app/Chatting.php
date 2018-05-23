<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatting extends Model
{
    protected $fillable = ['id','sender','reciepient','message'];
}
