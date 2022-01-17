<?php

namespace Database\Seeders\Production;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProductionDatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
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
  }
}
