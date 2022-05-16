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
          <h3 class="text-center fSubtitulo text-white">Crear Categoria</h3>
          <hr />

          <!-- Form REGISTER -->

          <?php
              $email = $_SESSION["email"]
                          
          ?>
               
            <form class="form" action="addCategoria_inc.php" method="POST">
              <div class="mb-3">
                <input type="text" class="form-control" name = "categoria" placeholder="Seccion" />
              </div>
              <div class="mb-3">
                <input type="text" class="form-control" name = "color" placeholder="Color" />
              </div>
              <div class="mb-3">
                <input type="text" class="form-control" name = "hexa" placeholder="Codigo Hexadecimal" />
              </div>

              <div class="">Usuario:</div>
              <div class="mb-3">
              <input type="text" class="form-control bg-dark text-white" name="firma" value = "<?php echo $email ?>" readonly> 
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" name = "submit" class="btn btn-danger">Agregar</button>
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