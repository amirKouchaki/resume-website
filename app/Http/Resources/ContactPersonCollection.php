<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ContactPersonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            $this->mergeWhen(\request()->user()?->isAdministrator(), [
                'email' => $this->email,
                'phone' => $this->phone,
            ]),
            'created_at' => $this->created_at,
            'message_thread' => new MessageThreadResource($this->whenLoaded('messageThread'))
        ];
    }
}
