<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'preview',
        'content',
        'user_id',
        'comment_count',
        //'created_at',
    ];

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
}
