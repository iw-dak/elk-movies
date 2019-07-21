<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">
    <img src="{{ asset('images/logo.png') }}" alt="Logo">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav  mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('type/drame') }}">Drame</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('type/comedie') }}">Comédie</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('type/thriller') }}">Thriller</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('type/sci-fi') }}">Science fiction</a>
      </li>
      <li class="ml-5 nav-item">
        <a class="nav-link best-mark" href="{{ url('movies/top-score') }}" style="color:#A91E1E;">Top Five</a>
      </li>
    </ul>
    <form class="form-inline" action="{{ url('/') }}" method="post">
      {{ csrf_field() }}
      <input class="form-control mr-sm-2" type="search" placeholder="Rechercher par film..." aria-label="Rechercher" name="query" value="{{ request('query') }}" id="search-input">
      <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" id="btn-sumbmit">lancer</button>
      </form>
  
  </div>
</nav> 
<div class="complete hide">
  <ul class="ul-complete">
    <li>Test Test Test Test Test Test Test Test</li>
    <li>Test</li>
    <li>Test</li>
  </ul>
</div>
