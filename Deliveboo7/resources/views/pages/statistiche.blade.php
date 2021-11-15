@extends('layouts.main-layout')

@section('content')

  <main>
    <input id="test" type="hidden" name="" value="{{ $user }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <div id="statistiche">

      <section id="myrestaurant">

        {{-- <h2>Ciao {{ Auth::user()->name }}</h2> --}}

        {{-- link al mio ristorante --}}
        <a href="{{ route('show', Auth::user()->id) }}">
          <h3>Torna al tuo ristorante "{{ Auth::user()->nome_attivita }}" <i class="fas fa-angle-double-right"></i></h3>
        </a>

      </section>

      <div class="mycontainer">
        <h2>Le statistiche dei tuoi ordini</h2>

        <div class="single-item">

          <div class="graph_container">

            <canvas id="myChart" style="width:100%;max-width:600px;margin:auto"></canvas>

          </div>
          <div class="graph_container">

            <canvas id="myChart2" style="width:100%;max-width:600px;margin:auto"></canvas>

          </div>
          <div class="graph_container">

            <canvas id="myChart3" style="width:100%;max-width:600px;margin:auto"></canvas>

          </div>

        </div>
      </div>
    </div>
  </main>

  <script>
    let user = document.getElementById('test').value;
    let myUsers = JSON.parse(user);
    let idOrders = [];

    console.log(myUsers);
    var xValues = ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'];
    var yValuesOrders = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var yValuesDishes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    var yValuesMonthTotal = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    let priceTotal = 0;
    console.log('Incaso mensile', yValuesMonthTotal);

    //var barColors = ["red", "green", "blue", "orange", "brown", "magenta", "yellow", "purple", "pink", "cyan", "brown",
    //     "red"
    // ];

    //estrazione del mese da created_at
    for (var i = 0; i < myUsers.length; i++) {

      let month = new Date(myUsers[i].created_at);
      let indexMonth = month.getMonth();

      for (let j = 0; j < yValuesOrders.length; j++) {

        //paragono il valore numerico del mese con l'indice dell'array yValues
        if (indexMonth == j && !idOrders.includes(myUsers[i].order_id)) {
          idOrders.push(myUsers[i].order_id)
          yValuesOrders[j]++
        };
      };

      //Piatti
      for (let x = 0; x < yValuesDishes.length; x++) {
        if (indexMonth == x) {
          yValuesDishes[x]++;
        }
      }

      //Incasso totale
      let price = myUsers[i].prezzo;
      //console.log(price);
      priceTotal += price;

      for (let z = 0; z < yValuesMonthTotal.length; z++) {

        if (indexMonth == z) {
          yValuesMonthTotal[z] = priceTotal;
        }
      }


    };
    //console.log(priceTotal);

    new Chart("myChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
            label: 'Ordini',
            backgroundColor: '#2a9d8f',
            data: yValuesOrders
          },

        ],
      },
      options: {
        legend: {
          display: true
        },
        title: {
          display: true,
          text: "Ordini Mensili"
        }
      }
    });

    //------------------------------------------------------------------
    //Statistiche piatti
    new Chart("myChart2", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [

          {
            label: 'Piatti',
            backgroundColor: '#f4a261',
            data: yValuesDishes
          },
        ],
      },
      options: {
        legend: {
          display: true
        },
        title: {
          display: true,
          text: "Piatti Mensili"
        }
      }
    });

    //-----------------------------------------------------
    //Totale
    new Chart("myChart3", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [

          {
            label: 'Incasso Mensile',
            backgroundColor: 'red',
            data: yValuesMonthTotal
          },
        ],
      },
      options: {
        legend: {
          display: true
        },
        title: {
          display: true,
          text: " Incasso Mensile"
        }
      }
    });
  </script>
@endsection
