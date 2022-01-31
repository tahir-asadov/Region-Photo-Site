<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Like;
use App\Models\Post;
use App\Models\Region;
use App\Models\Setting;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $pagination = Cache::remember('pagination', 3600, function () {
            return Setting::get('pagination');
        });

        $search = $request->input('s');

        $posts = Post::where(['published' => 1])->latest()->with('city', 'user', 'images', 'likes');

        if($search != '') {
            $posts->where('title', 'LIKE', "%{$search}%");
        }

        return view('public.home', [
            'posts' => $posts->paginate($pagination)
        ]);
    }

    public function post($slug, $post_id)
    {
        $liked = false;

        if(auth()->user()) {

            $hasLiked = Like::first()->where(
                [
                    'post_id' => $post_id,
                    'user_id' => auth()->user()->id
                ]
            )->get();

            if($hasLiked->count() > 0) {
                $liked = true;
            }
        }

        $post = Post::where(['id' => $post_id])->with('region', 'city', 'village', 'user', 'images', 'likes')->first();
        return view('public.post', [
            'post' => $post,
            'liked' => $liked
        ]);
    }

    public function city(City $city)
    {
        $pagination = Cache::remember('pagination', 3600, function () {
            return Setting::get('pagination');
        });
        
        $posts = $city->posts()->where(['published' => '1'])->latest()->paginate($pagination);

        return view('public.city', [
            'city' => $city,
            'posts' => $posts
        ]);
    }

    public function region(Region $region)
    {
        $pagination = Cache::remember('pagination', 3600, function () {
            return Setting::get('pagination');
        });
        
        $posts = $region->posts()->where(['published' => '1'])->latest()->paginate($pagination);

        return view('public.region', [
            'region' => $region,
            'posts' => $posts
        ]);
    }

    public function village(Village $village)
    {
        $pagination = Cache::remember('pagination', 3600, function () {
            return Setting::get('pagination');
        });
        
        $posts = $village->posts()->where(['published' => '1'])->latest()->paginate($pagination);

        return view('public.village', [
            'village' => $village,
            'posts' => $posts
        ]);
    }

    public function author(User $user)
    {
        $pagination = Cache::remember('pagination', 3600, function () {
            return Setting::get('pagination');
        });
        
        $posts = $user->posts()->where(['published' => '1'])->latest()->paginate($pagination);

        return view('public.author', [
            'author' => $user,
            'posts' => $posts
        ]);
    }
}
