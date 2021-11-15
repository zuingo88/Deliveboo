<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Conferma ordine Deliveboo</title>

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

    <h1>Ciao {{ $editableOrder->nome_cliente }}!</h1>

    <h3>Il tuo acquisto presso "{{ $nome }}" è andato a buon fine!</h3>

    <p>L'ordine è stato preso in carico ed è già in preparazione.
      <br>Non resta che rilassarti! A breve Deliveboo sarà da te con i tuoi piatti preferiti.
    </p>

    <h2>Dettagli del tuo Ordine</h2>

    <p>Codice Ordine: {{ $editableOrder->id }}</p>

    <p>Importo pagato: {{ round($editableOrder->totalPrice, 2) }} €</p>

    <p>Indirizzo di spedizione: Via {{ $editableOrder->via }} {{ $editableOrder->n_civico }},
      {{ $editableOrder->citta }}, {{ $editableOrder->cap }}.</p>

    @if ($editableOrder->note)

      <p>Note Cliente: {{ $editableOrder->note }}</p>

    @endif

  </div>

  <div class="contact">
    <h4>Deliveboo Team</h4>
    {{-- <p>This message was sent to you, as a Deliveboo user, consistent with your email preferences.</p> --}}
    <p>Il team di Deliveroo ti ringrazia per aver usato la nosta app per effettuare il tuo ordine e ti aspetta per il
      prossimo, con sempre più novità e vantaggi ad aspettarti!</p>
  </div>
</body>

</html>
