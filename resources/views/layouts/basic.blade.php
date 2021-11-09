<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="" type="image/x-icon" />
    <title>@yield('page-title')</title>
    <script>
    var BASE_URL = "{{ URL::to('/')}}";
    </script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
   
   
    @include('partials.basicstyle')

  </head>

  <body>
    <div class="wrapper">
      <!--Header-->
      
      <!--/Header-->

      <!--Content-->
      @yield('content')
      <!--Content-->

      <!--Footer-->
      @include('partials.footer')
      <!--/Footer-->

      
      <!--/modals-->
      @include('partials.scripts')
    </div>
    

  </body>

</html>