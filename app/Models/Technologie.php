<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technologie extends Model
{
    protected $fillable = ['name','description','freelance_id'];

    public function freelance()
    {
        return $this->belongsTo(Freelance::class);
    }
}
