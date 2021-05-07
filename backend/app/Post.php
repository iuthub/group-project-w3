<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $hidden = ['seens'];
    public function tags(){
        return $this->hasMany(Tag::class)->orderBy('created_at', 'asc');
        }   
        public function seens(){
            return $this->hasMany(Seen::class)->orderBy('created_at', 'asc');
            }   
        public function category(){
            return $this->belongsTo(Category::class);
            }
}
