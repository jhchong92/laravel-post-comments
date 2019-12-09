<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'name', 'email', 'body'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
