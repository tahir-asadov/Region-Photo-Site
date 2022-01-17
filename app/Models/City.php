<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['title', 'slug'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function url()
    {
        return route('public.city', [$this->slug]);
    }
}
