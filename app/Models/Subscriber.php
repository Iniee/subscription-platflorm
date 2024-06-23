<?php

namespace App\Models;

use App\Models\Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    use HasFactory;
    
    protected $fillable = ['email', 'website_id'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_subscriber');
    }
}