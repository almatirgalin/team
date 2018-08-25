<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>team.bitrix24.ru</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">

</head>
<body style="background: #545d6b url({{ asset('img/grey.svg') }}) 0 0 repeat;">
<div id="app">
    <div class="mdl-layout">
        <header class="mdl-layout__header mdl-layout__header--transparent">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span class="mdl-layout-title">Sozdavatel <span class="b24-title">24</span></span>
                </a>

                <!-- Add spacer, to align navigation to the right -->
                <div class="mdl-layout-spacer"></div>
                <!-- Navigation -->
                <nav class="mdl-navigation">
                    <a href="/deals" class="mdl-navigation__link
@if (\Illuminate\Support\Facades\Request::is('deals')) active @endif">Сделки</a>
                    <a href="/leads" class="mdl-navigation__link
@if (\Illuminate\Support\Facades\Request::is('leads')) active @endif">Лиды</a>
                    <a href="/contacts" class="mdl-navigation__link
@if (\Illuminate\Support\Facades\Request::is('contacts')) active @endif">Контакты</a>
                    <a href="/companies" class="mdl-navigation__link
@if (\Illuminate\Support\Facades\Request::is('companies')) active @endif">Компании</a>
                    <a href="/workers" class="mdl-navigation__link
@if (\Illuminate\Support\Facades\Request::is('workers')) active @endif">Сотрудники</a>
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        {{--@guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Логин') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest--}}
                    </ul>
                </nav>
            </div>
        </header>
    </div>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
