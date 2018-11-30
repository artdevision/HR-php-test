<header>
  <div class="container">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">
          Тест <small>Андрей Мыслин</small>
        </a>
      </div>
      <ul class="nav navbar-nav">
          <li class="{{  request()->route()->getName() == 'weather' ? 'active' : ''}}"><a href="{{ route('weather')  }}">Погодка <span class="sr-only">(current)</span></a></li>
          <li class="{{  request()->route()->getName() == 'orders' ? 'active' : ''}}"><a href="{{ route('orders')  }}">Заказы <span class="sr-only">(current)</span></a></li>
          <li class="{{  request()->route()->getName() == 'products' ? 'active' : ''}}"><a href="#">Продукты <span class="sr-only">(current)</span></a></li>
      </ul>
    </div>
  </nav>
  </div>
</header>