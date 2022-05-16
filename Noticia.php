<?php
    // HEADER
    include_once("header.php");
    $cat = $_GET['cat'];
    $id = $_GET['id'];
    $key = $_GET['key'];

?>

    <!--Contenido-->
    <?php 
                                                        $id = $_GET['id'];
                                                        $sql = "SELECT  N.NEWS_ID, N.PORTADA, N.TITLE,  N.`DESCRIPTION`, N.`TEXT`, N.DATE_OF_EVENTS, N.CITY, N.SUBURB, N.COUNTRY, N.KEY_WORDS, N.CREATED_BY, N.SIGN, N.DATE_OF_NEWS,
                                                        CAT.CATEGORY FROM NEWS AS N
                                                        INNER JOIN CATEGORIES AS CAT ON N.CATEGORIES_ID = CAT.CATEGORIES_ID
                                                        WHERE N.NEWS_ID = $id";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->execute(); 
                                                        $count = $stmt->rowCount();

                                                        if($count > 0){
                                                            $registros = $stmt->fetchAll();
                                                        }foreach($registros AS $r):
    ?>

    <div class="container">
        <div class="titulazo">
            <h1 class="fTitulos text-white display-1"><?= $r['TITLE'] ?></h1>
            <hr class="text-white">
            <div class ="text-center">
                <h5 class="fSubtitulo text-white">
                <?= $r['DESCRIPTION'] ?>
                </h5>
            </div>
        </div>

        <div class="cuerponoticia">

            <div class = "row">
                <div class="text-center">
                    <img src=" <?= $r['PORTADA'] ?>"  width="1000px" height="1000px">
                </div>

            </div><br>
            <div class="row">
                <div class ="col-7">
                    <p class="fNormal text-white detallitos"><?= $r['COUNTRY'] ?>, <?= $r['CITY'] ?>, <?= $r['SUBURB'] ?></p>
                </div>
                <div class="col-4 d-flex justify-content-end ">
                            <p class="fNormal text-white detallitos text-muted">Fecha: <?= $r['DATE_OF_EVENTS'] ?></p>
                </div>
            </div>
            <div>
                    <p id="textonoticia" class="text-white fNormal mt-3">
                    <?= $r['TEXT'] ?>
                    </p>
            </div>
        </div>
        <p class="fNormal text-white detallitos"><?= $r['CATEGORY'] ?></p>
        <p class="fNormal text-white detallitos"><?= $r['KEY_WORDS'] ?></p>
        <p class="fNormal text-white detallitos"> <small class="text-muted"> Nota realizada por: <?= $r['SIGN'] ?> </small></p>
        <p class="fNormal text-white detallitos"> <small class="text-muted"><?= $r['DATE_OF_NEWS'] ?> </small></p><?php endforeach;?>

        <div class="text-center text-white"><h3>MULTIMEDIA:</h3></div>


        <?php
                                                    
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
        
                            <input type="hidden"  name ="id" value ="<?=$r['NEWS_ID'] ?> " >
                            
                            <div class ="text-center">
                                <img src="<?= $r['IMAGEN'] ?>"  width= "300px" heigh ="300">
                            </div>  <br>                        
            
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
            <div class="text-center">
                <div class="">
                    <input type="hidden"  name ="id" value ="<?=$r['NEWS_ID'] ?>">
                </div>
                                <video  name = "vid" width= "600px" heigh ="400" controls>
                                        <source src="<?= $r['VIDEO'] ?>"  type ="video/mp4"> </source>
                                    </video><br>
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


    <div class="fb-share-button" data-href="https://www.google.com.mx/" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.google.com.mx%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartir</a></div>
    
        <hr class="text-white">
        <div class="footernoticia mt-3">
            <div class="col-5" id="minimalikes">
                <table class="table table-sm table-borderless fNormal text-white">
                    <thead>
                        <tr>
                            <td scope="col">
                                <div>
                                <?php 
                                $sql = "SELECT NEWS_ID FROM NEWS WHERE NEWS_ID = '$id' ";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $count = $stmt->rowCount();

                                if($count > 0){
                                    $registros = $stmt->fetchAll();
                                }

                                foreach($registros AS $r):
                                ?>

                                <form action="like_inc.php?id=<?php echo $id ?>&cat=<?php echo $cat?>&key=<?php echo $key?>&n=si" method="POST">
              
                                    <input type="hidden" name = "id_new" value="<?= $r['NEWS_ID']?>">
                                    
                                    <button class="btn btn-danger" type ="submit">
                                        <i class="fa-solid fa-thumbs-up"></i>
                                    </button>
                             
                                </form>
                                <?php endforeach; ?>
                                </div>
                            </td>

                            <td scope="col">                   
                            <?php
                            $query = "SELECT LIKES FROM NEWS WHERE NEWS_ID = '$id' ";
                            $consulta = $conn->prepare($query);
                            $consulta->execute(); 
                            $count = $stmt->rowCount();

                            if($count > 0){
                                $registros = $consulta->fetchAll();
                            }

                            foreach($registros AS $r):
                            ?>

                            <p>A <?= $r['LIKES']?>  personas le gusta</p>
                            </td> <?php endforeach; ?>
                        </tr>
                    </thead>
                </table>
            </div>
            <hr class="text-white">
            <h4 class="fSubtitulo text-white">Comentarios</h4>
            <div class="coment">

                <?php 
                
                $sql ="SELECT C.`TEXT`, C.`CREATION_DATE`,C.COMMENT_ID, U.NICK_NAME, U.IMG 
                FROM NEWS_COMMENTS AS C 
                INNER JOIN USERS AS U 
                ON C.CREATED_BY = U.EMAIL
                WHERE NEWS_ID ='$id' ";
                $consulta = $conn->prepare($sql);
                $consulta->execute(); 
                $count = $consulta->rowCount();

                if($count > 0){
                    $registros = $consulta->fetchAll(); 
                         
                foreach($registros AS $r): ?>
                <div>
                <input type="text" name ="master"value="<?= $r['COMMENT_ID']?>">
                <table class="table text-white fNormal">
                    <tbody>
                        <tr>
                                <?php 
                                    if(isset($_SESSION['ROL']) > 1){
                                ?>
                            <td>
                                <form action="eliminarComentario.php?comm=<?= $r['COMMENT_ID']?>">

                                <div class="d-flex justify-content-end">
                                    <button type="submit" name = "submit" class="btn btn-danger">X</button>
                                </div>
                                </form>

                            </td>
                                    <?php } ?>
                            <td rowspan="2" class="ppComent">
                                <img src="<?= $r['IMG']?> " alt="pp" width="70px" height="70px"
                                    class="rounded-circle">
                            </td>
                            <td><h3></h3><?= $r['NICK_NAME']?> </h3></td>
                        </tr>
                        <tr>
                            <td>
                            <p><?= $r['TEXT']?>. - <?= $r['CREATION_DATE']?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                
                <div class = "row">
                <div class ="col-6"></div>
                    <div class ="col-6">
                        <form action ="comentario_inc.php?id=<?php echo $id ?>&cat=<?php echo $cat?>&key=<?php echo $key?>&comm=<?= $r['COMMENT_ID']?>" method="POST">
                            <div class="form-floating mt-4 fNormal">
                                <textarea class="form-control bg-dark text-white" name="comentario"
                                    id="floatingTextarea2" style="height: 75px"></textarea>
                                <label for="floatingTextarea2" class="text-white">Responder comentario...</label>

                                <div class="text-end"><br>
                                <button type="submit" name="submit2" class="btn btn-danger">Responder</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                <?php endforeach; }else if($count > 1){ ?>
                    <table class="table text-white fNormal">
                    <tbody>
                        <tr>
                            <td rowspan="2" class="ppComent">
                            </td>
                            <td>...</td>
                        </tr>
                        <tr>
                            <td>
                            <p>...</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php  } ?>

                <?php 
                  if(isset($_SESSION["email"])){
                      $stmt = $conn->prepare($sql);
                      $stmt->execute();
                ?>
            <hr class ="text-white">
                    <form action ="comentario_inc.php?id=<?php echo $id ?>&cat=<?php echo $cat?>&key=<?php echo $key?>" method="POST">

                    <div class="form-floating mt-4 fNormal">
                        <textarea class="form-control bg-dark text-white" name="comentario"
                            id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2" class="text-white">Escribe un comentario</label>

                        <div class="text-end"><br>
                        <button type="submit" name="submit" class="btn btn-danger">Comentar</button>
                        </div>
                    </div>
                    </form>


                <?php }else{ 
                    
                ?>
                <form>
                <div class="form-floating mt-4 fNormal">
                    <textarea class="form-control bg-dark text-white" name="comentario"
                        id="floatingTextarea2" style="height: 100px" disabled></textarea>
                    <label for="floatingTextarea2" class="text-white">Crea una cuenta para dejar un comentario</label>
                </div>
                </form>

                <?php 
                    }   
                  ?>

            </div>
            </div>
        </div>
        <hr class="text-white">

        <div class="container">


        <h4 class="fSubtitulo text-white">Noticias relacionadas</h4>
        <?php                                     
                                                        $status = "PUBLICADA";
                                                        $sql = "SELECT N.PORTADA, N.TITLE, N.DESCRIPTION, N.DATE_OF_NEWS, N.NEWS_ID,N.SIGN, N.KEY_WORDS,
                                                        C.HEXA, C.CATEGORIES_ID
                                                        FROM NEWS  AS N 
                                                        INNER JOIN CATEGORIES AS C ON N.CATEGORIES_ID =  C.CATEGORIES_ID 
                                                        WHERE (N.CATEGORIES_ID = '$cat' AND N.NEWS_ID != '$id' AND N.`STATUS` = '$status') OR (N.KEY_WORDS = '$key' AND N.NEWS_ID != '$id' AND N.`STATUS` = '$status')";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->execute(); 
                                                        $count = $stmt->rowCount();

                                                        if($count > 0){
                                                            $registros = $stmt->fetchAll();
                                                       foreach($registros AS $r):
    ?>

    <div class ="container">
        <div class="col-8">
 <table border="1" cellpadding="15" cellspacing="10" width="100%" bgcolor="#545657">

<tr>
        <td>
            <div class="fTitulos text-center">
                <h1 >
                    <?= $r['TITLE'] ?>
                </h1>
            </div>
            <div class="px-3 py-3">
            <a href="Noticia.php?id=<?= $r['NEWS_ID'] ?>&cat=<?= $r['CATEGORIES_ID']?>&key=<?= $r['KEY_WORDS']?>">
                    <img src="<?= $r['PORTADA'] ?>" height="200px" width="200px">
                </a>
            </div>
            <div>
            <p class="card-text fNormal"> <small class=""> Firma:
                    <?= $r['SIGN'] ?>
                </small></p>
            </div>
        </td>


        <td><br><br><br><br><br>
        <div>
            <h4 class="fSubtitulo">
                <?= $r['DESCRIPTION'] ?>
                <hr>
            </h4>
            </div>
            <div>
            <p class="card-text"><small class="">
                    <?= $r['DATE_OF_NEWS'] ?>
                </small></p>
                </div>
        </td>

    </tr>
</table> <br><br>
<hr class="bg-light"> <br>
<?php endforeach; }else if($count < 1) { ?>

<div class="container">
    <div class="row">
        <div class="card col-12 bg-secondary text-white mb-5">
            <div class="py-2">
                <div class="card bg-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title fTitulos">
                            No hay notiicas relacionadas :C
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php }?>


</div>

</div>
</div>
</div>
</div>
<?php
    // FOOTER
    include_once("footer.php");
?>