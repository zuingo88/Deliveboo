<footer>

  <div class="mycontainer flex just_around">

    {{-- prima colonna --}}
    <div class="column">

      <div class="footer_list">

        <h3>DeliveBoo</h3>

        <ul>
          {{-- link a registrazione --}}
          <li>
            <a href="{{ route('getRegistration') }}">Registra il tuo ristorante</a>
          </li>
          {{-- eventuali link a nostri linkedin/cv/github --}}
          <li>
            <a href="{{ route('chiSiamo') }}">Chi siamo</a>
          </li>
          <li>
            <a href="{{ route('contattaci') }}"><i class="far fa-envelope">&#160;</i>Contattaci</a>
          </li>
          <li>
            <a href="{{ route('faq') }}">Faq</a>
          </li>
        </ul>
      </div>
      {{-- logo --}}

      <a href={{ route('main') }} title="Home">
        <h6>Deliveboo!</h6>
      </a>

    </div>

    {{-- seconda colonna --}}
    <div class="column">

      <div class="footer_list">

        <h3>Social</h3>

        <ul>
          <li>
            <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
          </li>
          <li>
            <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
          </li>
          <li>
            <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
          </li>
          <li>
            <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
          </li>
        </ul>
      </div>
    </div>


  </div>
</footer>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

{{-- <script type="text/javascript">
    $('.autoplay').slick( {
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3500,
    });

</script> --}}
