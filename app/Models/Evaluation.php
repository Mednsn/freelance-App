<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['commente','evaluation','client_id','mission_id'];

    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
