<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactPersonResource extends JsonResource
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
            'name' => $this->name,
            $this->mergeWhen(\request()->user()?->isAdministrator(), [
                'email' => $this->email,
                'phone' => $this->phone,
            ]),
            'created_at' => Carbon::parse($this->created_at,'UTC')->isoFormat('MMMM Do YYYY, h:mm:ss a'),
            'message_thread' => new MessageThreadResource($this->whenLoaded('messageThread'))
        ];
    }
}
