<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = ['tarif','lettre','statut','freelance_id','mession_id'];

    public function freelance()
    {
        return $this->belongsTo(Freelance::class);
    }
    public function missions()
    {
        return $this->belonsTo(Mission::class);
    }
}
