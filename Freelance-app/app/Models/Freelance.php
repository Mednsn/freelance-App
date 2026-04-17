<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Freelance extends Model
{
    protected $fillable = ['tarif', 'portfolio', 'disponibilite','user_id'];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
    public function technologies()
    {
        return $this->hasMany(Technologie::class);
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
     public function users()
    {
        return $this->belongsTo(User::class);
    }
}
