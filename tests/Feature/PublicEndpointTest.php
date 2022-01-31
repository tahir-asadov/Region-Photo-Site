<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Post;
use App\Models\Region;
use App\Models\User;
use App\Models\Village;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicEndpointTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function homepage_is_ok()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function login_page_is_ok()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /** @test */
    public function register_page_is_ok()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /** @test */
    public function single_post_page_is_ok()
    {
        $post = Post::first();
        if( $post ){
            $response = $this->get($post->path());
            $response->assertStatus(200);
        }else {
            $this->assertFalse(true);
        }
    }

    /** @test */
    public function region_page_is_ok()
    {
        $region = Region::first();
        if( $region ){
            $response = $this->get($region->url());
            $response->assertStatus(200);
        }else {
            $this->assertFalse(true);
        }
    }

    /** @test */
    public function city_page_is_ok()
    {
        $city = City::first();
        if( $city ){
            $response = $this->get($city->url());
            $response->assertStatus(200);
        }else {
            $this->assertFalse(true);
        }
    }

    /** @test */
    public function village_page_is_ok()
    {
        $village = Village::first();
        if( $village ){
            $response = $this->get($village->url());
            $response->assertStatus(200);
        }else {
            $this->assertFalse(true);
        }
    }

    /** @test */
    public function author_page_is_ok()
    {
        $author = User::first();
        if( $author ){
            $response = $this->get($author->url());
            $response->assertStatus(200);
        }else {
            $this->assertFalse(true);
        }
    }
}
