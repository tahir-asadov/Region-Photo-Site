<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    
    protected $fillable = ['title', 'slug'];

    use HasFactory, SoftDeletes;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // public function path()
    // {
    //     return "/region/{$this->slug}";
    // }

    public function url()
    {
        return route('public.region', [$this->slug]);
    }
}
