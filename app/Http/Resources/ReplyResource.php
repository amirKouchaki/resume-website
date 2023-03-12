<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,

            'sender' => $this->whenLoaded('replyable', [
                'name' => $this->replyable->name,
                'is_admin' => $this->replyable->is_admin ?? 0,
                $this->mergeWhen(auth()->user()?->isAdministrator(), [
                    'email' => $this->replyable->email,
                    'phone' => $this->replyable->phone
                ]),
            ]),

            'created_at' => Carbon::parse($this->created_at,'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a')
        ];
    }
}
