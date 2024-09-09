<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delegation extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime'
    ];
    protected $fillable = ['user_id','manager_id','date_debut','date_fin','motif'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
