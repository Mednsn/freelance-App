<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['active','user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
