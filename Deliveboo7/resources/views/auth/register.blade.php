@extends('layouts.main-layout')

@section('content')

  <main>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div id="register">

      <div class="mycontainer">

        <h2>Registrati</h2>
        <div class="register_container">

          {{-- form --}}
          <form class="flex_col align_cen" method="POST" action="{{ route('postRegistration') }}"
            enctype="multipart/form-data">
            @csrf

            {{-- nome --}}
            <label for="name">Nome</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Inserisci qui il tuo nome" required autocomplete="name" autofocus>

            @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- cognome --}}
            <label for="cognome">Cognome</label>
            <input id="cognome" type="text" name="cognome" placeholder="Inserisci qui il tuo cognome" required>

            @error('cognome')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- email --}}
            <label for="email">Email</label>
            <input id="email" type="email" name=" email" value="{{ old('email') }}" placeholder="Inserisci qui il tuo indirizzo email" required autocomplete="email">

            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- password --}}
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Inserisci qui la tua password" required autocomplete="new-password">

            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- conferma password --}}
            <label for="password-confirm">Conferma Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" required
              autocomplete="new-password">

            {{-- nome attività --}}
            <label for="nome_attivita">Nome Attività</label>
            <input id="nome_attivita" type="text" name="nome_attivita" placeholder="Inserisci qui il nome della tua attività" required>

            @error('nome_attivita')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- via --}}
            <label for="via">Via</label>
            <input id="via" type="text" name="via" placeholder="Inserisci qui il nome della via della tua attività" required>

            @error('via')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- civico --}}
            <label for="n_civico">Numero Civico</label>
            <input id="n_civico" type="integer" name="n_civico" placeholder="Inserisci qui il civico della tua attività" required>

            @error('n_civico')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- comune --}}
            <label for="citta">Comune</label>
            <input id="citta" type="text" name="citta" placeholder="Inserisci qui il Comune della tua attività" required>

            @error('citta')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- cap --}}
            <label for="cap">C.A.P.</label>
            <input id="cap" type="text" name="cap" placeholder="Inserisci qui il C.A.P. della tua attività" required>

            @error('cap')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- p iva --}}
            <label for="p_iva">Numero Partita IVA</label>
            <input id="p_iva" type="text" name="p_iva" placeholder="Inserisci qui il numero della tua partita iva" required>

            @error('p_iva')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- checkbox tipologia --}}
            <label for="type_id[]">Seleziona una o più Tipologie di Cucina</label>
            <div class="checkbox_container">

              <ul class="flex_wrap">

                @foreach ($types as $type)
                  <li class="flex just_start align_cen">
                    <label class="control control-checkbox">
                      {{ $type->nome }}
                      <input id="types_id[]" name="types_id[]" type="checkbox" value="{{ $type->id }}" />
                      <div class="control_indicator"></div>
                    </label>
                  </li>
                @endforeach
              </ul>
            </div>

            @error('type_id')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- Aggiunta immagini --}}
            <label for="file_path">Scegli un immagine per il tuo Ristorante</label>
            <input type="file" name="file" class="file" required>

            @error('file_path')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            {{-- submit --}}
            <button type="submit">
              Registrati
            </button>

          </form>
        </div>
      </div>
    </div>
  </main>

@endsection
