<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">VeggieStore</a>
      <div>
        @auth
          <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm me-2">Admin</a>
          <form method="POST" action="{{ route('logout') }}" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="btn btn-light btn-sm me-2">Login</a>
          <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">Register</a>
        @endauth
      </div>
    </div>
  </nav>
  