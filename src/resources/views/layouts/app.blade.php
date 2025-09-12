<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fashionably Late</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities"> </div>
      <div class="header-utilities">
        <span class="header__logo">
          Fashionably Late
        </span>
      </div>
      <div class="header-utilities">
        <nav>
          <ul class="header-nav">
            @if (Auth::check())
            <li class="header-nav__item">
              <form class="form" action="/logout" method="post">
                @csrf
                <button class="header-nav__button">logout</button>
              </form>
            </li>
            @else
            <li class="header-nav__item">
              <a class="header-nav__link" href="/register">register</a>
            </li>
            @endif
          </ul>
        </nav>
      </div>
      <hr>
    </div>
  </header>

  <main>
    @yield('content')
  </main>

  @livewireScripts
</body>

</html>