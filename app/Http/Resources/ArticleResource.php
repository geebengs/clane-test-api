<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'id' => $this->id, 
            'author_id' => $this->user_id,    
            'author_name' => $this->user_id ? $this->user->name : '-',   
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'published' => $this->published,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            
          ];
    }
}
