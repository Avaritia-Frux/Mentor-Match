<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post_like extends Model
{
    use HasFactory;
    protected $table = 'post_likes';
    protected $id = 'id';

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function post() : HasMany
    {
        return $this->hasMany(Post::class, 'post_id');
    }
}
