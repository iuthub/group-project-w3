<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $hidden = ['posts'];
    public function posts(){
        return $this->hasMany(Post::class)->orderBy('created_at', 'asc');
        }   
}
