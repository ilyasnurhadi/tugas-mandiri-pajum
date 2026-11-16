<div class="header">
  <div class="container">
    <div class="w3layouts_logo">
      <a href="{{ route('home') }}"><h1>One<span>Movies</span></h1></a>
    </div>
    <div class="w3_search">
      <form action="{{ route('movies') }}" method="GET">
        <input type="text" name="q" placeholder="Search" value="{{ request('q') }}" required>
        <input type="submit" value="Go">
      </form>
    </div>
    <div class="w3l_sign_in_register">
      <ul>
        @guest
          <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
        @endguest

        @auth
          {{-- Khusus Admin --}}
          @if (Auth::user()->hasRole('admin'))
            <li><a href="{{ route('dashboard.admin') }}">Panel Admin</a></li>
          @endif

          {{-- Khusus User Biasa --}}
          @if (Auth::user()->hasRole('user'))
            <li><a href="{{ route('dashboard.user') }}">Profil / Dashboard</a></li>
          @endif

          <li>
            {{-- Menggunakan route('login.logout') sesuai dengan routes/web.php kamu --}}
            <form action="{{ route('login.logout') }}" method="POST" style="display:inline;">
              @csrf
              <a href="#" onclick="this.closest('form').submit(); return false;">Logout</a>
            </form>
          </li>
        @endauth
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>