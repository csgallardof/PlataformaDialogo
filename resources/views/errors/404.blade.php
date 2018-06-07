
<html>
  <head>
    <meta charset="utf-8" />
    <title>Error 404 | Página no encontrada</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min-front.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style-front.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style-responsive-front.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/theme/default-front.css') }}" id="theme" rel="stylesheet" />
    <link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
  </head>

  <style type="text/css">
    .acdc {
      text-align: center;
      position: relative;
      top: 10%;
      -ms-transform: translateY(10%);
      -webkit-transform: translateY(10%);
      transform: translateY(10%);
    }
  </style>
<body>

  <div class="acdc">
    
        <img src="http://moziru.com/images/cloud-clipart-sad-18.png" class="image-responsive" width="200px"> 
     
      <br>
      
        <h2 style="color:#0b3c55">

          <strong>
            <p style="font-size: 50px;">ERROR</p><br><br>
            <p style="font-size: 200px;">404</p>
            <br><br>
            <span>
              P&aacute;gina no encontrada
            </span>
          </strong>
        </h2>
        <hr>
      
      
        <a href="{{ url('/') }}" class="btn btn-primary btn-sm" style="font-size: 22px">
          <i class="fa fa-reply pull-right"></i>
          Ir al inicio
        </a>
  </div>
  <br><br><br><br><br><br><br><br><br><br>

            <!-- begin #footer -->
  <div id="footer" class="footer">

      <div class="container">
          <div class="footer-brand">
              <img src="{{ asset('imagenes/inteligencia_productiva_home_white.png') }}" class="center-block img-responsive" alt="Cinque Terre" width="400px" height="65px">
              <img src="{{ asset('imagenes/logo_mipro_white.png') }}" class="center-block img-responsive" alt="Cinque Terre" width="175px" height="62px">
          </div>
          <p class="text-white">
              Ministerio de Industrias y Productividad <br />
          </p>
          <p class="social-list">
              <a href="https://www.facebook.com/IndustriasEcuador/"><i class="fa fa-facebook fa-fw"></i></a>
              <a href="https://twitter.com/industriasec"><i class="fa fa-twitter fa-fw"></i></a>
              <a href="https://www.youtube.com/user/IndustriasEcuador"><i class="fa fa-youtube fa-fw"></i></a>
              <a href="https://www.flickr.com/photos/IndustriasEcuador"><i class="fa fa-flickr fa-fw"></i></a>
          </p>
      </div>
  </div>
    
  <script src="{{ asset('js/apps-front.js') }}"></script>
  <script src="{{ asset('js/ui-modal-notification.demo.js') }}"></script>


  <script>
      $(document).ready(function() {
          Notification.init();
      });
  </script>
</body>
</html>




