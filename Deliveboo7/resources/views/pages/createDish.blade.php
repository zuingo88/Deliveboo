@extends('layouts.main-layout')
@section('content')

    <main>
        <div id="createDish">
            <div class="mycontainer">

                <h2>Aggiungi nuovo elemento al tuo menu</h2>

                {{-- create_container --}}
                <div class="create_container">

                    {{-- form --}}
                    <form method="POST" action="{{ route('storeDish') }}" class="flex_col align_cen">

                        @csrf
                        @method('POST')

                        {{-- nome --}}
                        <label for="nome">Nome</label>
                        <input id="nome" type="text" name="nome" value="{{ old('nome') }}"
                            placeholder="Inserisci qui il nome del nuovo elemento" required autofocus>

                        {{-- descrizione --}}
                        <label for="descrizione">Descrizione</label>
                        <input id="descrizione" type="text" name="descrizione" value="{{ old('descrizione') }}"
                            placeholder="Inserisci la descrizione" required>

                        {{-- ingredienti --}}
                        <label for="ingredienti">Ingredienti</label>
                        <input id="ingredienti" type="text" name="ingredienti" value="{{ old('ingredienti') }}"
                            placeholder="Inserisci qui gli ingredienti" required>

                        {{-- prezzo --}}
                        <label for="">Prezzo</label>
                        <input id="prezzo" step=".01" type="number" name="prezzo" value="{{ old('prezzo') }}"
                            placeholder="Inserisci qui il prezzo" required>

                        {{-- visibilità --}}
                        <label for="visibilita">Desideri che sia subito visibile nel tuo Menu?</label>
                        <select id="visibilita" name="visibilita" required>
                            <option value=1 selected>Si</option>
                            <option value=0>No</option>
                        </select>

                        {{-- submit --}}
                        <button type="submit">
                            Salva il nuovo elemento
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
