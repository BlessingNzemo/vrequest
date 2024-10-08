<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

        protected $fillable = [
            'message_groupe_id',
            'contenu',
            'user_id',
            'filepath',
            'isPicture',
            'isVideo',
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

}
