<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title','alias'
    ];

    public function articles() {

        //
        //return $this->hasMany(Article::class);
        return $this->hasMany(Article::class)->paginate(1);
    }
}
