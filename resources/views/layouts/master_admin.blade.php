<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
<link rel="stylesheet" href="{{ URL::asset('assets/css/nice-select.css') }}">
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
@yield('css')
    @livewireStyles
    {{-- @include('layouts.main-css') --}}
</head>
<body>
  @include('layouts.nav_admin')
  @yield('content')

@include('layouts.main-script')
  </body>
</html>