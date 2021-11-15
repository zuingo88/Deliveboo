@extends('layouts.main-layout')
@section('content')

    <main>
        <div id="createOrder">
            <div class="mycontainer">
                {{-- create_container --}}

                <h5>Ci siamo quasi...</h5>

                <h2>I tuoi dati</h2>

                <div class="order_container">

                    {{-- form --}}
                    <form method="POST" action="{{ route('storeOrder') }}" class="flex_col align_cen">

                        @csrf
                        @method('POST')
                        <input type="hidden" name="totalPrice" step=".01" value="{{round($totalPrice,2)}}">
                        <input type="hidden" name="carrelloIDs" value="{{$carrelloIDs}}">


                        {{-- nome --}}
                        <label for="nome_cliente">Nome</label>
                        <input id="nome_cliente" type="text" name="nome_cliente" value="{{ old('nome_cliente') }}"
                            placeholder="Insersci qui il tuo nome" required autofocus>

                        {{-- cognome --}}
                        <label for="cognome_cliente">Cognome</label>
                        <input id="cognome_cliente" type="text" name="cognome_cliente"
                            value="{{ old('cognome_cliente') }}" placeholder="Insersci qui il tuo cognome" required>

                        {{-- email --}}
                        <label for="email_cliente">Indirizzo email</label>
                        <input id="email_cliente" type="email" name="email_cliente"
                            value="{{ old('email_cliente') }}" placeholder="Insersci qui la tua email" required>

                        {{-- via --}}
                        <label for="via">Via</label>
                        <input id="via" type="text" name="via" value="{{ old('via') }}"
                            placeholder="Insersci qui l'indirizzo di consegna" required>

                        {{-- n_civico --}}
                        <label for="">Numero Civico</label>
                        <input id="n_civico" type="integer" name="n_civico" value="{{ old('n_civico') }}"
                            placeholder="Insersci qui il numero civico" required>

                        {{-- citta --}}
                        <label for="citta">Comune</label>
                        <input id="citta" type="text" name="citta" value="{{ old('citta') }}"
                            placeholder="Insersci qui il comune" required>

                        {{-- cap --}}
                        <label for="cap">C.A.P.</label>
                        <input id="cap" type="integer" name="cap" value="{{ old('cap') }}"
                            placeholder="Insersci qui il C.A.P." required>

                        {{-- telefono --}}
                        <label for="telefono">Telefono</label>
                        <input type="tel" id="telefono" name="telefono" pattern="[0-9]{10}"
                            placeholder="Insersci qui il tuo numero di telefono">

                        {{-- note --}}
                        <label for="note">Note (opzionale)</label>
                        <input id="note" type="text" name="note" value="{{ old('note') }}"
                            placeholder='Insersci qui eventuali note (es.: "citofono rotto")'>

                        {{-- submit --}}
                        <button type="submit">
                            Val al pagamento <i class="fas fa-angle-double-right"></i>
                        </button>

                        {{-- gestione errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </form>

                    {{-- fine create_container --}}
                </div>
                {{-- fine mycontainer --}}
            </div>
            {{-- fine create_dish --}}
        </div>
    </main>
@endsection
