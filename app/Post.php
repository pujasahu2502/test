<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    protected $table="posts";

    protected $fillable = [
        'id', 'title', 'description','user_id','featured_image','slug','tag'
    ];
    protected $casts = [
        'tag' => 'array',
    ];
    use SoftDeletes;
}

