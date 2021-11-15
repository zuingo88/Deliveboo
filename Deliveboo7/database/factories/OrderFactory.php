<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Order;

$autoIncrement = autoIncrement();

$factory->define(Order::class, function (Faker $faker) use ($autoIncrement) {
    $autoIncrement->next();

    $orders = [
        [
            'nome_cliente' => 'Ajeje1',
            'cognome_cliente' => 'Brazorf',
            'email_cliente' => 'prova@gmail.com',
            'via' => 'Via dei matti',
            'n_civico' => '0',
            'citta' => 'Roma',
            'cap' => '00014',
            'telefono' => '3333333333',
            'note' => 'non suonare',
            'status' => 'accettato',
            'totalPrice' => 10.50,
        ],
        [
            'nome_cliente' => 'Ajeje2',
            'cognome_cliente' => 'Brazorf',
            'email_cliente' => 'prova@gmail.com',
            'via' => 'Via dei matti',
            'n_civico' => '0',
            'citta' => 'Roma',
            'cap' => '00014',
            'telefono' => '3333333333',
            'note' => 'non suonare',
            'status' => 'accettato',
            'totalPrice' => 10,
        ],
        [
            'nome_cliente' => 'Ajeje3',
            'cognome_cliente' => 'Brazorf',
            'email_cliente' => 'prova@gmail.com',
            'via' => 'Via dei matti',
            'n_civico' => '0',
            'citta' => 'Roma',
            'cap' => '00014',
            'telefono' => '3333333333',
            'note' => 'non suonare',
            'status' => 'accettato',
            'totalPrice' => 10,
        ],
        [
            'nome_cliente' => 'Ajeje4',
            'cognome_cliente' => 'Brazorf',
            'email_cliente' => 'prova@gmail.com',
            'via' => 'Via dei matti',
            'n_civico' => '0',
            'citta' => 'Roma',
            'cap' => '00014',
            'telefono' => '3333333333',
            'note' => 'non suonare',
            'status' => 'accettato',
            'totalPrice' => 10,
        ],
        [
            'nome_cliente' => 'Ajeje5',
            'cognome_cliente' => 'Brazorf',
            'email_cliente' => 'prova@gmail.com',
            'via' => 'Via dei matti',
            'n_civico' => '0',
            'citta' => 'Roma',
            'cap' => '00014',
            'telefono' => '3333333333',
            'note' => 'non suonare',
            'status' => 'accettato',
            'totalPrice' => 10,
        ],
        [
            'nome_cliente' => 'Ajeje6',
            'cognome_cliente' => 'Brazorf',
            'email_cliente' => 'prova@gmail.com',
            'via' => 'Via dei matti',
            'n_civico' => '0',
            'citta' => 'Roma',
            'cap' => '00014',
            'telefono' => '3333333333',
            'note' => 'non suonare',
            'status' => 'accettato',
            'totalPrice' => 10,
        ],
        [
            'nome_cliente' => 'Ajeje7',
            'cognome_cliente' => 'Brazorf',
            'email_cliente' => 'prova@gmail.com',
            'via' => 'Via dei matti',
            'n_civico' => '0',
            'citta' => 'Roma',
            'cap' => '00014',
            'telefono' => '3333333333',
            'note' => 'non suonare',
            'status' => 'accettato',
            'totalPrice' => 10,
        ],
        [
            'nome_cliente' => 'Ajeje8',
            'cognome_cliente' => 'Brazorf',
            'email_cliente' => 'prova@gmail.com',
            'via' => 'Via dei matti',
            'n_civico' => '0',
            'citta' => 'Roma',
            'cap' => '00014',
            'telefono' => '3333333333',
            'note' => 'non suonare',
            'status' => 'accettato',
            'totalPrice' => 10,
        ],
        [
            'nome_cliente' => 'Ajeje9',
            'cognome_cliente' => 'Brazorf',
            'email_cliente' => 'prova@gmail.com',
            'via' => 'Via dei matti',
            'n_civico' => '0',
            'citta' => 'Roma',
            'cap' => '00014',
            'telefono' => '3333333333',
            'note' => 'non suonare',
            'status' => 'accettato',
            'totalPrice' => 10,
        ],
        [
            'nome_cliente' => 'Ajeje10',
            'cognome_cliente' => 'Brazorf',
            'email_cliente' => 'prova@gmail.com',
            'via' => 'Via dei matti',
            'n_civico' => '0',
            'citta' => 'Roma',
            'cap' => '00014',
            'telefono' => '3333333333',
            'note' => 'non suonare',
            'status' => 'accettato',
            'totalPrice' => 10,
        ],

    ];

    $index = $autoIncrement -> current();
    $order = $orders[$index];
    // dd($index);
    return [

        'nome_cliente' => $order['nome_cliente'],
        'cognome_cliente' => $order['cognome_cliente'],
        'email_cliente' => $order['email_cliente'],
        'via' => $order['via'],
        'n_civico' => $order['n_civico'],
        'citta' => $order['citta'],
        'cap' => $order['cap'],
        'telefono' => $order['telefono'],
        'note' => $order['note'],
        'status' => $order['status'],
        'totalPrice' => $order['totalPrice'],
    ];
});

function autoIncrement()
{
  for ($i = -1; $i <= 10; $i++) {
    yield $i;
  }
}
