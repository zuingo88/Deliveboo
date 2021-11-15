<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Nuovo Ordine Deliveboo</title>

  {{-- <style media="screen">
    * {
      font-family: system-ui;
    }

    .logo,
    footer {
      background-color: #2a9d8f;
      padding: 5px;
      text-align: center;
      border-radius: 5px;
    }

    .logo h1 {
      color: #f4a261;
      text-shadow: 2px 2px 2px rgb(50 50 50 / 91%);
    }

    .scheda {
      width: 60%;
      margin: 20px auto;
      padding-bottom: 20px;
      border: 1px solid;
      border-radius: 5px;
      border-color: #2A9D8F;
      background: linear-gradient(0deg, #2a9d8f 0%, #f4a261 35%, #e9c46a 75%);
      text-align: center;
    }

    .scheda h3 {
      margin: 2px;
    }

    .contact p,
    h4 {
      margin: 0;
    }

    footer {

      background-color: black;
    }

    footer ul {

      list-style: none;
    }

    li {

      display: inline-block;
    }

    li a {

      color: white;
    }

  </style>
</head>

<body>
  <div class="logo">
    <h1>Deliveboo</h1>
  </div>
  <div class="scheda">
    <h1>Ciao {{ $nome }} </br> Hai ricevuto un nuovo ordine da {{ $editableOrder->nome_cliente }}</h1>

    <h3>
      ID ordine: {{ $editableOrder->id }}

    </h3>
    <h3>
      Importo pagato: {{ round($editableOrder->totalPrice, 2) }} €

    </h3>
    <h3>
      Indirizzo di spedizione: Via {{ $editableOrder->via }} , {{ $editableOrder->n_civico }}
    </h3>

    <h3>

      Puoi contattare il cliente al numero: {{ $editableOrder->telefono }}

    </h3>

    @if ($editableOrder->note)
      <h3>
        Note Cliente: {{ $editableOrder->note }}
      </h3>
    @endif

  </div>
  <div class="contact">
    <h4>Deliveboo Team</h4>
    <p>This message was sent to you, as a Deliveboo user, consistent with your email preferences.</p>
  </div>

</body> --}}





  <style media="screen">
    * {
      font-family: "Dosis", sans-serif;
      /* font-size: 20px; */
      color: #264653;
    }

    h1,
    h2,
    h4 {
      text-align: center;
    }

    .logo {
      background-color: #2a9d8f;
      padding: 10px 20px;
      text-align: center;
    }

    .logo h1 {
      font-size: 30px;
      color: #f4a261;
      text-shadow: 2px 2px 2px rgb(50 50 50 / 91%);
    }

    .scheda {
      padding: 10px 20px;
      border-color: #2A9D8F;
      background: linear-gradient(0deg, #2a9d8f 0%, #f4a261 35%, #e9c46a 75%);
      text-align: left;
    }

    .contact {
      padding: 10px 20px;

      background-color: #264653;
    }

    .contact p,
    h4 {
      color: #dcdcdc;
    }

  </style>
</head>

<body>

  <div class="logo">
    <h1>Deliveboo</h1>
  </div>
  <div class="scheda">

    <h1>Ciao {{ $nome }}! </br> Hai ricevuto un nuovo ordine da {{ $editableOrder->nome_cliente }}!</h1>

    <h2>Dettagli dell'Ordine</h2>

    <p>Codice Ordine: {{ $editableOrder->id }}</p>

    <p>Importo totale: {{ round($editableOrder->totalPrice, 2) }} €</p>

    <p>Indirizzo di spedizione: Via {{ $editableOrder->via }} {{ $editableOrder->n_civico }},
      {{ $editableOrder->citta }}, {{ $editableOrder->cap }}.</p>

    @if ($editableOrder->note)

      <p>Note Cliente: {{ $editableOrder->note }}</p>

    @endif

    <h3>Puoi contattare il cliente al numero: {{ $editableOrder->telefono }}</h3>

  </div>

  <div class="contact">
    <h4>Deliveboo Team</h4>
    {{-- <p>This message was sent to you, as a Deliveboo user, consistent with your email preferences.</p> --}}
    <p>Il team di Deliveroo ti ringrazia per aver usato la nosta app per ricevere questo ordine e ti augura una
      fantastica collaborazione con noi.</p>
  </div>

</body>

</html>
