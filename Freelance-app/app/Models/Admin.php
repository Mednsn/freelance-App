<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends User
{
    protected $fillable = ['active'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
