<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'slug'=>$this->slug,
            'body'=>$this->body,
            'body2'=>$this->body2,
            'created_by'=>$this->created_by,
            'meta_tags'=>$this->meta_tags,
            'meta_description'=>$this->meta_description,
            'category'=>$this->category,
            'creator'=>$this->creator
        ];
    }
}
