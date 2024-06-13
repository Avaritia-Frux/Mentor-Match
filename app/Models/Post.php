<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $id = 'id';
    protected $fillable = ['title', 'slug', 'post_image_path', 'body', 'creator_id', 'category_id', 'company_id'];
    // Solve N +1 problem by eager loading
    protected $with = ['creator', 'category', 'company'];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function like(): BelongsTo
    {
        return $this->belongsTo(Post_like::class, 'post_id');
    }
}
