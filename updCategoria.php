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
          <h3 class="text-center fSubtitulo text-white">Modificar Categoria</h3>
          <hr />

          <!-- Form REGISTER -->
          <?php
           $id = $_GET['id'];

                            $sql = "SELECT * FROM view_Categoria  WHERE CATEGORIES_ID = '$id' ";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $count = $stmt->rowCount();
          
                              if($count > 0){
                                  $registros = $stmt->fetchAll();
                              }
          
                              foreach($registros AS $r):
                          
          ?>

               
            <form class="form" action="updCategoria_inc.php? id=<?= $r['CATEGORIES_ID']?>" method="POST">
              <div class="mb-3">
                <input type="text" class="form-control" name = "categoria" value="<?= $r['CATEGORY']; ?>" />
              </div>
              <div class="mb-3">
                <input type="text" class="form-control" name = "color" value="<?= $r['COLOR']; ?>" />
              </div>
              <div class="mb-3">
                <input type="text" class="form-control" name = "hexa" value="<?= $r['HEXA']; ?>" />
              </div>

              <div class="text-white">Creado por:</div>
              <div class="mb-3">
              <input type="text" class="form-control bg-dark text-white" name="firma" value = "<?= $r['CREATED_BY']; ?>" id ="idfirma" readonly> 
              </div>
                <?php endforeach;?>
                <div class="d-flex justify-content-end">
                <button type="submit" name = "submit" class="btn btn-danger">Guardar</button>
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