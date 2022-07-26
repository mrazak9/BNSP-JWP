<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['post_id', 'comment_id', 'value'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'post_id');
    }
}
