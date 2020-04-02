
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pagetitle')</title>
    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Base CSS -->
    {!! Html::style('/css/styles.css') !!} 
    {!! Html::style('/css/app.css') !!} 
    <!-- Supplemental CSS -->
    @yield('css')

  </head>

  <body>

      @include('partials._publicNavigation')
    
      <div class="container form-spacing-top bodybg"> 
    
          @include('partials._messages')
          
            @yield('content')
          
          @include('partials._footer') 
          
      </div>  

      @include('partials._javascript')
    @yield('scripts')
  </body>

</html>