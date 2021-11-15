@extends('layouts.main-layout')

@section('content')

    <main>
        <div id="paymentDetails">
            <div class="mycontainer">

                @if ($editableOrder->status === 'accettato')
                    <h2>Grazie {{ $editableOrder->nome_cliente }}!</h2>

                    <h5>Il pagamento di {{ $amount }} € è avvenuto con
                        successo!
                        <br>Il tuo ordine verrà elaborato immediatamente
                    </h5>
                @else
                    <h2>Ooops!</h2>

                    <h5>Sembra che qualcosa sia andato storto con il tuo pagamento...</h5>
                @endif

                <a href="{{ route('main') }}">Torna alla Home</a>

                {{-- fine mycontainer --}}
            </div>
            {{-- fine paymentDetails --}}
        </div>
    </main>


@endsection
