<!DOCTYPE html>
<html>
  
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicia sesión o registrate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/css.css" />
  <link rel="stylesheet" media="(min-width: 1000px)" href="css/mediaquery.css" />
  <script src="https://kit.fontawesome.com/22d7574b7e.js" crossorigin="anonymous"></script>
  <!--Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cuprum&family=Epilogue:wght@500&family=Federo&display=swap"
    rel="stylesheet">
  <!--JS-->
  <script src="js/jquery-3.6.0.js"></script>
  <script src="js/validaciones.js"></script>
</head>

<body>

  <div class="container">
    <div class="vh-100 m-0 justify-content-between align-items-center">
      <div class="container s mt-2 text-center" id="divConTitle">
        <i class="fa-solid fa-newspaper fa-2x"></i>
        <h1 class="fTitulos">LeleNews</h1>
      </div>
      <div class="flexi">
        <div class="container s mt-2">
          <h3 class="text-center fSubtitulo">Inicia sesión</h3>
          <hr />
          <!--Form-->
          <div class="container fNormal">
            <form onsubmit="return validaSesion()" class="form" action="iniciarSesion_inc.php" method="POST"> 

              <div class="mb-3">
                <input type="email" class="form-control" name = "correo" id="idEmail" placeholder="Email" />
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" name = "contra" id="idPassword" placeholder="Contraseña" />
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" name ="submit" class="btn btn-danger"> Iniciar sesión </button>
              </div>
            </form>
          </div>
        </div>
        <div class="container s mt-2">
          <h3 class="text-center fSubtitulo">Registrate</h3>
          <hr />

          <!-- Form REGISTER -->
            <form onsubmit="return validaRegistro()" class="form" action="registrar_inc.php" method="POST" enctype="multipart/form-data">

              <div class="mb-3">
                <input type="text" class="form-control" name = "user" id="iduser" placeholder="Usuario" />
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" name = "email" id="idemail" placeholder="Correo electrónico" />
                <a href="verPerfil.php?var1=email"></a>
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" name = "pass" id="idpass" placeholder="Contraseña" />
              </div>
              <div class="mb-3">
                <input type="text" class="form-control" name="fullname" id="idfullname" placeholder="Nombre completo" />
              </div>
              <div class="mb-3">
                <input type="text" class="form-control" name="phone" id="idphone" placeholder="Telefono (opcional)" />
              </div>
              <div> 
                <label class="col-sm-4 control-label fTitulos">Imagen de perfil</label>
                  <div class="col-sm-8">
                    <input type="file" class="form-control" id="idImg" name="image" multiple>
                  </div><br>
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" name = "submit" class="btn btn-danger">Registrarse</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>

</html>