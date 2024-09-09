<?php

namespace App\Models;

// use App\Models\Vehicule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Course;
use Illuminate\Database\Eloquent\SoftDeletes;
 

class Vehicule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'plaque',
        'marque',
        'capacite',
        'disponibilite',
    ];

    public function newEloquentBuilder($vehicule)
    {
        return new \Illuminate\Database\Eloquent\Builder($vehicule->latest());
    }
    public function courses(){
        return $this->hasMany(Course::class,'vehicule_id');
    }
    

}
