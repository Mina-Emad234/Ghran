<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'slug'=>$this->slug,
            'body'=>$this->body,
            'image'=>$this->image,
            'image_url'=>$this->image_url,
            'active'=>$this->status,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'category'=>[
                'id'=>$this->category->id,
                'name'=>$this->category->name,
                'category_link'=>url('/api/blog_categories_api/'.$this->category->id),
            ],
            'tags'=>TagResource::collection($this->tags),
            'link'=>url('/api/blogs_api/'.$this->id),
        ];
    }
}
