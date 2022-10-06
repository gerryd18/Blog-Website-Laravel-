<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">GBI JELTIM </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/information/all">Informations</a>
          </li>
          @guest
            <li class="nav-item">
              <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/register">Register</a>
            </li>
          @else

       
          <li class="nav-item">
            <a class="nav-link" href="/information">Manage Information</a>
          </li>

            @if (Auth::user()->role == 'Admin')
              <li class="nav-item">
                <a class="nav-link" href="/category">Manage Category</a>
              </li>
            @endif

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{-- ambil username dari table user kolom 'name' --}}
                {{Auth::user()->name}}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">Logout</a>

                  <form action="{{route('logout')}}" id="logoutForm" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
          @endguest
          
        </ul>
       
      </div>
    </div>
  </nav>