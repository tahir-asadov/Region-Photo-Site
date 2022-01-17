<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Intervention\Image\ImageManager;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $source_path      = resource_path('images/demo_images/*.jpg');
        $destination_path = storage_path('app/public/post_images');
        $images           = glob($source_path);

        $image_source   = $images[array_rand($images)];
        $new_filename   = uniqid() . '.seeded.jpg';
        $new_thumbname  = uniqid() . '_thumb.seeded.jpg';
        $new_filepath   = $destination_path . '/' . $new_filename;
        $new_thumbpath  = $destination_path . '/' . $new_thumbname;

        copy($image_source, $new_filepath);

        $img = new ImageManager(array('driver' => 'imagick'));
        $img = $img->make($new_filepath)->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        file_put_contents($new_thumbpath, $img->response('jpg')->content());

        return [
            'title'     => $new_filename,
            'path'      => $new_filename,
            'thumbnail' => $new_thumbname
        ];
        
    }
}
