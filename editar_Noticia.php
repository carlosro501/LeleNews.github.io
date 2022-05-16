<?php
    // HEADER
    include_once("header.php");
?>

<div class="container row fTitulos">
    <h3 class="fSubtitulo text-white col-md-4 offset-md-3 pt-4 ">Editar noticia</h3>
    <hr class="bg-light col-md-12 offset-md-3">
</div>



<div class="container bg-secondary rounded fSubtitulo">
    <form class="form" action="editarNoticia_inc.php" method="post" enctype="multipart/form-data">
<br><br>
        <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <label for="" class="fTitulos"> Nueva Categoria: </label> <br> <br>
                            <select class="dropdown btn btn-dark dropdown-toggle fTitulos" name="categoria" id="opciones">

                                    <?php
                                                $sql = "SELECT * FROM ver_Cat_Header";
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
                        <div class="col-3">
                                                <?php
                                                    $cat = $_GET['cat'];
                                                    $sql = "SELECT * FROM ver_Cat_Header WHERE CATEGORIES_ID = $cat";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->execute(); 
                                                        $registros = $stmt->fetchAll();
                                                        
                                                    foreach($registros AS $r):
                                                ?>
                            <div><label for="" class="fTitulos"> Seleccionada anteriormente: </label></div> <br>
                            <input type="text"  class="form-control bg-dark text-white" value ="<?= $r['CATEGORY'] ?>" readonly>                          
                                <?php endforeach; ?>
                            
                        </div>
                    </div>
                    <hr class="bg-dark">
        <?php
                   $id = $_GET['id'];
                   $sql = " SELECT N.NEWS_ID,N.LEVEL, N.PORTADA, N.TITLE,  N.`DESCRIPTION`, N.`TEXT`, N.DATE_OF_EVENTS, N.CITY, N.SUBURB, N.COUNTRY, N.KEY_WORDS, C.`CATEGORY`, C.`CATEGORIES_ID` 
                   FROM CATEGORIES AS C INNER JOIN NEWS AS N ON C.CATEGORIES_ID = N.CATEGORIES_ID 
                    WHERE N.NEWS_ID =  '$id'";
                   $stmt = $conn->prepare($sql);
                   $stmt->execute();
                   $count = $stmt->rowCount();

                   if($count > 0){
                       $registros = $stmt->fetchAll();
                   }
                   foreach($registros AS $r):
                 ?>

            <div class="row">
                <div class="col-md-8 ">
                    <div class="row">
                        <div class="col-6">
                            <div class="md-3 mt-2">
                                <input type="hidden" value="<?= $r['NEWS_ID'] ?>" name ="news_id">
                                <label for="exampleFormControlInput1" class="form-label"> Titulo</label>
                                <input type="text" class="form-control bg-dark text-white" name="titulo" id="idtitulo"
                                    value="<?= $r['TITLE'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 mt-2">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                        <textarea class="form-control bg-dark text-white" rows="2" name="descripcion" id="iddescripcion"
                            ><?= $r['DESCRIPTION'] ?></textarea>
                    </div>
                    <div class="mb-3 mt-2">
                        <label for="exampleFormControlTextarea1" class="form-label">Noticia</label>
                        <textarea class="form-control bg-dark text-white" rows="3" name="texto" id="idnoticia"
                            ><?= $r['TEXT'] ?></textarea>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card col-mb-3 card text-white bg-dark rounded mt-4 align-items-center"
                        style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">Portada</h5>
                        </div>
                        <div>
                            <img src="<?= $r['PORTADA'] ?>"  name = "image" id="idimg" width= "200px"alt="..."> 
                        </div><br>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="image" name="portada" value="<?= $r['PORTADA'] ?>" multiple>
                        </div><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-2"> Palabra clave:
                        <input type="text" class="form-control bg-dark text-white" name="key" value ="<?= $r['KEY_WORDS'] ?>">
                    </div>
                </div>
            </div>

            <hr class="bg-dark">
            <div class="row pb-4 fNormal">
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control bg-dark text-white" placeholder ="colonia" name="colonia" value="<?= $r['SUBURB'] ?>">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control bg-dark text-white"  placeholder ="ciudad" name="ciudad" value="<?= $r['CITY'] ?>">
                </div>
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control bg-dark text-white" placeholder ="pais" name="pais" value="<?= $r['COUNTRY'] ?>">
                </div>
                <div class="col-md-3 mt-2">
                    <div class="row">
                        <div class="col-8">

                            <div>
                            <input type="date" bgcolor ="white" class="form-control bg-dark text-white" name="fecha" max="2022-08-10"
                                    value="<?= $r['DATE_OF_EVENTS'] ?>">
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
                <?php endforeach; ?>
                <?php
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
                                    value="<?= $r['EMAIL'] ?>" id="idfirma" readonly>
                            </div>

                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>

            <div class="row">
                <div class="col-6">

                </div>
                <div class="col-2">
                    <div class ="d-flex justify-content-end">
                        <button type="submit2" name="submit" class="btn btn-dark">Guardar Noticia</button>
                    </div>
                </div>
                <div class="col-2">
                    <div class ="d-flex justify-content-end">
                        <button type="submit2" name="submit2" class="btn btn-dark">Finalizar</button>
                    </div>
                </div>
                <div class="col-2">
                    <div class ="">
                        <button type="submit" name="submit3" class="btn btn-dark">Descartar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
        <hr class="bg-dark">
        <div class="text-center text-white"><h3>MULTIMEDIA:</h3></div>


<?php
                                            
                                            $id = $_GET['id'];
                                            $sql = "SELECT * FROM view_Imagenes
                                            WHERE NEWS_ID = '$id' ";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $count = $stmt->rowCount();

                                            if($count > 0){
                                                $registros = $stmt->fetchAll();
                                            

                                            foreach($registros AS $r):
                                        
?>

<table  cellpadding="15" cellspacing="10" width="100%" class="table-dark">

    <tr>
        <td>
        <div class="row">
            <div class="col-4"></div>
                <div class="col-4">
                    <form action="imgNoticia_inc.php"  method="post" enctype="multipart/form-data">
                        <div class="card col-mb-3 card text-white bg-dark rounded mt-4 align-items-center"
                            style="width: 20rem;">
                            <div class="card-body">
                            <input type="hidden"  name ="id_new" value ="<?=$r['NEWS_ID'] ?>">
                            <input type="hidden"  name ="id_img" value ="<?=$r['IMAGEN_ID'] ?>">
                                <h5 class="card-title">Imagen</h5>
                            </div>
                            <div>
                            <img src="<?= $r['IMAGEN'] ?>"  name = "image" id="idimg" width= "200px"alt="..."> 
                        </div><br>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="foto" name="foto" multiple>
                            </div><br>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="submit2" class="btn btn-danger">Cambiar</button>
                            </div><br>
                        </div>
                    </form >
                </div> 
            <div class="col-4"></div>    
        </div>                 
        </td>   
    </tr>
</table>  <br>  <?php endforeach;}else if($count < 1){?>  

<div class="container">
    <div class="row">
        <div class="card col-12 bg-secondary text-white mb-5">
            <div class="py-2">
                <div class="card bg-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title fTitulos">
                        No hay imagenes para esta noticia :C
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <?php }?>


<?php
                                                    
                                                    $id = $_GET['id'];
                                                    $sql = "SELECT * FROM view_Videos
                                                    WHERE NEWS_ID = '$id' ";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $count = $stmt->rowCount();

                                                    if($count > 0){
                                                        $registros = $stmt->fetchAll();
                                                    

                                                    foreach($registros AS $r):
?>

<table cellpadding="15" cellspacing="10" width="100%" class="table-dark">

<tr>
        <td>
            <div class="row">
                <div class="col-4"></div>
                    <div class="col-4">
                        <form action="vidNoticia_inc.php"  method="post" enctype="multipart/form-data">
                            <div class="card col-mb-3 card text-white bg-dark rounded mt-4 align-items-center"
                                style="width: 20rem;">
                                <div class="card-body">
                                <input type="text"  name ="id_news" value ="<?=$r['NEWS_ID'] ?>">
                                <input type="text"  name ="id_vid" value ="<?=$r['VIDEO_ID'] ?>">
                                    <h5 class="card-title">Video</h5><br><br><br><br><br><br><br>
                                </div>
                                <div>
                                <video  name = "vid" width= "200px" heigh ="200" controls>
                                            <source src="<?= $r['VIDEO'] ?>"  type ="video/mp4"> </source>
                                </video>
                                </div><br>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="foto" name="foto" multiple>
                                </div><br>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="submit2" class="btn btn-danger">Cambiar</button>
                                </div><br>
                            </div>
                        </form >
                    </div>   
                    <div class="col-4"></div>
                </div>  
            </div>
        </td>
    </tr>
</table><br><br>  <?php endforeach; }else    if($count < 1){?>   
    <div class="container">
        <div class="row">
            <div class="card col-12 bg-secondary text-white mb-5">
                <div class="py-2">
                    <div class="card bg-dark">
                        <div class="card-body text-center">
                            <h5 class="card-title fTitulos">
                            No hay videos para esta noticia :C
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><?php } ?>
    <hr class="bg-dark">
</div>

    </body>

    </html>