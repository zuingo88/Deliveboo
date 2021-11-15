<?php

use Illuminate\Database\Seeder;
use App\Dish;
use App\User;
class DishSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    //One to Many  Restaurant to Dishes
    factory(Dish::class, 30) -> make()
    -> each(function($dish)
    {
      $user = User::inRandomOrder() -> first();
      $dish-> user() -> associate($user);
      $dish -> save();
    });
  }
}
