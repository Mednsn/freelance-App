<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['title','description','freelance_id','years','company'];
    
    public function freelances()
    {
        return $this->belongsTo(Freelance::class);
    }
}
