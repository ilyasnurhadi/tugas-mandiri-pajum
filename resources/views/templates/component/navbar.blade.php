<div class="movies_nav">
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="navbar-header navbar-right">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
        <nav>
          <ul class="nav navbar-nav">
            <li class="w3_home_act {{ Route::current()->getName() == 'home' ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
            
            {{-- Menu Genres --}}
            <li class="dropdown {{ Route::current()->getName() == 'genre' ? 'active' : '' }}">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Genres <b class="caret"></b></a>
              <ul class="dropdown-menu multi-column columns-3">
                <li>
                  <div class="col-sm-4">
                    <ul class="multi-column-dropdown">
                      @if(isset($genres))
                        @for ($genre = 1; $genre <= $genres->count() - 1; $genre++)
                          <li><a href="{{ route('genre', $genres[$genre]->id) }}">{{ $genres[$genre]->name }}</a></li>
                          @if($genre % 7 == 0)
                            </ul>
                          </div>
                          <div class="col-sm-4">
                            <ul class="multi-column-dropdown">
                          @endif
                        @endfor
                      @endif
                    </ul>
                  </div>
                  <div class="clearfix"></div>
                </li>
              </ul>
            </li>

            <li class="w3_home_act {{ Route::current()->getName() == 'movies' ? 'active' : '' }}"><a href="{{ route('movies') }}">Movies</a></li>

            {{-- Menu Khusus Admin (Tampilan disamakan persis dengan menu lain) --}}
            @can('admin')
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Panel <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('dashboard.admin') }}">Dashboard Admin</a></li>
                  <li><a href="{{ route('film.index') }}">Kelola Film</a></li>
                  <li><a href="{{ route('genre.index') }}">Kelola Genre</a></li>
                  <li><a href="{{ route('cast.index') }}">Kelola Cast</a></li>
                  <li><a href="{{ route('peran.index') }}">Kelola Peran</a></li>
                  <li><a href="{{ route('users.index') }}">List Data User</a></li>
                </ul>
              </li>
            @endcan

            {{-- Menu Khusus User Biasa --}}
            @can('user')
              <li class="{{ Route::current()->getName() == 'dashboard.user' ? 'active' : '' }}"><a href="{{ route('dashboard.user') }}">Dashboard User</a></li>
              <li class="{{ Route::current()->getName() == 'profile.edit' ? 'active' : '' }}"><a href="{{ route('profile.edit') }}">Profile Saya</a></li>
            @endcan

          </ul>
        </nav>
      </div>
    </nav>  
  </div>
</div>