<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $with = ['sub_categories'];
    protected $fillable = ['parent_id','level','name','slug','is_active','show_on_menu','meta_tags','meta_description'];
    protected $casts = [
        'is_active' => 'boolean',
        'show_on_menu' => 'boolean',
    ];

    public function setSlugAttribute($value){
        $slug = Str::of($value)->slug('-');
        if($this->where('slug',$slug)->count() > 0){
            $slug = $slug.'-'.Str::random(5);
        }
        $this->attributes['slug'] = $slug;
    }
    public function getMetaTagsAttribute($value){
        return unserialize($value);
    }
    public function setMetaTagsAttribute($value){
        $this->attributes['meta_tags'] = serialize($value);
    }

    public function sub_categories(){
        return $this->hasMany(static::class,'parent_id','id');
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }

}
