@extends('layouts.main-layout')
@section('content')

    <main>
        <div id="editDish">
            <div class="mycontainer">

                <h2>Modifica prodotto</h2>

                {{-- edit_container --}}
                <div class="edit_container">

                    {{-- form --}}
                    <form method="POST" action="{{ route('updateDish', $dish->id) }}" class="flex_col align_cen">

                        @csrf
                        @method('POST')

                        {{-- nome --}}
                        <label for="nome">Nome</label>
                        <input id="nome" type="text" name="nome" value="{{ $dish->nome }}" required>

                        {{-- descrizione --}}
                        <label for="descrizione">Descrizione</label>
                        <input id="descrizione" type="text" name="descrizione" value="{{ $dish->descrizione }}" required>

                        {{-- ingredienti --}}
                        <label for="ingredienti">Ingredienti</label>
                        <input id="ingredienti" type="text" name="ingredienti" value="{{ $dish->ingredienti }}" required>

                        {{-- prezzo --}}
                        <label for="">Prezzo</label>
                        <input id="prezzo" type="number" step=".01" name="prezzo" value="{{ $dish->prezzo }}" required>

                        {{-- visibilità --}}
                        <label for="visibilita">Desideri che sia subito visibile nel tuo Menu?</label>
                        <select id="visibilita" name="visibilita" required>

                            <option value="1" @if ($dish->visibilita) selected @endif>Si</option>

                            <option value=0 @if (!$dish->visibilita) selected @endif>No</option>
                        </select>

                        <button type="submit">
                            Salva modifiche
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
                    {{-- fine edit_container --}}
                </div>
                {{-- fine mycontainer --}}
            </div>
            {{-- fine edit_dish --}}
        </div>
    </main>
@endsection
