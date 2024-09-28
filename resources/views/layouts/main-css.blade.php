<title>@yield('title')</title>

<link rel="manifest" href="site.webmanifest">
<link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('assets/img/favicon.ico') }}">

<!-- CSS here -->
<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/slicknav.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/flaticon.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/flaticon.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/progressbar_barfiller.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/gijgo.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/animated-headline.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/fontawesome-all.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/slick.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/nice-select.css') }}">
<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
<style>
  .navigation {
    list-style: none;
    display: flex;
    align-items: center;
}

.navigation li {
    margin: 0 15px;
    position: relative;
}

.navigation li a {
    text-decoration: none;
    padding: 10px 20px;
    color: #333;
    font-weight: bold;
    display: inline-block;
}

.navigation li .submenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    z-index: 10;
    padding: 10px;
}

.navigation li:hover .submenu {
    display: block;
}

.button-header .btn {
    background-color: #ff6600;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.button-header .btn:hover {
    background-color: #ff4500;
}

.submenu button {
    background-color: transparent;
    border: none;
    color: red;
    cursor: pointer;
    font-size: 14px;
}

.submenu button:hover {
    color: darkred;
}

</style>
@livewireStyles
@yield('css')