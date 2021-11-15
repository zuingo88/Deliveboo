@extends('layouts.main-layout')

@section('content')
    <main>
        <div id="braintreePay">
            <div class="mycontainer">

                <h2>Completa il tuo ordine</h2>

                <div class="payment_container">

                    {{-- form pagamento --}}
                    <form method="post" id="payment-form" action="{{ route('checkout', $order) }}">
                        @csrf

                        <label for="amount">
                            <h5 class="input-label">Importo dovuto: {{ $orderPrice }} €</h5>
                        </label>

                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>

                        {{-- submit --}}
                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <button class="button" type="submit">Ordina!</button>
                    </form>

                    {{-- fine form_container --}}
                </div>

                {{-- fine mycontainer --}}
            </div>
            {{-- fine braintreePay --}}
        </div>
    </main>

    <script src="https://js.braintreegateway.com/web/dropin/1.30.1/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin'
        }, function(createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>

@endsection
