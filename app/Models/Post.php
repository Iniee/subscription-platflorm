<?php

namespace App\Models;

use App\Models\Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'website_id'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class, 'post_subscriber');
    }
}