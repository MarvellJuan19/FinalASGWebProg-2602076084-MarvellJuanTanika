<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ConnectFriend</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex align-items-center" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('home') || Request::is('/') ? 'text-decoration-underline text-primary' : '' }}" aria-current="page" href="{{ route('home') }}">@lang('lang.home')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('friends') ? 'text-decoration-underline text-primary' : '' }}" href="{{ route('friends') }}">@lang('lang.friends')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('chat') || Request::is('chatroom') || Request::is('chatroom/*') ? 'text-decoration-underline text-primary' : '' }}" href="{{ route('chat') }}">@lang('lang.chat')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('') ? 'text-decoration-underline text-primary' : '' }}" href="#">@lang('lang.avatar')</a>
                </li>
            </ul>
            <div class="d-flex flex-row gap-4"> 
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ app()->getLocale() == 'en' ? 'English' : 'Indonesia' }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('set-locale', 'en') }}">English</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('set-locale', 'id') }}">Indonesia</a>
                        </li>
                    </ul>
                </div>
                @if(Auth::check())
                    <div class="d-flex flex-row align-items-center gap-2">
                        <p class="text-center my-auto">@lang('lang.your_coins'): {{ Auth::user()->coin_balance }}</p>
                        <a href="{{ route('topupCoins')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                            </svg>
                        </a>
                    </div>
                    <a href="{{ route('notifications') }}" class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
                        </svg>
                    </a>
                    <div class="dropdown">
                        <button class="dropdown-toggle" style="border:none" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->profile_picture ?: asset('assets/default-profile.jpg') }}" alt="Profile Picture" class="rounded-circle" style="height: 40px; width: 40px;">
                        </button>
                        <ul class="dropdown-menu">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger mt-3">@lang('lang.logout')</button>
                            </form>
                        </ul>
                    </div>
                @else
                    <div class="d-flex flex-row align-items-center gap-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">@lang('lang.login')</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary">@lang('lang.register')</a>
                    </div>
                 @endif
            </div>
      </div>
    </div>
</nav>