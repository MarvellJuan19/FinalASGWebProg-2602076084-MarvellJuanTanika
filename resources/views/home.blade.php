@extends('layout.main')
@section('title', 'Home Page')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>ConnectFriend</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ConnectFriend</a>
        <button aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-bs-target="#navbarNav" data-bs-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a aria-current="page" class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Friends</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Chat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Avatar</a>
                </li>
            </ul>
            <div class="d-flex">
                <div class="dropdown me-2">
                    <button aria-expanded="false" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" id="dropdownMenuButton" type="button">
                        English
                    </button>
                    <ul aria-labelledby="dropdownMenuButton" class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">English</a></li>
                        <li><a class="dropdown-item" href="#">Spanish</a></li>
                    </ul>
                </div>
                <button class="btn btn-outline-primary me-2" type="button">Login</button>
                <button class="btn btn-primary" type="button">Register</button>
            </div>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <form class="d-flex flex-row gap-2" method="GET" action="{{ route('home') }}" role="search">
        <input class="form-control me-2" type="search" name="search" placeholder="@lang('lang.search_placeholder')" value="{{ request('search') }}" aria-label="@lang('lang.search_placeholder')">
        <button class="btn btn-outline-success" type="submit">@lang('lang.search_button')</button>
        <div class="dropdown d-flex align-items-center">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                @lang('lang.filter')
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
                </svg>
            </button>
            <ul class="dropdown-menu">
                @foreach($genders as $gender)
                <li><a class="dropdown-item" href="{{ route('home', ['gender' => $gender]) }}">{{ ucfirst($gender) }}</a></li>
                @endforeach
                <li><a class="dropdown-item" href="{{ route('home') }}">@lang('lang.clear_filter')</a></li>
            </ul>
        </div>
    </form>
    <h3 class="text-center my-4">@lang('lang.find_add_friends')</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($users as $user)
        @if($user->id !== Auth::id())
        <div class="col">
            <div class="card h-100">
                <img src="{{ $user->profile_picture ?: asset('assets/default-profile.jpg') }}" class="card-img-top mx-auto" style="width: 8rem; height: 8rem;" alt="User profile picture">
                <div class="card-body">
                    <h5 class="card-title">@lang('lang.name'): {{ $user->name }}</h5>
                    <p class="card-text">@lang('lang.field_of_work'): {{ $user->field_of_work }}</p>
                    <p class="card-text">@lang('lang.gender_value') {{ $user->gender }}</p>
                </div>
                <form method="POST" action="{{ route('addFriend', $user->id) }}">
                    @csrf
                    <button type="submit" class="m-3 btn btn-primary">@lang('lang.add_friend')</button>
                </form>
            </div>
        </div>
        @endif
        @empty
        <p>@lang('lang.no_users_found')</p>
        @endforelse
    </div>
</div>
@endsection