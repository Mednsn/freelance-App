<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'statut',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
     public function role()
     {
        return $this->belongsTo(Role::class);
     }
     public function messions()
     {
        return $this->hasMany(Mission::class);
     }
     public function candidatures()
     {
        return $this->hasMany(Candidature::class);
     }
     public function freelance()
    {
        return $this->hasOne(Freelance::class);
    }
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function sendMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function recevedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    

}
