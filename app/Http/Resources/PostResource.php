<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //in this way data will returned all and as it located in DB
        // return parent::toArray($request);

        //in this way data will returned as we like
        $responseArray=[
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'slug' => $this->slug,
            'photo' => $this->photo,
            'created_at' => $this->created_at->format('d/m/y')
        ];
        return $responseArray;
    }
}
