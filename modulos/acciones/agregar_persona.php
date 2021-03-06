<?php
include '../../inc/inc.php';
logeado();

$error = "";
$class = "warning";

if(isset($_POST['agregar'])){
  $nombre = $_POST["apeynom"];
  $cuil1 = $_POST["cuil"];
  $edad = $_POST["edad"];
  $localidad = $_POST["localidad"];
  $cuil = str_replace('-','',trim($cuil1));

//Busco un usuario repetido
  $sql1 = ("SELECT COUNT(*) FROM personas WHERE persona_ape_nom = :nombre AND persona_cuil = :cuil
            AND persona_edad = :edad AND persona_localidad = :localidad");
  $smt1 = $conexion->prepare($sql1);
  $smt1->execute(array(":nombre" => $nombre,
                       ":cuil" => $cuil,
                       ":edad" => $edad,
                       ":localidad" => $localidad));

  if(empty($nombre) || is_numeric($nombre)){
    $error = "Ingrese un nombre válido";
  } else if(strlen($cuil) !== 11 || !is_numeric($cuil) || !validar_cuil($cuil)){
    $error = "CUIL no válido";
  } else if(empty($edad) || !is_numeric($edad)){
    $error = "Ingrese una edad válida";
  } else if(empty($localidad)){
    $error = "Ingrese una localidad";
  } else {
      if ($smt1->fetchColumn() > 0){
          $error = "Los datos ya están registrados";
      } else {
          $sql2 = "INSERT INTO personas(persona_ape_nom, persona_cuil, persona_edad, persona_localidad)
                   VALUES (:nombre,:cuil,:edad,:localidad)";
          $smt2 = $conexion->prepare($sql2);
          $smt2->execute(array(":nombre" => $nombre,
                               ":cuil" => $cuil,
                               ":edad" => $edad,
                               ":localidad" => $localidad));

          if ($smt2->rowCount() == 1){
              $error = "La persona fue agregada sin problemas";
              $class = "success";
          } else {
              $error = "Error. Algo salió mal :(";
          }
      }
  }
}
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Agregar Persona
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="dark-edition">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="../../assets/img/sidebar-2.jpg">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
      -->
    <?php include "../../inc/menu2.php" ?>
    </div>
          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:void(0)">Agregar Persona</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                  <i class="material-icons">notifications</i>
                  <p class="d-lg-none d-md-block">
                    Notifications
                  </p>
                </a>
              </li>
              <!-- your navbar here -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          <br><br><br>

          <?php if($error !== ""){ ?>
          <div class="alert alert-<?php echo $class; ?>" style="width: 20rem;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <?php echo $error; ?>
          </div>
          <?php } ?>
          <!-- alerta JS-->
          <div id="alert"></div>
          <!-- alerta JS-->
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Agregar Persona</h4>
              <p class="card-category">Completa los siguientes datos</p>
            </div>
            <div class="card-body">
              <form method="POST" onsubmit="return validarPersona();">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Apellido y Nombre</label>
                      <input type="text" id="apeynom" name="apeynom" class="form-control" onKeypress="return validateLetters(event)">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Cuil</label>
                      <input type="text" id="cuil" name="cuil" class="form-control" onKeypress="return validateNumbers(event)">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Edad</label>
                      <input type="text" id="edad" name="edad" class="form-control" onKeypress="return validateNumbers(event)">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Localidad</label>
                      <input type="text" id="localidad" name="localidad" onKeypress="return validateLetters(event)" class="form-control">
                    </div>
                  </div>
                </div>
                <button type="submit" name="agregar" class="btn btn-primary pull-right">Agregar</button>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
          <div class="fixed-plugin">
            <div class="dropdown show-dropdown">
              <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
              </a>
              <ul class="dropdown-menu">
                <li class="header-title"> Filtros de barra</li>
                <li class="adjustments-line">
                  <a href="javascript:void(0)" class="switch-trigger active-color">
                    <div class="badge-colors ml-auto mr-auto">
                      <span class="badge filter badge-purple active" data-color="purple"></span>
                      <span class="badge filter badge-azure" data-color="azure"></span>
                      <span class="badge filter badge-green" data-color="green"></span>
                      <span class="badge filter badge-warning" data-color="orange"></span>
                      <span class="badge filter badge-danger" data-color="danger"></span>
                    </div>
                    <div class="clearfix"></div>
                  </a>
                </li>
                <li class="header-title">Images</li>
                <li>
                  <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../../assets/img/sidebar-1.jpg" alt="">
                  </a>
                </li>
                <li class="active">
                  <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../../assets/img/sidebar-2.jpg" alt="">
                  </a>
                </li>
                <li>
                  <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../../assets/img/sidebar-3.jpg" alt="">
                  </a>
                </li>
                <li>
                  <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="../../assets/img/sidebar-4.jpg" alt="">
                  </a>
                </li>
                <li class="button-container">
                  <a href="https://www.creative-tim.com/product/material-dashboard-dark" target="_blank" class="btn btn-primary btn-block">Free Download</a>
                </li>
                <!-- <li class="header-title">Want more components?</li>
                    <li class="button-container">
                        <a href="https://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-warning btn-block">
                          Get the pro version
                        </a>
                    </li> -->
                <li class="button-container">
                  <a href="https://demos.creative-tim.com/material-dashboard-dark/docs/2.0/getting-started/introduction.html" target="_blank" class="btn btn-default btn-block">
                    View Documentation
                  </a>
                </li>
                <li class="button-container github-star">
                  <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard/tree/dark-edition" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
                </li>
                <li class="header-title">Thank you for 95 shares!</li>
                <li class="button-container text-center">
                  <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>
                  <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button>
                  <br>
                  <br>
                </li>
              </ul>
            </div>
          </div>
          <!-- your footer here -->
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../../assets/js/core/jquery.min.js"></script>
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="../../assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/material-dashboard.js?v=2.1.0"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="../../assets/demo/demo.js"></script>
  <script src="./../../assets/js/main.js"></script>

  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>