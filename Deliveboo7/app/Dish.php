<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Dish extends Model
{
  protected $fillable = [

    'nome',
    'ingredienti',
    'descrizione',
    'prezzo',
    'visibilita',
    'user_id',
  ];


  //One to Many    Restaurant to Dishes
  public function user()
  {
    return $this -> belongsTo(User::class);
  }

  //Many to Many  Dishes to orders
  public function orders() {

    return $this -> belongsToMany(Order::class);
  }
}
