<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            $this->mergeWhen(auth()->user()?->isAdministrator(),
                $this->whenLoaded('replyable', [
                    'sender' => [
                        'name' => $this->replyable->name,
                        'email' => $this->replyable->email,
                        'phone' => $this->replyable->phone
                    ]
                ])
            ),
            'created_at' => $this->created_at
        ];
    }
}
