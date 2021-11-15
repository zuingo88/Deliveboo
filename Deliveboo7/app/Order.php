<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [

    'nome_cliente',
    'cognome_cliente',
    'email_cliente',
    'via',
    'n_civico',
    'citta',
    'cap',
    'telefono',
    'note',
    'status',
    'totalPrice',
  ];

  //One to Many   Restaurant to Orders
  public function user(){
    return $this -> belongsTo(User::class);
  }

  //Many to Many  Dishes to orders
  public function dishes() {

    return $this -> belongsToMany(Dish::class);
  }
}
