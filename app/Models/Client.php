<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends User
{
    protected $fillable = ['entreprise','description','user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function mission()
    {
        return $this->hasMany(Mission::class);
    }
}
