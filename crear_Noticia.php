<?php
// HEADER
include_once("header.php");
?>

<div class="container row fTitulos">
    <h3 class="fSubtitulo text-white col-md-4 offset-md-3 pt-4 ">Crear una noticia</h3>
    <hr class="bg-light col-md-12 offset-md-3">
</div>

<div class="container bg-secondary rounded fSubtitulo">
    <hr class="bg-dark">
    <form class="form" action="crearNoticia_inc.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ">
                    <div class="row">
                        <div class="col-6">
                            <div class="md-3 mt-2">
                                <label for="exampleFormControlInput1" class="form-label">Titulo</label>
                                <input type="text" class="form-control bg-dark text-white" name="titulo" id="idtitulo"
                                    placeholder="Titulo">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 mt-2">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                        <input class="form-control bg-dark text-white" rows="2" name="descripcion" id="iddescripcion"
                            placeholder="Descripcion"></textarea>
                    </div>
                    <div class="mb-3 mt-2">
                        <label for="exampleFormControlTextarea1" class="form-label">Noticia</label>
                        <textarea class="form-control bg-dark text-white" rows="3" name="texto" id="idnoticia"
                            placeholder="Contexto..."></textarea>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card col-mb-3 card text-white bg-dark rounded mt-4 align-items-center"
                        style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">Portada</h5><br><br><br><br><br><br><br>
                        </div>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="image" name="portada" multiple>
                        </div><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-2">
                        <label for="exampleFormControlInput1" class="form-label">Palabra clave:</label>
                        <input type="text" class="form-control bg-dark text-white" name="key">
                    </div>



                    <div class="col-3">
                        <label for="" class="fTitulos"> Categorias:</label>
                        <select class="dropdown btn btn-dark dropdown-toggle fTitulos" name="categoria" id="opciones">

                                <?php
                                            $sql = "SELECT * FROM CATEGORIES";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute(); 
                                                    $registros = $stmt->fetchAll();
                                                    
                                                foreach($registros AS $r):
                                            ?>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
                        <div class="fNormal">
                            <li>
                                <option class="dropdown-item text-white" value="<?= $r['CATEGORIES_ID']?>">
                                    <?= $r['CATEGORY'] ?>
                                </option>
                            </li>
                        </div>
                        </ul>
                            <?php endforeach; ?>
                        </select>
                </div>
            </div>

            <hr class="bg-dark">
            <div class="row pb-4 fNormal">
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control bg-dark text-white" name="colonia" placeholder="Colonia">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control bg-dark text-white" name="ciudad" placeholder="Ciudad">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control bg-dark text-white" name="pais" placeholder="Pais">
                </div>
                <div class="col-md-3 mt-2">
                    <div class="row">
                        <div class="col-8">

                            <div>
                                <input type="date" bgcolor ="white" class="form-control bg-dark text-white" name="fecha" max="2022-08-10">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-2">
                                <label>Prioridad: </label>
                                <input type="text" class="form-control bg-dark text-white" name="imp"
                                    value="NORMAL">
                    </div>
                </div>
                <?php
               $user_check = $_SESSION['email'];
               $sql = "SELECT * FROM view_Perfil WHERE EMAIL = '$user_check'";
               $stmt = $conn->prepare($sql);
               $stmt->execute();
               $count = $stmt->rowCount();

               if($count > 0){
                   $registros = $stmt->fetchAll();
               }
               foreach($registros AS $r):
             ?>

                <div class="col-md-3 mt-2">
                    <div class="row">
                        <div class="col-8">

                            <div>
                                <label>Firma: </label>
                                <input type="text" class="form-control bg-dark text-white" name="firma"
                                    value="<?= $r['USER_FULL_NAME'] ?>" id="idfirma" readonly>
                            </div>
 
                            <div>
                                <input type="hidden" class="form-control bg-dark text-white" name="email"
                                    value="<?= $r['EMAIL'] ?>" readonly>
                            </div>

                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>

            <div class="row">
                <div class="col-8">
                    
                </div>
                <div class="col-2">
                    <div class ="d-flex justify-content-end">
                        <button type="submit2" name="submit2" class="btn btn-dark">Finalizar</button>
                    </div>
                </div>
                <div class="col-2">
                    <div class ="d-flex justify-content-end">
                        <button type="submit" name="submit" class="btn btn-dark">Guardar Noticia</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <hr class="bg-dark">
  
        <div class="container">

        <?php
                $sql = "SELECT * FROM ver_NewsID";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $count = $stmt->rowCount();

                if($count > 0){
                    $registros = $stmt->fetchAll();
                

                foreach($registros AS $r):
        ?>
        <div class="row">
            <div class="col-md-2"></div>
                <div class="col-md-4">
                    <form action="imgNoticia_inc.php"  method="post" enctype="multipart/form-data">
                        <div class="card col-mb-3 card text-white bg-dark rounded mt-4 align-items-center"
                            style="width: 20rem;">
                            <div class="card-body">
                            <input type="hidden"  name ="id" value ="<?=$r['NEWS_ID'] ?>">
                                <h5 class="card-title">Imagen</h5><br><br><br><br><br><br><br>
                            </div>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="foto" name="foto" multiple>
                            </div><br>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="submit" class="btn btn-danger">Guardar</button>
                            </div><br>
                        </div>
                    </form >
                </div>        

                <div class="col-md-4">
                    <form action="vidNoticia_inc.php"  method="post" enctype="multipart/form-data">
                        <div class="card col-mb-3 card text-white bg-dark rounded mt-4 align-items-center"
                            style="width: 20rem;">
                            <div class="card-body">
                            <input type="hidden"  name ="id" value ="<?=$r['NEWS_ID'] ?>">
                            
                                <h5 class="card-title">Video</h5><br><br><br><br><br><br><br>
                            </div>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="foto" name="foto" multiple>
                            </div><br>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="submit" class="btn btn-danger">Guardar</button>
                            </div><br>
                        </div>
                    </form >
                </div>   
                <div class="col-md-2"></div>     
                
            </div>
            <?php endforeach; }else if($count < 1){?>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <form action="imgNoticia_inc.php"  method="post" enctype="multipart/form-data">
                        <div class="card col-mb-3 card text-white bg-dark rounded mt-4 align-items-center"
                            style="width: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title">Imagen</h5><br><br><br><br><br><br><br>
                            </div>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="foto" name="foto" multiple>
                            </div><br>
                        </div>
                    </form >
                </div>        

                <div class="col-md-4">
                    <form action="vidNoticia_inc.php"  method="post" enctype="multipart/form-data">
                        <div class="card col-mb-3 card text-white bg-dark rounded mt-4 align-items-center"
                            style="width: 20rem;">
                            <div class="card-body">
                                <h5 class="card-title">Video</h5><br><br><br><br><br><br><br>
                            </div>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="foto" name="foto" multiple>
                            </div><br>
                        </div>
                    </form >
                </div>   
                <div class="col-md-2"></div>     
                
            </div>
                <?php } ?>
        </div>
    <hr class="bg-dark">
</div>

    </body>

    </html>