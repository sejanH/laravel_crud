<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['parent_id','level','name','slug','is_active','show_on_menu','meta_tags','meta_description'];
    protected $casts = [
        'is_active' => 'boolean',
        'show_on_menu' => 'boolean',
    ];

    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::of($value)->slug('-').'_'.now()->timestamp;
    }
    public function getMetaTagsAttribute($value){
        return unserialize($value);
    }
    public function setMetaTagsAttribute($value){
        $this->attributes['meta_tags'] = serialize($value);
    }
}
