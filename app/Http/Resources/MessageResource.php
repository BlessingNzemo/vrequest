<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [ 
            'id' => $this->resource->id,
            'contenu' => $this->resource->contenu,
            'time' => $this->resource->created_at->toDateTimeString(),
            'user' => [
                'id' => $this->resource->user->id,
                'prenom' => $this->resource->user->first_name,
                'username' => $this->resource->user->username,
                'postnom' => $this->resource->user->last_name,
                'email' => $this->resource->user->email,
                'telephone' => $this->resource->user->phone,
                'emailVerifiedAt' => $this->resource->user->email_verified_at->toDateTimeString(),
                'createdAt' => $this->resource->user->created_at->toDateTimeString(),
                'updatedAt' => $this->resource->user->updated_at->toDateTimeString(),
                ]
            ];
        }
}
