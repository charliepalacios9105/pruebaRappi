<html>
    <head>
        <title>Prueba rappi - @yield('title')</title>
          {!!Html::style('css/bootstrap.min.css')!!}
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>