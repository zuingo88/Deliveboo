@extends('layouts.main-layout')

@section('content')

  <main>
    <div id="app" v-cloak>
      <div id="showOrders">

        {{-- sezione myrestaurant --}}
        <section id="myrestaurant">

          {{-- <h2>Ciao {{ Auth::user()->name }}</h2> --}}

          {{-- link al mio ristorante --}}
          <a href="{{ route('show', Auth::user()->id) }}">
            <h3>Torna al tuo ristorante "{{ Auth::user()->nome_attivita }}" <i class="fas fa-angle-double-right"></i></h3>
          </a>

        </section>

        <div class="mycontainer">

          <h5>Questi sono gli ordini ricevuti dal tuo ristorante</h5>

          {{-- orders_container --}}
          <div class="orders_container">
            <ul>
              <li>

                {{-- contenitore ordini accettati --}}
                <div class="accepted_orders_container">

                  <div class="status_title flex space_bet align_cen">
                    <h4>
                      Ordini In Elaborazione
                      @php
                        $orderCountArray = [];
                        
                        foreach ($orderSel as $order) {
                            if ($order->status == 'accettato') {
                                array_push($orderCountArray, $order);
                            }
                        }
                      @endphp
                      [{{ count($orderCountArray) }}]
                    </h4>
                    <div class="open_close flex align_cen">
                      <i class="fas fa-chevron-circle-up" :hidden="hiddenOrdersAccettati" @click="showOrdersAccettati"
                        title="Riduci ordini"></i>
                      <i class="fas fa-chevron-circle-down" :hidden="hiddenChevronAccettati" @click="showOrdersAccettati"
                        title="Espandi ordini"></i>
                    </div>
                  </div>

                  <div class="accepted_orders" :hidden="hiddenOrdersAccettati">

                    <ul class="flex_wrap space_bet">

                      @foreach ($orderCountArray as $restaurantOrder)


                        {{-- card ordine accettato --}}
                        <li>

                          <div class="accepted order_card flex_col align_start">

                            {{-- data --}}
                            <div class="order_card_row">
                              <h6><i class="fas fa-calendar-day"></i>Ordine del:
                                {{ $restaurantOrder->created_at }}
                              </h6>
                            </div>

                            {{-- stato --}}
                            <div class="order_card_row accettato flex align_cen">
                              <h6><i class="fas fa-hourglass-half"></i>Stato Ordine:</h6>
                              <h6>&#160;In Elaborazione</h6>
                            </div>

                            {{-- cliente --}}
                            <div class="order_card_row">
                              <h6><i class="fas fa-user-alt"></i>Cliente:
                                {{ $restaurantOrder->nome_cliente }}
                                {{ $restaurantOrder->cognome_cliente }} - Tel
                                {{ $restaurantOrder->telefono }}
                              </h6>
                            </div>

                            {{-- prodotti ordinati --}}
                            <div class="order_card_row">
                              <h6><i class="fas fa-drumstick-bite"></i>Prodotti ordinati:

                                @php
                                  
                                  $orderedDishes = [];
                                  $orderedDishesID = [];
                                  
                                  foreach ($restaurantOrder->dishes as $dish) {
                                      if (!in_array($dish->id, $orderedDishesID)) {
                                          $dish->counter = 1;
                                  
                                          array_push($orderedDishesID, $dish->id);
                                          array_push($orderedDishes, $dish);
                                      } else {
                                          foreach ($orderedDishes as $singleDish) {
                                              if ($singleDish->id == $dish->id) {
                                                  $singleDish->counter++;
                                              }
                                          }
                                      }
                                  }
                                  
                                  // dd($orderedDishes);
                                  
                                @endphp

                                @foreach ($orderedDishes as $dish)
                                  @if ($loop->last)
                                    @if ($dish->counter == 1)
                                      {{ $dish->nome }}
                                    @else
                                      {{ $dish->nome . ' x' . $dish->counter }}
                                    @endif


                                  @else
                                    @if ($dish->counter == 1)
                                      {{ $dish->nome . ', ' }}
                                    @else
                                      {{ $dish->nome . ' x' . $dish->counter . ', ' }}
                                    @endif

                                  @endif

                                @endforeach
                              </h6>
                            </div>

                            {{-- pagamento --}}
                            <div class="order_card_row">
                              <h6><i class="fas fa-euro-sign"></i>Pagamento:
                                {{ $restaurantOrder->totalPrice }} €
                              </h6>
                            </div>

                            {{-- indirizzo consegna --}}
                            <div class="order_card_row">
                              <h6><i class="fas fa-map-marker-alt"></i>Da consegnare in : Via
                                {{ $restaurantOrder->via }}
                                {{ $restaurantOrder->n_civico }},
                                {{ $restaurantOrder->citta }},
                                {{ $restaurantOrder->cap }}
                              </h6>
                            </div>

                            {{-- note --}}
                            @if ($restaurantOrder->note)
                              <div class="order_card_row">
                                <p><i class="fas fa-sticky-note"></i>Note:
                                  "{{ $restaurantOrder->note }}"</p>
                              </div>
                            @endif

                            <a class="flex_center" href="{{ route('editStatus', $restaurantOrder->id) }}">
                              <i class="fas fa-check-circle"></i>
                              Ordine Evaso
                            </a>

                          </div>
                        </li>

                      @endforeach
                    </ul>
                  </div>
                </div>
                {{-- fine ordini in elaborazione --}}
              </li>


              {{-- contenitore ordini rifiutati --}}
              <li>
                <div class="refused_orders_container">

                  <div class="status_title flex space_bet align_cen">
                    <h4>Ordini Rifiutati</h4>
                    <div class="open_close flex align_cen">
                      <i class="fas fa-chevron-circle-up" :hidden="hiddenOrdersRifiutati" @click="showOrdersRifiutati"
                        title="Riduci ordini"></i>
                      <i class="fas fa-chevron-circle-down" :hidden="hiddenChevronRifiutati" @click="showOrdersRifiutati"
                        title="Espandi ordini"></i>
                    </div>
                  </div>

                  <div class="refused_orders" :hidden="hiddenOrdersRifiutati">

                    <ul class="flex_wrap space_bet">

                      @foreach ($orderSel as $restaurantOrder)

                        @if ($restaurantOrder->status == 'in sospeso')

                          <li>

                            {{-- card ordine rifiutato --}}
                            <div class="refused order_card flex_col align_start">

                              {{-- data --}}
                              <div class="order_card_row">
                                <h6><i class="fas fa-calendar-day"></i>Ordine del:
                                  {{ $restaurantOrder->created_at }}
                                </h6>
                              </div>

                              {{-- stato --}}
                              <div class="order_card_row sospeso flex align_cen">
                                <h6><i class="fas fa-times-circle"></i>Stato Ordine:</h6>
                                <h6>&#160;Rifiutato</h6>
                              </div>

                              {{-- cliente --}}
                              <div class="order_card_row">
                                <h6><i class="fas fa-user-alt"></i>Cliente:
                                  {{ $restaurantOrder->nome_cliente }}
                                  {{ $restaurantOrder->cognome_cliente }} - Tel
                                  {{ $restaurantOrder->telefono }}
                                </h6>
                              </div>

                              {{-- prodotti ordinati --}}
                              <div class="order_card_row">
                                <h6><i class="fas fa-drumstick-bite"></i>Prodotti ordinati:

                                  @php
                                    
                                    $orderedDishes = [];
                                    $orderedDishesID = [];
                                    
                                    foreach ($restaurantOrder->dishes as $dish) {
                                        if (!in_array($dish->id, $orderedDishesID)) {
                                            $dish->counter = 1;
                                    
                                            array_push($orderedDishesID, $dish->id);
                                            array_push($orderedDishes, $dish);
                                        } else {
                                            foreach ($orderedDishes as $singleDish) {
                                                if ($singleDish->id == $dish->id) {
                                                    $singleDish->counter++;
                                                }
                                            }
                                        }
                                    }
                                    
                                    // dd($orderedDishes);
                                    
                                  @endphp

                                  @foreach ($orderedDishes as $dish)
                                    @if ($loop->last)
                                      @if ($dish->counter == 1)
                                        {{ $dish->nome }}
                                      @else
                                        {{ $dish->nome . ' x' . $dish->counter }}
                                      @endif


                                    @else
                                      @if ($dish->counter == 1)
                                        {{ $dish->nome . ', ' }}
                                      @else
                                        {{ $dish->nome . ' x' . $dish->counter . ', ' }}
                                      @endif

                                    @endif

                                  @endforeach
                                </h6>
                              </div>

                              {{-- pagamento --}}
                              <div class="order_card_row">
                                <h6><i class="fas fa-euro-sign"></i>Pagamento:
                                  {{ $restaurantOrder->totalPrice }} €
                                </h6>
                              </div>

                              {{-- indirizzo copnsegna --}}
                              <div class="order_card_row">
                                <h6><i class="fas fa-map-marker-alt"></i>Da consegnare in: Via
                                  {{ $restaurantOrder->via }}
                                  {{ $restaurantOrder->n_civico }},
                                  {{ $restaurantOrder->citta }},
                                  {{ $restaurantOrder->cap }}
                                </h6>
                              </div>

                              {{-- note --}}
                              @if ($restaurantOrder->note)
                                <div class="order_card_row">
                                  <p><i class="fas fa-sticky-note"></i>Note:
                                    "{{ $restaurantOrder->note }}"</p>
                                </div>
                              @endif
                            </div>
                          </li>
                        @endif

                      @endforeach

                    </ul>
                  </div>
                </div>
                {{-- fine ordini in rifiutati --}}
              </li>

              {{-- contenitore ordini evasi --}}
              <li>
                <div class="processed_orders_container">

                  <div class="status_title flex space_bet align_cen">
                    <h4>Ordini Evasi</h4>
                    <div class="open_close flex align_cen">
                      <i class="fas fa-chevron-circle-up" :hidden="hiddenOrdersPagati" @click="showOrdersPagati"
                        title="Riduci ordini"></i>
                      <i class="fas fa-chevron-circle-down" :hidden="hiddenChevronPagati" @click="showOrdersPagati"
                        title="Espandi ordini"></i>
                    </div>
                  </div>

                  <div class="processed_orders" :hidden="hiddenOrdersPagati">

                    <ul class="flex_wrap space_bet">

                      @foreach ($orderSel as $restaurantOrder)

                        @if ($restaurantOrder->status == 'evaso')

                          <li>

                            {{-- accepted_order_card --}}
                            <div class="processed order_card flex_col align_start">

                              {{-- data --}}
                              <div class="order_card_row">
                                <h6><i class="fas fa-calendar-day"></i>Ordine del:
                                  {{ $restaurantOrder->created_at }}
                                </h6>
                              </div>

                              {{-- stato --}}
                              <div class="order_card_row pagato">
                                <h6><i class="fas fa-check-square"></i>Stato Ordine:
                                  {{ $restaurantOrder->status }}
                                </h6>
                              </div>

                              {{-- cliente --}}
                              <div class="order_card_row">
                                <h6><i class="fas fa-user-alt"></i>Cliente:
                                  {{ $restaurantOrder->nome_cliente }}
                                  {{ $restaurantOrder->cognome_cliente }} - Tel
                                  {{ $restaurantOrder->telefono }}
                                </h6>
                              </div>

                              {{-- prodotti ordinati --}}
                              <div class="order_card_row">
                                <h6><i class="fas fa-drumstick-bite"></i>Prodotti ordinati:

                                  @php
                                    
                                    $orderedDishes = [];
                                    $orderedDishesID = [];
                                    
                                    foreach ($restaurantOrder->dishes as $dish) {
                                        if (!in_array($dish->id, $orderedDishesID)) {
                                            $dish->counter = 1;
                                    
                                            array_push($orderedDishesID, $dish->id);
                                            array_push($orderedDishes, $dish);
                                        } else {
                                            foreach ($orderedDishes as $singleDish) {
                                                if ($singleDish->id == $dish->id) {
                                                    $singleDish->counter++;
                                                }
                                            }
                                        }
                                    }
                                    
                                    // dd($orderedDishes);
                                    
                                  @endphp

                                  @foreach ($orderedDishes as $dish)
                                    @if ($loop->last)
                                      @if ($dish->counter == 1)
                                        {{ $dish->nome }}
                                      @else
                                        {{ $dish->nome . ' x' . $dish->counter }}
                                      @endif


                                    @else
                                      @if ($dish->counter == 1)
                                        {{ $dish->nome . ', ' }}
                                      @else
                                        {{ $dish->nome . ' x' . $dish->counter . ', ' }}
                                      @endif

                                    @endif

                                  @endforeach
                                </h6>
                              </div>

                              {{-- pagamento --}}
                              <div class="order_card_row">
                                <h6><i class="fas fa-euro-sign"></i>Pagamento:
                                  {{ $restaurantOrder->totalPrice }} €
                                </h6>
                              </div>

                              {{-- indirizzo copnsegna --}}
                              <div class="order_card_row">
                                <h6><i class="fas fa-map-marker-alt"></i>Consegnato in:
                                  {{ $restaurantOrder->via }}
                                  {{ $restaurantOrder->n_civico }},
                                  {{ $restaurantOrder->citta }},
                                  {{ $restaurantOrder->cap }}
                                </h6>
                              </div>

                              {{-- note --}}
                              @if ($restaurantOrder->note)
                                <div class="order_card_row">
                                  <p><i class="fas fa-sticky-note"></i>Note:
                                    "{{ $restaurantOrder->note }}"</p>
                                </div>
                              @endif
                              <a class="flex_center" href="{{ route('revertStatus', $restaurantOrder->id) }}">
                                <i class="fas fa-check-circle"></i>
                                Riporta status "in elaborazione"
                              </a>
                            </div>
                          </li>
                        @endif

                      @endforeach
                    </ul>
                    {{-- fine processed_orders --}}
                  </div>
                </div>
                {{-- fine ordini evasi --}}
              </li>
            </ul>
            {{-- fine orders_container --}}
          </div>
          {{-- fine mycontainer --}}
        </div>
        {{-- fine #showOrders --}}
      </div>
      {{-- fine #app --}}
    </div>
  </main>


@endsection
