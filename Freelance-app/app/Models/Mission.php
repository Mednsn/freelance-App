<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = ['titre','description','budget','duree_by_day','type','statut','category_id','user_id'];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
    public function techRequises()
    {
        return $this->hasMany(TechRequiste::class);
    }
}
