<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageThreadResource extends JsonResource
{


    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => Carbon::parse($this->created_at,'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a'),
            'replies' => ReplyResource::collection($this->whenLoaded('replies'))
        ];
    }
}
