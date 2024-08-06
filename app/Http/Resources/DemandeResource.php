<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DemandeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    { 
        $chauffeur = User::all()->random(1)->first();
        $lastMessage = Message::selectRaw('messages.*')
                                ->leftJoin('message_groupes','message_groupes.id','messages.message_groupe_id')
                                ->leftJoin('demandes','demandes.id','message_groupes.demande_id')
                                ->where('demandes.id',$this->resource->id)
                                ->orderByDesc('messages.created_at')
                                ->limit(1)
                                ->first();
        return [
            'demande' => [
                'id' => $this->resource->id,
                "ticket" => $this->resource->ticket,
                "motif" => $this->resource->motif,
                "dateDeplacement"=> $this->resource->date_deplacement,
                "lieuDestination"=> $this->resource->destination,
                "lieuDepart"=> $this->resource->lieu_depart,
                "status"=> $this->resource->status,
                "longitude"=> $this->resource->longitude_destination,
                "latitude"=> $this->resource->latitude_destination,
                'initiateur' => [
                    'id' => $this->resource->user()->first()->id,
                    'prenom' => $this->resource->user()->first()->first_name,
                    'name' => $this->resource->user()->first()->username,
                    'postnom' => $this->resource->user()->first()->last_name,
                    'email' => $this->resource->user()->first()->email,
                    'telephone' => $this->resource->user()->first()->phone,
                    'emailVerifiedAt' => $this->resource->user()->first()->email_verified_at,
                    'createdAt' => $this->resource->user()->first()->created_at->toDateTimeString(),
                    'updatedAt' => $this->resource->user()->first()->updated_at->toDateTimeString(),
                ],
                'chauffeur' => [
                    'id' => $chauffeur->id,
                    'prenom' => $chauffeur->first_name,
                    'name' => $chauffeur->username,
                    'postnom' => $chauffeur->last_name,
                    'email' => $chauffeur->email,
                    'telephone' => $chauffeur->phone,
                    'emailVerifiedAt' => $chauffeur->email_verified_at,
                    'createdAt' => $chauffeur->created_at,
                    'updatedAt' => $chauffeur->updated_at,
                ],
                "nbrEtranger" => $this->resource->nbre_passagers,
                'created_at' => $this->resource->created_at->toDateTimeString(),
            ],
            'lastSender'=> [
                'id' => ( !empty($lastMessage)) ? $lastMessage->user()->first()->id : 0,
                'prenom' => ( !empty($lastMessage)) ? $lastMessage->user()->first()->first_name : "",
                'name' => ( !empty($lastMessage)) ? $lastMessage->user()->first()->username : "",
                'postnom' => ( !empty($lastMessage))? $lastMessage->user()->first()->last_name : "",
                'email' => ( !empty($lastMessage))?  $lastMessage->user()->first()->email : "",
                'telephone' => ( !empty($lastMessage))? $lastMessage->user()->first()->phone : "",
                'emailVerifiedAt' => ( !empty($lastMessage)) ? $lastMessage->user()->first()->email_verified_at : "",
                'createdAt' => ( !empty($lastMessage)) ?  $lastMessage->user()->first()->created_at->toDateTimeString() : "",
                'updatedAt' =>( !empty($lastMessage)) ? $lastMessage->user()->first()->updated_at->toDateTimeString( ): "",
            ],
            'lastMessage' =>( !empty($lastMessage))? $lastMessage->contenu : "",
            'isVideo' => ( !empty($lastMessage)) ? $lastMessage->isVideo : 0,
            'isPicture' => ( !empty($lastMessage)) ? $lastMessage->isPicture : 0,
            'isMessageRead' => true,
            'time' => ( !empty($lastMessage))? $lastMessage->created_at->toDateTimeString() : "",
            'unread' => 0,
        ];
    }
}
