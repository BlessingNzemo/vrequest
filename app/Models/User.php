<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Manager;
use App\Models\UserInfo;
use App\Models\Chauffeur;
use App\Models\Delegation;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'first_name',
        'username',
        'last_name',
        'email',
        'phone',
        'password',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function user_infos(): HasMany
    {
        return $this->hasMany(UserInfo::class);

    } 
    public function delegations(): HasMany
    {
        return $this->hasMany(Delegation::class);

    }
    public function chauffeur(){
        return $this->hasMany(Chauffeur::class);

    }
    public function routeNotificationForMail(Notification $notification): array|string
    {
        // Return email address only...
        return $this->email;
 
        // Return email address and name...
        return [$this->email => $this->first_name];
    }
}
