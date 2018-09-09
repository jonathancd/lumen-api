<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{

    protected $fillable = [
        'name', 'logo'
    ];

    public function posts() 
    {
        return $this->hasMany('App\Post');
    }
}