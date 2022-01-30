<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public pages
Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('/post/{slug}/{post}', [HomeController::class, 'post'])->name('public.post');
Route::get('/region/{region:slug}', [HomeController::class, 'region'])->name('public.region');
Route::get('/city/{city:slug}', [HomeController::class, 'city'])->name('public.city');
Route::get('/village/{village:slug}', [HomeController::class, 'village'])->name('public.village');
Route::get('/author/{user}', [HomeController::class, 'author'])->name('public.author');


Route::get('verification-notice', function () {
  return redirect()->route('home')->with('status', 'Verify your email or <a href="' . route('resend-email') . '">Resend verification email</a>');
})->name('verification.notice');


// Guest pages
Route::group(['middleware' => ['guest']], function () {

  Route::get('login', function () {
    return view('auth.login');
  })->name('auth.login');

  Route::get('register', function () {
    return view('auth.register');
  })->name('auth.register');

  Route::get('forgot-password', function () {
    return view('auth.forgot-password');
  });
  
  /*
    Social logins
    */

  // Github
  Route::get('/auth/github', [SocialLoginController::class, 'github']);
  Route::get('/auth/github-login', [SocialLoginController::class, 'github_callback']);

  // Facebook
  Route::get('/auth/facebook', [SocialLoginController::class, 'facebook']);
  Route::get('/auth/facebook-login', [SocialLoginController::class, 'facebook_callback']);

  // Twitter
  Route::get('/auth/twitter', [SocialLoginController::class, 'twitter']);
  Route::get('/auth/twitter-login', [SocialLoginController::class, 'twitter_callback']);

  // Google
  Route::get('/auth/google', [SocialLoginController::class, 'google']);
  Route::get('/auth/google-login', [SocialLoginController::class, 'google_callback']);
});



// Author pages
Route::group(['middleware' => ['role:super-admin|basic-user', 'verified']], function () {

  Route::prefix('dashboard')->group(function () {

    Route::get('profile', [AuthorController::class, 'profile'])->name('author.profile');
    Route::post('update-profile', [AuthorController::class, 'update_profile'])->name('author.update-profile');
    Route::get('upload', [AuthorController::class, 'upload'])->name('author.upload');
    Route::post('store', [AuthorController::class, 'store'])->name('author.store');
    Route::get('edit/{id}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::put('update/{id}', [AuthorController::class, 'update'])->name('author.update');
    Route::delete('destroy/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');
    Route::delete('delete_image/{id}', [AuthorController::class, 'delete_image'])->name('author.delete_image');
    Route::get('uploads', [AuthorController::class, 'uploads'])->name('author.uploads');
    Route::get('resend-email', function () {
      return view('users.resend-email');
    });
  });
});

Route::group(['middleware' => ['role:super-admin|basic-user']], function () {

  Route::get('/resend-email', [UserController::class, 'resend'])->name('resend-email');

  Route::post('/resend-email-verification', [UserController::class, 'resend_email'])->name('resend-email-verification');

  

});
// Super Admin pages
Route::group(['middleware' => ['role:super-admin', 'verified']], function () {

  Route::prefix('admin')->group(function () {

    Route::get('', [UserController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::resource('user', UserController::class);
    Route::resource('village', VillageController::class);
    Route::resource('city', CityController::class);
    Route::resource('region', RegionController::class);
    Route::resource('image', ImageController::class);
    Route::resource('post', PostController::class);

    Route::resource('setting', SettingController::class);
  });
});
