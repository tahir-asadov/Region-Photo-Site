<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'slug', 'region_id', 'city_id', 'village_id', 'user_id', 'published'];

    // protected $casts = [
    //     'created_at' => 'datetime:Y-m-d',
    // ];

    use HasFactory, SoftDeletes;
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function village()
    {
        return $this->belongsTo(Village::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function thumbnail() {
        $images = $this->images->first();
        if($images) {
            return $images->thumbnail;
        }
        return false;
    }

    public function original() {
        $images = $this->images->first();
        if($images) {
            return $images->path;
        }
        return false;
    }

    public function path()
    {
        $slug = Str::slug($this->title);
        return route('public.post', [$slug, $this->id]);
    }

    public function url()
    {
        return Str::slug($this->title);
    }

    public function featured_imaged()
    {
        return env('APP_URL') . '/storage/post_images/' . $this->thumbnail();
    }
}
