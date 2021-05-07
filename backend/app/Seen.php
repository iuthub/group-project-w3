<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seen extends Model
{
    public function post(){
        return $this->belongsTo(Post::class);
        }
}
