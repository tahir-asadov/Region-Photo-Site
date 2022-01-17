<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class Image extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['title', 'path', 'post_id', 'thumbnail'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public static function createThumbnail($file_path)
    {
        $original_image_path = Storage::path($file_path);

        $thumbnail_path = self::getThumbnailName($original_image_path);

        $img = new ImageManager(array('driver' => 'imagick'));
        $img = $img->make($original_image_path)->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        file_put_contents($thumbnail_path['path'], $img->response('jpg')->content());

        return $thumbnail_path['name'];
    }

    private static function getThumbnailName( $original_image_path ) {
        $pathinfo = pathinfo($original_image_path);
        return [
            'path' => $pathinfo['dirname'].'/'.$pathinfo['filename'].'_thumb.'.$pathinfo['extension'],
            'name' => $pathinfo['filename'].'_thumb.'.$pathinfo['extension']
        ];
    }
}
