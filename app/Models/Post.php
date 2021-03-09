<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','category_parent_ids','title','slug','body','body2','created_by','meta_tags','meta_description'];

    public function getCategoryParentIdsAttribute($value){
        return unserialize($value);
    }
    public function setCategoryParentIdsAttribute($value){
        $this->attributes['category_parent_ids'] = serialize($value);
    }
    public function setSlugAttribute($value){
        $this->attributes['slug'] = Str::of($value)->slug('-').'-'.now();
    }
}
