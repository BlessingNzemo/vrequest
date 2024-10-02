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
        $lastMessage = Message::selectRaw('messages.*')
                                ->leftJoin('message_groupes','message_groupes.id','messages.message_groupe_id')
                                ->leftJoin('demandes','demandes.id','message_groupes.demande_id')
                                ->where('demandes.id',$this->resource->id)
                                ->orderByDesc('messages.created_at')
                                ->limit(1)
                                ->first();

        $course = $this->resource->courses()->limit(1)->first();
        $with_course = [];

        if(!empty($course)){
        $with_course =  [
                'id' => $course->id,
                'vehicule' => [
                    'id' => $course->vehicule()->first()->id,
                    'plaque' => $course->vehicule()->first()->plaque,
                    'marque' => $course->vehicule()->first()->marque,
                    'capacite' => $course->vehicule()->first()->capacite,
                    'disponibilite' => $course->vehicule()->first()->disponibilite,
                ] ,
                'chauffeur' => [
                    'id' => $course->chauffeur()->first()->user()->first()->id,
                    'prenom' => $course->chauffeur()->first()->user()->first()->first_name,
                    'name' => $course->chauffeur()->first()->user()->first()->username,
                    'postnom' => $course->chauffeur()->first()->user()->first()->last_name,
                    'email' => $course->chauffeur()->first()->user()->first()->email,
                    'telephone' => $course->chauffeur()->first()->user()->first()->phone,
                    'emailVerifiedAt' => $course->chauffeur()->first()->user()->first()->email_verified_at,
                    'createdAt' => $course->chauffeur()->first()->user()->first()->created_at,
                    'updatedAt' => $course->chauffeur()->first()->user()->first()->updated_at,
                ],
                'demande' => [
                    'id' => $course->demande()->first()->id,
                    "ticket" => $course->demande()->first()->ticket,
                    "motif" => $course->demande()->first()->motif,
                    "date_demande" => $course->demande()->first()->date,
                    "date_deplacement"=> $course->demande()->first()->date_deplacement,
                    "destination"=> $course->demande()->first()->destination,
                    "lieu_depart"=> $course->demande()->first()->lieu_depart,
                    "status"=> $course->demande()->first()->status,
                    "is_validated"=> $course->demande()->first()->status,
                    "longitude"=> $course->demande()->first()->longitude_destination,
                    "latitude"=> $course->demande()->first()->latitude_destination,
                    "longitudelDestination"=> $course->demande()->first()->longitude_destination,
                    "latitudeDestination"=> $course->demande()->first()->latitude_destination,
                    "longitude_depart"=> $course->demande()->first()->longitude_depart,
                    "latitude_depart"=> $course->demande()->first()->latitude_depart,
                    'user' => [
                        'id' => $course->demande()->first()->user()->first()->id,
                        'prenom' => $course->demande()->first()->user()->first()->first_name,
                        'name' => $course->demande()->first()->user()->first()->username,
                        'postnom' => $course->demande()->first()->user()->first()->last_name,
                        'email' => $course->demande()->first()->user()->first()->email,
                        'telephone' => $course->demande()->first()->user()->first()->phone,
                        'emailVerifiedAt' => $course->demande()->first()->user()->first()->email_verified_at,
                        'createdAt' => $course->demande()->first()->user()->first()->created_at->toDateTimeString(),
                        'updatedAt' => $course->demande()->first()->user()->first()->updated_at->toDateTimeString(),
                    ],
                    'chauffeur' => [
                        'id' => $course->chauffeur()->first()->user()->first()->id,
                        'prenom' => $course->chauffeur()->first()->user()->first()->first_name,
                        'name' => $course->chauffeur()->first()->user()->first()->username,
                        'postnom' => $course->chauffeur()->first()->user()->first()->last_name,
                        'email' => $course->chauffeur()->first()->user()->first()->email,
                        'telephone' => $course->chauffeur()->first()->user()->first()->phone,
                        'emailVerifiedAt' => $course->chauffeur()->first()->user()->first()->email_verified_at,
                        'createdAt' => $course->chauffeur()->first()->user()->first()->created_at,
                        'updatedAt' => $course->chauffeur()->first()->user()->first()->updated_at,
                    ],
                    "nbrEtranger" => $course->demande()->first()->nbre_passagers,
                    'create_at' => $course->demande()->first()->created_at->toDateTimeString(),
                ],
                'status' => $course->status,
                'commentaire' => $course->commentaire,
                'created_at' => $course->created_at,
                'updated_at' => $course->updated_at,
                'date' => $course->date,
                'started_at' => $course->started_at,
                'ended_at' => $course->ended_at,

        ];
    }

        return [
            'demande' => [
                'id' => $this->resource->id,
                "ticket" => $this->resource->ticket,
                "motif" => $this->resource->motif,
                "dateDeplacement"=> $this->resource->date_deplacement,
                "lieuDestination"=> $this->resource->destination,
                "lieuDepart"=> $this->resource->lieu_depart,
                "status"=> $this->resource->status,
                "is_validated"=> $this->resource->is_validated,
                "longitude"=> $this->resource->longitude_destination,
                "latitude"=> $this->resource->latitude_destination,
                "longitudelDestination"=> $this->resource->longitude_destination,
                "latitudeDestination"=> $this->resource->latitude_destination,
                "longitudelDepart"=> $this->resource->longitude_depart,
                "latitudeDepart"=> $this->resource->latitude_depart,
                'user' => [
                    'id' => $this->resource->user()->first()->id,
                    'first_name' => $this->resource->user()->first()->first_name,
                    'username' => $this->resource->user()->first()->username,
                    'last_name' => $this->resource->user()->first()->last_name,
                    'email' => $this->resource->user()->first()->email,
                    'phone' => $this->resource->user()->first()->phone,
                    'emailVerifiedAt' => $this->resource->user()->first()->email_verified_at,
                    'createdAt' => $this->resource->user()->first()->created_at->toDateTimeString(),
                    'updatedAt' => $this->resource->user()->first()->updated_at->toDateTimeString(),
                ],

                "nbrEtranger" => $this->resource->nbre_passagers,
                'created_at' => $this->resource->created_at->toDateTimeString(),
            ],
            'lastSender'=> [
                'id' => ( !empty($lastMessage)) ? $lastMessage->user()->first()->id : 0,
                'first_name' => ( !empty($lastMessage)) ? $lastMessage->user()->first()->first_name : "",
                'username' => ( !empty($lastMessage)) ? $lastMessage->user()->first()->username : "",
                'last_name' => ( !empty($lastMessage))? $lastMessage->user()->first()->last_name : "",
                'email' => ( !empty($lastMessage))?  $lastMessage->user()->first()->email : "",
                'phone' => ( !empty($lastMessage))? $lastMessage->user()->first()->phone : "",
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
            'course' => $with_course,
        ];
    }
}
