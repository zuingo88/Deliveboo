@extends('layouts.main-layout')

@section('content')

  <main>
    <div id="app" v-cloak>
      <div id="showRestaurant">

        @if (Auth::check() && Auth::user()->id != $user->id)

          {{-- sezione myrestaurant --}}
          <section id="myrestaurant">

            {{-- <h2>Ciao {{ Auth::user()->name }}</h2> --}}

            {{-- link al mio ristorante --}}
            <a href="{{ route('show', Auth::user()->id) }}">
              <h3>Vai al tuo ristorante "{{ Auth::user()->nome_attivita }}" <i class="fas fa-angle-double-right"></i></h3>
            </a>

          </section>
        @endif

        <div class="mycontainer relative">

          @if (Auth::check() && Auth::user()->id == $user->id)
          @else
            {{-- CARRELLO PER CLIENTE E USER NON PROPRIETARIO --}}
            {{-- carrello icona --}}
            <div class="cart flex_center absolute" @click="showCart" title="Vai al tuo Ordine">
              <img src="{{ asset('/storage/images/shopping-cart.png') }}" alt="carrello" class="relative">

              {{-- bollino --}}
              <div v-if='cartItems > 0' class="cart_count flex_center absolute animate__animated animate__shakeY">
                <span>@{{ cartItems }}</span>
              </div>
            </div>
          @endif

          {{-- carrello aperto --}}
          <div class="opened_cart flex_col animate__animated animate__fadeInRight" :hidden="cartHidden">

            <div @click="showCart" class="riduci_row flex just_end align_cen">
              <div class="riduci flex_center">
                <p>Riduci</p>
                <h6><i class="fas fa-long-arrow-alt-right"></i></h6>
              </div>
            </div>

            <h3>Il tuo ordine</h3>
            <h4>Ristorante: {{ $user->nome_attivita }}</h4>
            <h5>Totale prodotti: @{{ cartItems }} </h5>

            <ul>
              <li v-for='(dish, index) in carrello'>
                <h6>@{{ dish . nome }}</h6>
                <p>Prezzo: <b>@{{ carrello[index] . prezzo * carrello[index] . counter . toFixed(2) }} €</b></p>
                {{-- <p>Quantità: <b>@{{ dish . counter }}</b></p> --}}
                <p class="flex_center">
                  <i class="fas fa-minus" @click='decrease(dish.id, index)'></i>
                  <span>Quantità: <b>@{{ dish . counter }}</b></span>

                  <i class="fas fa-plus" @click='increase(dish.id, index)'></i>
                </p>
              </li>
              <li>
                <h5>Totale: @{{ totalPrice . toFixed(2) }} €</h5>
              </li>

            </ul>

            {{-- submit --}}
            <form class="flex_center" :action="/createOrder/" method="post">
              @csrf
              <input type="hidden" name="totalPrice" :value="totalPrice.toFixed(2)">
              <input type="hidden" name="carrelloIDs" :value="carrelloIDs">
              <button type="submit" class="btn-link">
                Vai al Checkout <i class="fas fa-angle-double-right"></i>
              </button>
            </form>
            {{-- FINE CARRELLO PER CLIENTE E USER NON PROPRIETARIO --}}
          </div>

          @if (Auth::check() && Auth::user()->id == $user->id)

            {{-- HELPER USER PROPRIETARIO --}}
            <div class="helper_ristoratore relative">

              <h2>Ciao {{ $user->name }} {{ $user->cognome }} <i class="fas fa-info-circle animate__animated animate__bounceIn"
                  @click="showHelperInfo" title="Info Ristoratore"></i></h2>

              <h4>Questa è la pagina riservata al tuo ristorante "{{ $user->nome_attivita }}"</h4>

              <div class="helper_info" :hidden="hiddenHelperInfo">
                <p>Da qui potrai gestire il tuo menu, con la possibilità di aggiungere nuovi piatti, modificarli,
                  eliminarli o renderli momentaneamente non accessibili ai tuoi clienti.
                  <br>&ensp;Potrai sempre controllare lo stato di ogni singolo ordine ricevuto ed avrai una visione
                  completa
                  ed aggiornata in tempo reale dell'andamento della tua attività e consultare ogni tipo di statistica.
                </p>
              </div>
              {{-- FINE HELPER USER PROPRIETARIO --}}
            </div>

            {{-- INFO USER PROPRIETARIO --}}
            <div class="restaurant_info flex_col align_cen">

              <h5>Il nome della tua attività:</h5>

              <h2>{{ $user->nome_attivita }}</h2>

              {{-- info card ristorante --}}
              <div class="restaurant_info_card ristoratore flex_col just_cen align_cen">
                {{-- immagine ristorante --}}
                <div class="restaurant_image">
                  <img src="{{ asset('/storage/restaurantImages/' . $user->file_path) }}" alt="immagine_ristorante"
                    alt="">
                </div>

                <div class="flex_center">
                  <div class="info_card_row_container">

                    <h5>Le tue informarzioni visibili al pubblico</h5>

                    <div class="info_card_row flex align_cen">
                      <i class="fas fa-utensils"></i>
                      <h6>Tipo di Cucina:

                        @foreach ($user->types->sortBy('nome') as $type)

                          {{ $loop->last ? $type->nome : $type->nome . ', ' }}

                        @endforeach

                      </h6>
                    </div>

                    <div class="info_card_row flex align_cen">
                      <i class="fas fa-map-marker-alt"></i>
                      <h6>{{ $user->via }} {{ $user->n_civico }}, {{ $user->citta }},
                        {{ $user->cap }}</h6>
                    </div>

                    <div class="info_card_row flex align_cen">
                      <i class="far fa-envelope"></i>
                      <h6>{{ $user->email }}</h6>
                    </div>
                  </div>
                </div>
              </div>
              {{-- FINE INFO USER PROPRIETARIO --}}
            </div>

            {{-- @endif autenticato --}}
          @else

            {{-- INFO CLIENTE E USER NON PROPRIETARIO --}}
            <div class="restaurant_info flex_col align_cen">

              <h2>{{ $user->nome_attivita }}</h2>

              {{-- info card ristorante --}}
              <div class="restaurant_info_card flex_col just_end">
                {{-- immagine ristorante --}}
                <div class="restaurant_image">
                  <img src="{{ asset('/storage/restaurantImages/' . $user->file_path) }}" alt="immagine_ristorante"
                    alt="">
                </div>

                <div class="flex_center">
                  <div class="info_card_row_container">
                    <div class="info_card_row flex align_cen">
                      <i class="fas fa-utensils"></i>
                      <h6 class="flex_wrap">Tipo di Cucina:

                        @foreach ($user->types->sortBy('nome') as $type)

                          {{ $loop->last ? $type->nome : $type->nome . ', ' }}

                        @endforeach

                      </h6>
                    </div>

                    <div class="info_card_row flex align_cen">
                      <i class="fas fa-map-marker-alt"></i>
                      <h6>{{ $user->via }} {{ $user->n_civico }}, {{ $user->citta }},
                        {{ $user->cap }}</h6>
                    </div>

                    <div class="info_card_row flex align_cen">
                      <i class="far fa-envelope"></i>
                      <h6>{{ $user->email }}</h6>
                    </div>
                  </div>
                </div>
              </div>
              {{-- FINE INFO CLIENTE E USER NON PROPRIETARIO --}}
            </div>

          @endif

          <div class="menu_container flex_col align_cen">

            @if (Auth::check() && Auth::user()->id == $user->id)

              {{-- OPZIONI USER PROPRIETARIO --}}
              <div class="restaurant_options flex space_bet">

                {{-- option_card --}}
                <div class="option_card" title="Crea nuovo prodotto">
                  <a href="{{ route('createDish') }}" class="flex space_bet align_cen">
                    <h6>Aggiungi nuovo prodotto</h6>
                    <i class="fas fa-plus"></i>
                  </a>
                </div>

                <div class="option_card" title="Guarda gli ordini ricevuti">
                  <a href="{{ route('showOrders', $user->id) }}" class="flex space_bet">
                    <h6>Ordini Ricevuti</h6>
                    <i class="fas fa-clipboard-list"></i>
                  </a>
                </div>

                <div class="option_card" title="Guarda statistiche">
                  <a href="{{ route('statistiche', $user->id) }}" class="flex space_bet align_cen">
                    <h6>Statistiche Ordini</h6>
                    <i class="fas fa-chart-line"></i>
                  </a>
                </div>
                {{-- FINE OPZIONI USER PROPRIETARIO --}}
              </div>

            @endif

            <h3>Menu</h3>

            <ul class="flex_wrap">

              @foreach ($user->dishes->sortBy('created_at') as $dish)

                @if (Auth::check() && Auth::user()->id == $user->id && !$dish->deleted)

                  {{-- CARD PIATTO USER PROPRIETARIO --}}
                  <li>
                    {{-- card piatto --}}
                    <div class="dish_card flex_col just_start {{ !$dish->visibilita ? 'chiaro' : '' }}"
                      title="Aggiungi {{ $dish->nome }} al carrello">
                      <div class="dish_title_price flex space_bet align_cen">
                        <h5 class="flex_center">
                          {{ $dish->nome }}
                          @if (!$dish->visibilita)
                             <i class="far fa-eye-slash"></i> 
                          @endif
                        </h5>
                        <h6>{{ round($dish->prezzo, 2) }} €</h6>
                      </div>
                      <p><span>Ingredienti:</span> {{ $dish->ingredienti }}</p>
                      <p><span>Descrizione:</span> {{ $dish->descrizione }}</p>

                      {{-- tasti ristoratore --}}
                      {{-- edit --}}
                      <div class="edit_row" title="Modifica prodotto">
                        <a href="{{ route('editDish', $dish->id) }}" class="flex space_bet align_cen">
                          <p>Modifica</p>
                          <i class="far fa-edit"></i>
                        </a>
                      </div>

                      {{-- delete --}}
                      <div class="delete_row" title="Elimina prodotto">
                        <a href="{{ route('destroy', [$dish->id, $user->id]) }}" class="flex space_bet align_cen">
                          <p>Elimina Prodotto</p>
                          <i class="far fa-trash-alt"></i>
                        </a>
                      </div>

                      {{-- @if (!$dish->visibilità)
                          <h6>Prodotto non visibile</h6>
                      @endif --}}
                    </div>
                    {{-- FINE CARD PIATTO USER PROPRIETARIO --}}
                  </li>

                @else

                  @if (!$dish->deleted && $dish->visibilita)

                    {{-- CARD PIATTO CLIENTE E USER NON PROPRIETARIO --}}
                    <li>
                      {{-- card piatto --}}
                      <div class="dish_card flex_col just_start" title="Aggiungi {{ $dish->nome }} al carrello">
                        <div class="dish_title_price flex_wrap space_bet align_cen">
                          <h5>{{ $dish->nome }}</h5>
                          <h6>{{ round($dish->prezzo, 2) }} €</h6>
                        </div>
                        <p><span>Ingredienti:</span> {{ $dish->ingredienti }}</p>
                        <p><span>Descrizione:</span> {{ $dish->descrizione }}</p>

                        @if (Auth::check() && Auth::user()->id == $user->id)
                        @else
                          {{-- bottone aggiungi al carrello per guest e user in ristorante non proprio --}}
                          <button @click="addToCart({{ $dish }})" class="flex_center">
                            Aggiungi all'ordine <i class="fas fa-cart-plus"></i>
                          </button>
                        @endif

                      </div>
                      {{-- FINE CARD PIATTO CLIENTE E USER NON PROPRIETARIO --}}
                    </li>
                  @endif

                @endif
              @endforeach
            </ul>
            {{-- fine menu_container --}}
          </div>
          {{-- fine mycontainer --}}
        </div>
        {{-- fine #showRestaurant --}}
      </div>
      {{-- fine #app --}}
    </div>
  </main>

@endsection
