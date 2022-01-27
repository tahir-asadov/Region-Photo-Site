<?php

namespace App\Http\Controllers;

use App\Events\PostAdded;
use App\Models\City;
use App\Models\Image;
use App\Models\Post;
use App\Models\Region;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class AuthorController extends Controller
{
  public function profile()
  {
    return view('author.profile');
  }

  public function update_profile(Request $request)
  {
    $data = $request->validate([
      'name'                      => 'required|min:1|max:255',
      'current_password'          => ['sometimes', 'nullable', 'required_with:new_password', 'string', 'min:3'],
      'new_password'              => ['sometimes', 'nullable','required_with_all:new_password_confirmation,old_password','string','min:3', 'confirmed'], 
      'new_password_confirmation' => [],
      'picture'                   => []
    ]);
    
    $user = User::find(auth()->user()->id);
    $picture = $request->file('picture');
    
    if($picture){

      $image_file_name    = md5($user->id) . '.png';
      $image_folder       = 'public/user_images/';
      $file_path          = $image_folder . $image_file_name;
      $image_storage_path = Storage::path($file_path);
  
      $temp_path = $picture->getPathname();
      $img       = new ImageManager(array('driver' => 'imagick'));

      $img = $img->make($temp_path)->resize(
        100,
        null,
        function ($constraint) {
          $constraint->aspectRatio();
        }
      );
      
      $file_uploaded = file_put_contents($image_storage_path, $img->response('jpg')->content());

      if($file_uploaded) {
        $user->photo = $image_file_name;
        $user->save();
      }

    }
    


    if( $data['current_password'] != '' && $data['new_password']!= '' && $data['new_password'] == $data['new_password_confirmation'] ){
      if( Hash::check($data['current_password'], $user->password ) ) {
        $user->password = Hash::make($request->new_password);
        $user->save();
      }else {
        redirect()->route('author.profile')->withErrors(['error' => 'Password does not match']);
      }
    }


    // $fileTitle = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    // $file_path = $file->store('public/post_images');
    // $thumbail_path = Image::createThumbnail($file_path);

    return redirect()->route('author.profile')->with('success', 'Profile updated');
  }

  public function upload()
  {
    return view('author.upload', [
      'regions' => Region::latest()->get(),
      'cities' => City::latest()->get(),
      'villages' => Village::latest()->get(),
    ]);
  }

  public function store(Request $request) {

    $data = $request->validate([
      'title' => 'required|min:1|max:128',
      'description' => 'max:512',
      'region' => 'required|numeric|min:1',
      'city' => 'numeric',
      'village' => 'numeric',
      'image.*' => 'required|mimes:jpg,bmp,png'
    ]);

    $create = array(
      'title' => $data['title'],
      'description' => $data['description'],
      'region_id' => $data['region'],
      'city_id' => $data['city'],
      'village_id' => $data['village'],
      'user_id' => auth()->user()->id,
    );
    
    if( !$data['village'] ) {
      unset($create['village_id']);
    }
    if( !$data['city'] ) {
      unset($create['city_id']);
    }

    $post = Post::create($create);

    if($post){
      if($request->file('image')) {
        foreach ($request->file('image') as $key => $file) {
            $fileTitle = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_path = $file->store('public/post_images');
            $thumbail_path = Image::createThumbnail($file_path);
            Image::create([
                'title'=> $fileTitle,
                'path' => $file->hashName(),
                'post_id' => $post->id,
                'thumbnail' => $thumbail_path,
            ]);
        }
      }

    }

    event(new PostAdded($post));

    return redirect()->route('author.uploads')->with('success', 'Post added');
  }


  public function edit($id)
  {
    $post = Post::where(['user_id' => auth()->user()->id, 'id' => $id])->first();
    return view('author.edit', [
        'regions' => Region::latest()->get(),
        'cities' => City::latest()->get(),
        'villages' => Village::latest()->get(),
        'statuses' => array('0' => 'Draft', '1' => 'Published'),
        'post' => $post
    ]);    
  }

  public function update($id, Request $request) {


    $data = $request->validate([
      'title' => 'required|min:1|max:128',
      'description' => 'max:512',
      'region' => 'required|numeric|min:1',
      'city' => 'numeric',
      'village' => 'numeric',
      'image.*' => 'required|mimes:jpg,bmp,png'
    ]);

    $post = Post::where(['user_id' => auth()->user()->id, 'id' => $id])->first();
    if( $post ) {

      $update = array(
        'title' => $data['title'],
        'description' => $data['description'],
        'region_id' => $data['region'],
        'city_id' => $data['city'],
        'village_id' => $data['village'],
        'published' => '0',
        'user_id' => auth()->user()->id,
      );
      
      if( !$data['village'] ) {
        unset($update['village_id']);
      }
      if( !$data['city'] ) {
        unset($update['city_id']);
      }
      $post->update($update);

      if($request->file('image')) {

        foreach ($request->file('image') as $key => $file) {
            $fileTitle = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_path = $file->store('public/post_images');
            $thumbail_path = Image::createThumbnail($file_path);
            Image::create([
                'title'=> $fileTitle,
                'path' => $file->hashName(),
                'post_id' => $post->id,
                'thumbnail' => $thumbail_path,
            ]);
        }
      }

      // return redirect()->route('author.edit', ['id' => $post->id])->with('success', 'Post updated');
      return redirect()->route('author.uploads')->with('success', 'Post added');
    }else {
      return redirect()->route('author.uploads')->with('error', 'Post not found');
    }
  }

  public function delete_image($id) {
    $post = false;
    if($id ){
      $image = Image::where(['id' => $id ])->first();
      if( $image ) {
        $post = Post::where( ['id' => $image->post_id, 'user_id' => auth()->user()->id] )->first();
        if($post) {
          $image->delete();
        }
      }
      // 
    }
    if($post){
      return redirect()->route('author.edit', ['id' => $post->id])->with('success', 'Image deleted');
    }
    return redirect()->route('author.uploads')->with('error', 'Could not delete the image!');
  }

  public function uploads()
  {
    $posts = Post::with('city')->with('region')->with('village')->with('user')->where('user_id', auth()->user()->id)->latest()->paginate();
    return view('author.uploads', compact('posts'));
  }

  public function destroy($id) {
    $post = Post::where(['user_id' => auth()->user()->id, 'id' => $id])->first();
    $post->delete();
    return redirect()->route('author.uploads')->with('success', 'Post deleted!');
  }
}
