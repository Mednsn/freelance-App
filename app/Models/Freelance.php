<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Freelance extends User
{
    protected $fillable = ['tarif', 'portfolio', 'disponibilite'];

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
}
