<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostStat extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'views', 'likes'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
