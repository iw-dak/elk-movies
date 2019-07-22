<footer class="page-footer font-small blue pt-4">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase"><img src="{{ asset('images/logo.png') }}" alt="Logo"></h5>
        <p>Vous préférez chercher des films en fonction du pays ou de la date de sortie ?<br>
        Nous avons ce qu'il vous faut</p>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none pb-3">

      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3 footer-countries">

        <!-- Links -->
        <h5 class="text-uppercase">Films par pays</h5>

        <ul class="list-unstyled">
          <li>
          <a href="{{ url('/country/etats-unis') }}">États Unis</a>
          </li>
          <li>
            <a href="{{ url('/country/france') }}">France</a>
          </li>
          <li>
            <a href="{{ url('/country/espagne') }}">Espagne</a>
          </li>
          <li>
            <a href="{{ url('/country/inde') }}">Inde</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->
      <!-- Grid column -->
      <div class="col-md-3 mb-md-0 mb-3 footer-countries">

        <!-- Links -->
        <h5 class="text-uppercase">Films par année de sortie</h5>

        <ul class="list-unstyled list-dates">
          <li>
          <a href="{{ url('/date/2019') }}">2019</a>
          </li>
          <li>
            <a href="{{ url('/date/2018') }}">2018</a>
          </li>
          <li>
            <a href="{{ url('/date/2017') }}">2017</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2019 DAK
  </div>
  <!-- Copyright -->

</footer>
