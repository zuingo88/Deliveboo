@extends('layouts.main-layout')

@section('content')

    <div class="mycontainer">
        <div id="chiSiamo">
            <div class="chiSiamo_container">

                <blockquote cite="http://">
                    <h5>Un array senza i suoi iesimi elementi non è altro che un paio di parentesi vuote e prive di valore.
                    </h5> cit.
                </blockquote>
                <p>Noi siamo la <b>durezza</b> degli iesimi elementi.</p>

            </div>
        </div>

        <div id='profile' class="flex_wrap">
            <div class="profile_column">
                <div id='vale' class="img">

                </div>
                <p>
                    Nome: Valerio
                </p>
                <p>
                    Cognome: Sgura
                </p>
                <p>
                    <a href="https://www.linkedin.com/in/valerio-sgura-4552b7213/">LinkedIn</a>
                </p>
                <p>
                    <a href="https://github.com/zuingo88">GitHub</a>
                </p>
            </div>

            <div class="profile_column">
                <div id='mirko' class="img">

                </div>
                <p>
                    Nome: Mirko
                </p>
                <p>
                    Cognome: Sbaglia
                </p>
                <p>
                    <a href="https://www.linkedin.com/in/mirko-sbaglia-a61252213/">LinkedIn</a>
                </p>
                <p>
                    <a href="https://github.com/Mirko01-rgb">Github</a>
                </p>
            </div>

            <div class="profile_column">
                <div id='gabbo' class="img">

                </div>
                <p>
                    Nome: Gabriele
                </p>
                <p>
                    Cognome: Alessi
                </p>
                <p>
                    <a href="https://www.linkedin.com/in/gabriele-alessi/">Likedin</a>
                </p>
                <p>
                    <a href="https://github.com/GAlessi">Github</a>
                </p>
            </div>

            <div class="profile_column">
                <div id='nata' class="img">

                </div>
                {{-- <img src="{{ asset('/storage/chiSiamoImg/mirko.png') }}" alt=""> --}}
                <p>
                    Nome: Natale (detto Andrea)
                </p>
                <p>
                    Cognome: Capristo
                </p>
                <p>
                    <a href="https://www.linkedin.com/in/natale-capristo-a2aa38139/">LinkedIn</a>
                </p>

                <p>
                    <a href="https://github.com/Natale90">Github</a>
                </p>
            </div>
        </div>
    </div>

@endsection
