<?php
    // HEADER
    include_once("header.php");
?>
   <div class="container col-4">
  <div class="container">
    <div class="vh-100 m-0 justify-content-between align-items-center">
      <div class="container s mt-2 text-center" id="divConTitle">
        <i class="fa-solid fa-newspaper fa-2x"></i>
        <h1 class="fTitulos text-white">LeleNews</h1>
      </div>
      <div class="flexi">
        <div class="container s mt-2">
          <h3 class="text-center fSubtitulo text-white">Dar de alta a empleado</h3>
          <hr />

          <!-- Form REGISTER -->

            <form class="form" onsubmit="return validaSesion()" action="registrar_ER_inc.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <input type="text" class="form-control" name = "user" id="iduser" placeholder="Usuario" />
              </div>
              <div class="mb-3">
                <input type="email" class="form-control" name = "email" id="idemail" placeholder="Correo electrónico" />
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
              <div class="mb-3">
                <input type="hidden" class="form-control" name="puesto" id="idpuesto" value="3" readonly />
              </div>
              <div> 
                <label class="col-sm-4 control-label fTitulos">Imagen de perfil</label>
                  <div class="col-sm-8">
                    <input type="file" class="form-control" id="image" name="image" multiple>
                  </div><br>
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" name = "submit" class="btn btn-danger">Registrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>
</body>

</html>