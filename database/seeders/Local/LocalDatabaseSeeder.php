<?php

namespace Database\Seeders\Local;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class LocalDatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // Delete seeded images
    $source_path = storage_path('app/public/post_images/*.seeded.jpg');
    $images      = glob($source_path);

    array_walk($images, function ($image) {
      unlink($image);
    });

    // Create super admin and basic user role
    Role::create(['name' => 'super-admin']);
    Role::create(['name' => 'basic-user']);


    if (env('SUPER_ADMIN_EMAIL') != '' && env('SUPER_ADMIN_PASS') != '') {

      // Create super administrator
      $superAdministrator = \App\Models\User::factory()->create(
        [
          'name' => 'Super Administrator',
          'email' => env('SUPER_ADMIN_EMAIL'),
          'email_verified_at' => now(),
          'password' => Hash::make(env('SUPER_ADMIN_PASS')),
        ]
      );
      $superAdministrator->assignRole('super-admin');
    }

    if (env('BASIC_USER_EMAIL') != '' && env('BASIC_USER_PASS') != '') {

      // Create basic user
      $basicUser = \App\Models\User::factory()->create(
        [
          'name' => 'Basic User',
          'email' => env('BASIC_USER_EMAIL'),
          'email_verified_at' => now(),
          'password' => Hash::make(env('BASIC_USER_PASS')),
        ]
      );
      $basicUser->assignRole('basic-user');
    }

    $users = \App\Models\User::all();

    $regions = \App\Models\Region::factory(3)->create();
    $cities = \App\Models\City::factory(3)->create();
    $villages = \App\Models\Village::factory(3)->create();

    foreach ($users as $key => $user) {
      $user->assignRole('basic-user');
      foreach ($regions as $key => $region) {
        foreach ($cities as $key => $city) {
          foreach ($villages as $key => $village) {
            $posts = \App\Models\Post::factory(2)->state([
              'region_id' => $region->id,
              'city_id' => $city->id,
              'village_id' => $village->id,
              'published' => 1,
              'user_id' => $user->id,
            ])->create();

            foreach ($posts as $key => $post) {
              \App\Models\Image::factory(3)->state([
                'post_id' => $post->id
              ])->create();
            }
          }
        }
      }
    }
  }
}
