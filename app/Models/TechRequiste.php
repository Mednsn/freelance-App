<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechRequiste extends Model
{
    protected $fillable = ['name','descrition'];

    public function missions()
    {
        return $this->belongsTo(Mission::class);
    }
}
