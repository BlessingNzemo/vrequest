<?php

namespace App\Models;

use App\Models\Demande;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable=[
        'chauffeur_id',
        'vehicule_id',
        'demande_id',
        'status',
        'commentaire',
        'date',
        'started_at',
        'ended_at'
    ];
    public function chauffeur(){
        return $this->belongsTo(Chauffeur::class, 'chauffeur_id');
    }
    public function vehicule(){
        return $this->belongsTo(Vehicule::class, 'vehicule_id');
    }
    public function demande(){
        return $this->belongsTo(Demande::class, 'demande_id');
    }
}
