@extends('layouts.main-layout')
@section('content')
<main>
  <div id='contattaci' >
    <div class="mycontainer">
      <h1 >Contattaci</h1>
      <div class="flex space_bet container-box flex_wrap">

        <div class="boxQuestion">
          <div class="questionOne ">
            <h6>
              Domande Per Il Customer Service
            </h6>
          </div>
          <div class="questionTwo ">
            <h6>
              Contatti Media
            </h6>
          </div>
        </div>

        <div class="boxAnswers">
          <div>
            <h2>Domande Per Il Customer Service</h2>
            <h6>Domande sul tuo ordine?</h6>
            <p class="border-email">Siamo qui per aiutarti! Mandaci una email a <a href="https://mail.google.com/">support@deliveboo.it</a>.
              Ti segnaliamo che al momento non accettiamo ordini al telefono. Per questa ragione, se vuoi fare un ordine,
              per favore procedi attraverso il sito o la app.
            </p>
          </div>

          <div>
            <h2>Contatti Media</h2>
            <p>Per le interviste o altre richieste media, per favore scrivi una mail a press@deliveboo.com.
              Purtroppo l'ufficio stampa non ha accesso alle informazioni sugli account, quindi non può essere
              d'aiuto con le richieste dei clienti. Si prega di contattare il servizio clienti.
            </p>

            <p>Sede legale: Deliveboo Italy S.R.L.Via Carlo Bo 11 Milano 20143</p>
          </div>

        </div>
      </div>
    </div>


  </div>
</main>


@endsection
