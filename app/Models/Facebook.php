<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{
    protected $fillable = [
        'title', 'author', 'category', 'image', 'description', 'posted_at', 'link',
    ];
}
