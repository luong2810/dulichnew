<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Du Lich Bui</title>
@include('layouts.metainfo')
    <link rel="shortcut icon" href="">
@include('layouts.common_styles')
@yield('styles')
@include('layouts.common_scripts')
@yield('scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body class="skin-blue">
@include('layouts.frame')
  </body>
</html>
