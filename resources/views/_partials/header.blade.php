<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    <img src="{{ asset('images/logo.png') }}" alt="Logo">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav  mr-auto">
      <li class="nav-item active">
      <a class="nav-link" href="{{ route('movies.filtered',$platform ? $platform : 'netflix') }}">Liste filtrée<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('movies.all',$platform ? $platform : 'netflix') }}">Liste intégrale</a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="#">Thriller</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Films d'actions</a>
      </li> --}}
    </ul>
    {{-- <form class="form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Rechercher">
      <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Lancer</button>
    </form> --}}
  </div>
</nav> 
