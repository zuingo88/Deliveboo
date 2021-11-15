@extends('layouts.main-layout')

@section('content')

    <main>
        <div id="login">
            <div class="mycontainer">

                <h2>login</h2>

                <div class="form_container">

                    {{-- form --}}
                    <form class="flex_col align_cen" method="POST" action="{{ route('postLogin') }}">
                        @csrf

                        {{-- email --}}
                        <label for="email">Email</label>

                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {{-- password --}}
                        <label for="password">Password</label>

                        <input id="password" type="password" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        {{-- remenber me --}}
                        {{-- <label for="remember">
                            Ricordami
                        </label>
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> --}}

                        {{-- submit --}}
                        <button type="submit">
                            Accedi
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">Password dimenticata?</a>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </main>
@endsection
