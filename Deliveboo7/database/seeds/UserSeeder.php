<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Type;

class UserSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    //Many to Many  Restaurants to Types
    factory(User::class, 10) -> create()
    -> each(function($user)
    {
      $types = Type::inRandomOrder()
      -> limit(rand(1, 3))
      -> get();
      $user -> types() -> attach($types);
      $user -> save();
    });
  }
}
