<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/css/header.css')}}">
    @if(Request::is('/'))
        <link rel="stylesheet" type="text/css" href="{{asset('/css/index.css')}}">
    @endif
    @if(Request::is('beheerder'))
        <link rel="stylesheet" type="text/css" href="{{asset('/css/beheerder.css')}}">
    @endif
    @if(Request::is('winkel'))
        <link rel="stylesheet" type="text/css" href="{{asset('/css/winkel.css')}}">
    @endif
    @if(Request::is('winkelwagen'))
        <link rel="stylesheet" type="text/css" href="{{asset('/css/winkelwagen.css')}}">
    @endif
    <title>Laravel</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img width="150" src="{{url('/storage/cover_images/pretpark_logo.png')}}" id="pretparkLogo" class="img-responsive" alt="logo pretpark">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}">Home<span class="sr-only">(current)</span></a>
                </li>
                @auth
                    @if(auth()->user()->email === 'thomkok13@hotmail.com')
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/beheerder')}}">Beheerder<span class="sr-only">(current)</span></a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/winkel')}}">Winkel<span class="sr-only">(current)</span></a>
                    </li>
                    <li>
                        <a id="winkelwagenLink" href="{{url('/winkelwagen')}}"><img id="winkelwagen" src="{{url('storage/cover_images/shopping_cart.png')}}"><span id="iconCartCount">{{$product->getProductByUserId(auth()->user()->id)}}</span></a>
                    </li>
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/login')}}">Login<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/register')}}">Registreren<span class="sr-only">(current)</span></a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/home')}}">
                            <img id="profielAfbeeldingHeader" src="/storage/cover_images/{{auth()->user()->cover_image}}" alt="{{auth()->user()->name}}">{{auth()->user()->name}}
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a style="margin-top:20px;" class="nav-link" href="{{url('/logout')}}">Uitloggen<span class="sr-only">(current)</span></a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <br>
    @include('inc/message')
    <br>
