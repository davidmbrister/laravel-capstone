   <!-- Default Bootstrap navbar-->
    <nav class="navbar navbar-expand-lg navbar-fixed-top navbar-light">
      <a class="navbar-brand" href="/">A Book Store</a> <img class="logo" src="{{ Storage::url('images/'.'bookLogo.png')}}" alt="logo"/>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto ml-5">
        @if (Auth::check())
          <li class="nav-item {{ Request::is('items') ? "active" : ""}}">
            <a class="nav-link" href="/items">Items</a>
          </li>
          <li class="nav-item {{ Request::is('categories') ? "active" : ""}}">
            <a class="nav-link " href="/categories">Categories</a>
          </li>
          <li class="nav-item {{ Request::is('orders') ? "active" : ""}}">
            <a class="nav-link " href="/orders">Orders</a>
          </li>
        @endif

        <li class="nav-item {{ Request::is('store') ? "active" : ""}}">
          <a class="nav-link " href="/store">Store</a>
        </li>
        <li class="nav-item {{ Request::is('shopping_cart') ? "active" : ""}}">
          <a class="nav-link " href="/shopping_cart">Cart</a>
        </li>

        </ul>

        <li class="nav-item dropdown list-unstyled mr-4">
          @if (Auth::check())
          <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Hello, {{Auth::User()->name}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{route('items.index')}}">Items</a>
              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="{{route('categories.index')}}">Categories</a>
              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="{{route('store.index')}}">Store</a>
              <div class="dropdown-divider"></div>

             <a class="dropdown-item" onclick="
             document.getElementById('logout-form').submit();" href="#">Logout</a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
              </form>
          </div>
          @else
      <a href="{{route('login')}}" class="btn btn-outline-success">Login</a>
      @endif
        </li>
      </div>
    </nav>
