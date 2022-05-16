<?php

session_start();

include_once("db.php");

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portal web de noticias</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/css/css.css">
  <script src="https://kit.fontawesome.com/22d7574b7e.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/mq.css" media="(min-width: 1000px)">
  <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cuprum&family=Epilogue:wght@500&family=Federo&display=swap"
    rel="stylesheet">

    <script type="text/javascript" src="js/libs/jquery/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/mifacebook.js"></script>
	<script type="text/javascript">
	function shareFB() {
		var score = $("#txtScore").val();
		shareScore(score);
	}
	</script>
</head>

</head>

<body class="bg-dark"  >
  
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v13.0&appId=708409997135650&autoLogAppEvents=1" nonce="UoshNr6b"></script>


<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-danger mb-3">
  <div class="container-fluid">
      <div class ="row">
        <div class = "col-12">
          <a class="navbar-brand fTitulos" href="index.php">LeleNews</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>

    <div class="collapse navbar-collapse fNormal" id="navbarNav">
            <?php
              $sql = "SELECT * FROM ver_Cat_Header";
                          $stmt = $conn->prepare($sql);
                          $stmt->execute(); 
                          $registros = $stmt->fetchAll();
                          
                      foreach($registros AS $r):
            ?>

            <table>
              <tr>
                <td>
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" style="text-decoration:none; color:<?= $r['HEXA'] ?>"  href="secciones.php?id=<?= $r['CATEGORIES_ID']?>"> <?= $r['CATEGORY'] ?> </a>
                    </li>
                </td>
                <?php endforeach; ?>
                </ul>


              </tr>
            </table>
    </div>
        <div class="d-flex justify-content-end">
          <form action="busqueda.php" method="post">
            <div class="row">
              <div class="col-8">
                <input class="form-control me-2 text-white bg-dark" type="search" placeholder="Buscar" name ="buscar" aria-label="Search">
              </div>
              <div class="col-4">
                <input class="btn btn-dark" type="submit" name="btnenviar" value="Buscar">
              </div>
            </div>
          </form>
        </div>




          <div class="ml-auto">    <!-- Navbar links -->
            <div class ="row">
              <div class="col10">
                <ul class="navbar-nav">
                    <?php
                      if(isset($_SESSION["email"])){
                      $user_check = $_SESSION['email'];
                      $sql = "SELECT * FROM USERS WHERE EMAIL = '$user_check'";
                      $stmt = $conn->prepare($sql);
                      $stmt->execute();
                      $count = $stmt->rowCount();

                      if($count > 0){
                          $registros = $stmt->fetchAll();
                      }
                      foreach($registros AS $r):
                    ?>

                    <li class="text-light d-flex my-auto">
                    <?php
                    if($_SESSION['rol'] == 2){ ?>

                      
                      <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        EDITOR
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                          <li><a class="dropdown-item" href="Perfil.php">Ver Perfil</a></li>
                          <li><a class="dropdown-item" href="aprobar_Noticia.php">Administrar <br> noticias</a></li>
                          <li><a class="dropdown-item" href="verCategorias.php">Secciones</a></li>
                          <li><a class="dropdown-item" href="reporte_Secciones.php">Reporte</a></li>
                          <li><a class="dropdown-item" href="verUsuarios.php">Usuarios</a></li>
                          <li><a class="dropdown-item" href="verEmpleados.php">Reporteros</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="cerrar_inc.php">Salir</a></li>
                        </ul>
                      </div>

                    <?php
                    }else if ($_SESSION['rol'] == 3){ ?>


                      <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                          REPORTERO
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                          <li><a class="dropdown-item" href="Perfil.php">Ver Perfil</a></li>
                          <li><a class="dropdown-item" href="crear_Noticia.php">Crear noticia</a></li>
                          <li><a class="dropdown-item" href="aprobar_Noticia.php">Administrar <br> noticias</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="cerrar_inc.php">Salir</a></li>
                        </ul>
                      </div>
                    <?php
                    }else if ($_SESSION['rol'] == 1){
                    ?>

                      <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $r['NICK_NAME'] ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                          <li><a class="dropdown-item" href="Perfil.php">Ver Perfil</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="cerrar_inc.php">Salir</a></li>
                        </ul>

                    <?php } endforeach; } else { ?>

                    <div> <a href="Signinup.php"><i class="fa-solid fa-user-large text-white mx-3"></i> </a> </div>
                    <?php } ?>
                </ul>
                </div>
                <div class ="col2">
                
                </div>
            </div>
          </div>
  </div>
</nav>
