<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['name','description','freelance_id'];
    
    public function freelances()
    {
        return $this->belongsTo(Freelance::class);
    }
}
