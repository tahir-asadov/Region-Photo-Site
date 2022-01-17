<?php

namespace Database\Seeders;

use Database\Seeders\Local\LocalDatabaseSeeder;
use Database\Seeders\Production\ProductionDatabaseSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    // Load production seeder
    if (App::Environment() === 'production') {
      $this->call(ProductionDatabaseSeeder::class);
    }

    // Load local seeder
    if (App::Environment() === 'local') {
      $this->call(LocalDatabaseSeeder::class);
    }
  }
}
