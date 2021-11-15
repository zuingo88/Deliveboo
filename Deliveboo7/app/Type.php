<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
  protected $fillable = [
    'nome',
  ];

  //Many to Many  Restaurants to Types
  public function users() {

    return $this -> belongsToMany(User::class);
  }
}
