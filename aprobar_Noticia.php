<?php
    // HEADER
    include_once("header.php");
?>
<?php 
                if($_SESSION['rol'] == 2){ ?>
<div class="container-fluid pt-5 mb-5">
    <div class="row">
                        <?php  
                                        $sql = "SELECT * FROM Status_News_Terminada";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        $count = $stmt->rowCount();
                                        $count2 = $stmt->rowCount();
                       
                                        if($count > 0){   
                                                $registros = $stmt->fetchAll();
                                        ?>
   
        <div class="col-md-4 text-white">
            <div class="row col-md-6 offset-md-4">
                <div class="card bg-secondary">
                    <div class="py-2">
                        <div class="card mb-3 bg-dark">
                            <div>
                                <h5 class="pt-1 ps-3 fTitulos">Noticias pendientes: </h5>
                            </div>
                        </div>
                        <div class="card bg-dark">
                        <?php foreach($registros AS $r): ?>
                            <table>
                                <tr>
                                    <td>
                                        <form action="aprobar_Noticia.php" method="POST">
                                            <div class="card-body">
                                                <input type="hidden" name="idnews" value="<?= $r['NEWS_ID'] ?>">
                                                <h5 class="card-title fTitulos" name="titulo">
                                                    <?= $r['TITLE'] ?>
                                                </h5>
                                                <p class="card-text fNormal" name="descripcion">
                                                    <?= $r['DESCRIPTION'] ?>
                                                </p>
                                                <p class="card-text"><small class="text-muted">
                                                        <?= $r['CREATION_DATE'] ?>
                                                    </small></p>
                                                <button type="submit" name="submit" class="btn btn-danger">Ver
                                                    noticia</button>
                                            </div>
                                        </form>
                                    </td>
                                    <?php endforeach; ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <?php

            }else if($count < 1){
        ?>

        <div class="col-md-4 text-white">
            <div class="row col-md-6 offset-md-4">
                <div class="card bg-secondary">
                    <div class="py-2">
                        <div class="card mb-3 bg-dark">
                            <div>
                                <h5 class="pt-1 ps-3 fTitulos">No hay noticias pendientes</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php }
            if(isset($_POST['idnews'])) {
                            $id = $_POST['idnews'];
                            $sql = "SELECT  N.NEWS_ID, N.PORTADA, N.TITLE,  N.`DESCRIPTION`, N.`TEXT`, N.DATE_OF_EVENTS, N.CITY, N.SUBURB, N.COUNTRY, N.KEY_WORDS, N.CREATED_BY, N.`LEVEL`,
                            CAT.CATEGORY FROM NEWS AS N
                            INNER JOIN CATEGORIES AS CAT ON N.CATEGORIES_ID = CAT.CATEGORIES_ID
                            WHERE N.NEWS_ID = $id";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $count = $stmt->rowCount();

                            if($count > 0){
                                $registros = $stmt->fetchAll();
                            }

                            foreach($registros AS $r):
                            ?>
        <div class="card col-md-4 bg-secondary text-white mb-5">
            <table>
                <tr>
                    <td>
                    <form class="form" action="noticiaRechazada_inc.php" method="post" enctype="multipart/form-data">
                        <div class="py-2">
                            <div class="card bg-dark">
                            <input type="hidden" name="idnews" value="<?= $r['NEWS_ID'] ?>">
                                <div class="px-3 py-3 text-center">
                                    <img src="<?= $r['PORTADA'] ?>" height="400px" width="400px">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fTitulos">
                                        <?= $r['TITLE'] ?>
                                    </h5>
                                    <p class="card-text fNormal">
                                        <?= $r['DESCRIPTION'] ?>
                                    </p>
                                    <p class="card-text fNormal">
                                        <?= $r['TEXT'] ?>
                                    </p>
                                    <p class="card-text"><small class="text-muted">
                                            <?= $r['DATE_OF_EVENTS'] ?>
                                        </small></p>
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    <?= $r['COUNTRY'] ?>
                                                </small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    <?= $r['CITY'] ?>
                                                </small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    <?= $r['SUBURB'] ?>
                                                </small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted"> Importancia: <br>
                                                    <?= $r['LEVEL'] ?>
                                                </small></p>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                        <p class="card-text"><small class="text-muted">
                                                            <?= $r['CATEGORY'] ?>
                                                        </small></p>
                                            </div>
                                            <div class="col-md-4">
                                                        <p class="card-text"><small class="text-muted"> Palabra clave: 
                                                            <?= $r['KEY_WORDS'] ?>
                                                        </small></p>
                                            </div>
                                            <div class="col-md-4">
                                                        <p class="card-text"><small class="text-muted">
                                                            <?= $r['CREATED_BY'] ?>
                                                        </small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label for="exampleFormControlTextarea1"
                                            class="form-label fNormal">Comentarios</label>
                                        <textarea class="form-control bg-dark text-white" rows="4"
                                            placeholder="Contexto..." name="coment"></textarea>
                                    </div>
                                    <div class="pt-5">
                                        <button type="submit" name="submit2" class="btn btn-danger">Aprobar</button>

                                        <button type="submit" name="submit" class="btn btn-danger">Rechazar</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </form>
                    </td>
                    <?php endforeach; ?>
                </tr>
            </table>
        </div>
        <?php } else{ ?>

            <div class="card col-md-4 bg-secondary text-white mb-5">
                        <div class="py-2">
                            <div class="card bg-dark">

                                <div class="px-3 py-3 text-center">
                                    <img src="" height="400px" width="400px">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fTitulos">
                                        Titulo
                                    </h5>
                                    <p class="card-text fNormal">
                                       Descripcion
                                    </p>
                                    <p class="card-text fNormal">
                                        Noticia
                                    </p>
                                    <p class="card-text"><small class="text-muted">
                                            Fecha
                                        </small></p>
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    Pais
                                                </small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    Ciudad
                                                </small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    Colonia
                                                </small></p>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                        <p class="card-text"><small class="text-muted">
                                                            Categoria
                                                        </small></p>
                                            </div>
                                            <div class="col-md-4">
                                                        <p class="card-text"><small class="text-muted"> Palabra clave: 
                                                        </small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label for="exampleFormControlTextarea1"
                                            class="form-label fNormal">Comentarios</label>
                                        <textarea class="form-control bg-dark text-white" rows="4"
                                            placeholder="Contexto..." name="coment"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
        </div>

        <?php } 
                                            $sql = "SELECT * FROM Status_News_Aprobada";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $count = $stmt->rowCount();
                                            $count2 = $stmt->rowCount();
                                            if($count < 1){
                                    ?>

            <div class="col-md-4 text-white">
                <div class="row col-md-6 offset-md-4">
                    <div class="card bg-secondary ">
                        <div class="py-2">
                            <div class="card my-3 bg-dark"><br>
                                <div>
                                    <h5 class="pt-1 ps-3 fTitulos">No hay noticias por publicar</h5> <br>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
                                        <?php
                                                
                                            } else if($count > 0){
                                                $registros = $stmt->fetchAll();

                                        ?>

            <div class="col-md-4 text-white">
                <div class="row col-md-6 offset-md-4">
                    <div class="card bg-secondary ">
                        <div class="py-2">
                            <div class="card my-3 bg-dark">
                                <div>
                                    <h5 class="pt-1 ps-3 fTitulos">Publicar noticias:</h5>
                                </div>
                            </div><?php foreach($registros AS $r): ?>
                            <div class="card bg-dark">
                                <table>
                                    <tr>
                                        <td>
                                        <form class="form" action="noticiaRechazada_inc.php" method="post" enctype="multipart/form-data">
                                                <div class="card-body">
                                                <input type="hidden" name="idnews" value="<?= $r['NEWS_ID'] ?>">
                                                    <h5 class="card-title fTitulos"><?= $r['TITLE'] ?></h5>
                                                    <p class="card-text fNormal"><?= $r['DESCRIPTION'] ?> </p>
                                                    <p class="card-text"><small class="text-muted"><?= $r['CREATION_DATE'] ?></small></p>
                                                    <button type="submit" name="submit3" class="btn btn-danger">Publicar</button>
                                                </div>
                                            </form>
                                        </td>
                                        <?php endforeach; ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</div>

</body>

</html>
<!-------------AQUI EMPIEZA LA SECCION PARA EL REPORTERO------------->

        <?php 
                if($_SESSION['rol'] == 3){ ?>
<div class="container-fluid pt-5 mb-5">
    <div class="row">
                        <?php  
                        $user_check = $_SESSION['email'];


                        $sql = "SELECT  N.NEWS_ID, N.TITLE,  N.`DESCRIPTION`,N.`CREATION_DATE`, N.`STATUS`, CAT.CATEGORIES_ID 
                        FROM NEWS AS N INNER JOIN CATEGORIES AS CAT ON N.CATEGORIES_ID = CAT.CATEGORIES_ID               
                        WHERE N.CREATED_BY = '$user_check' AND  N.`STATUS` = 'REDACCION' ";

                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        $count = $stmt->rowCount();
                                        $count2 = $stmt->rowCount();
                       
                                        if($count > 0){   
                                                $registros = $stmt->fetchAll();
                                        ?>
   
        <div class="col-md-4 text-white">
            <div class="row col-md-6 offset-md-4">
                <div class="card bg-secondary">
                    <div class="py-2">
                        <div class="card mb-3 bg-dark">
                            <div>
                                <h5 class="pt-1 ps-3 fTitulos">Noticias en redaccion: </h5>
                            </div>
                        </div>
                        <div class="card bg-dark">
                        <?php foreach($registros AS $r): ?>
                            <table>
                                <tr>
                                    <td>
                                    <form class="form" action="editar_Noticia.php?id=<?= $r['NEWS_ID'] ?>&cat=<?= $r['CATEGORIES_ID'] ?>" method="post" enctype="multipart/form-data">   
                                            <div class="card-body">
                                                <input type="hidden" name="idnews" value="<?= $r['NEWS_ID'] ?>">
                                                <h5 class="card-title fTitulos" name="titulo">
                                                    <?= $r['TITLE'] ?>
                                                </h5>
                                                <p class="card-text fNormal" name="descripcion">
                                                    <?= $r['DESCRIPTION'] ?>
                                                </p>
                                                <p class="card-text"><small class="text-muted">
                                                        <?= $r['CREATION_DATE'] ?>
                                                    </small></p>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" name="submit" class="btn btn-danger">Ver</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <?php endforeach;?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <?php

        }else if($count < 1){
            ?>
    
            <div class="col-md-4 text-white">
                <div class="row col-md-6 offset-md-4">
                    <div class="card bg-secondary">
                        <div class="py-2">
                            <div class="card mb-3 bg-dark">
                                <div>
                                    <h5 class="pt-1 ps-3 fTitulos">No hay noticias guardadas</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    


        <?php }
            if(isset($_POST['idnews'])) {
                            $id = $_POST['idnews'];
                            $sql = "SELECT  N.NEWS_ID, N.PORTADA, N.TITLE,  N.`DESCRIPTION`, N.`TEXT`, N.DATE_OF_EVENTS, N.CITY, N.SUBURB, N.COUNTRY, N.KEY_WORDS, N.`STATUS`, 
                            C.`COMMENT`, CAT.CATEGORY , CAT.CATEGORIES_ID FROM NEWS AS N INNER JOIN COMMENTS_EDITOR AS C ON N.NEWS_ID = C.NEWS_ID
                            INNER JOIN CATEGORIES AS CAT ON N.CATEGORIES_ID = CAT.CATEGORIES_ID
                            WHERE N.NEWS_ID = '$id' ";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $count = $stmt->rowCount();

                            if($count > 0){
                                $registros = $stmt->fetchAll();
                            }

                            foreach($registros AS $r):
                            ?>
        <div class="card col-md-4 bg-secondary text-white mb-5">
            <table>
                <tr>
                    <td>
                    <form class="form" action="editar_Noticia.php?id=<?= $r['NEWS_ID'] ?>&cat=<?= $r['CATEGORIES_ID'] ?>" method="post" enctype="multipart/form-data">
                        <div class="py-2">
                            <div class="card bg-dark">
                                <input type="hidden" name="idnews" value="<?= $r['NEWS_ID'] ?>">
                                <div class="px-3 py-3 text-center">
                                    <img src="<?= $r['PORTADA'] ?>" height="400px" width="400px">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fTitulos">
                                        <?= $r['TITLE'] ?>
                                    </h5>
                                    <p class="card-text fNormal">
                                        <?= $r['DESCRIPTION'] ?>
                                    </p>
                                    <p class="card-text fNormal">
                                        <?= $r['TEXT'] ?>
                                    </p>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    <?= $r['COUNTRY'] ?>
                                                </small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    <?= $r['CITY'] ?>
                                                </small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    <?= $r['SUBURB'] ?>
                                                </small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    <?= $r['DATE_OF_EVENTS'] ?>
                                                </small></p>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                        <p class="card-text"><small class="text-muted">
                                                            <?= $r['CATEGORY'] ?>
                                                        </small></p>
                                            </div>
                                            <div class="col-md-4">
                                                        <p class="card-text"><small class="text-muted"> Palabra clave: 
                                                            <?= $r['KEY_WORDS'] ?>
                                                        </small></p>
                                            </div>
                                        </div>
                                    </div>
                                        <hr>
                                    <div class="mb-3 mt-2">
                                        
                                        <label for="exampleFormControlTextarea1"
                                            class="form-label fNormal">Comentarios</label>
                                        <textarea class="form-control bg-dark text-white" rows="4"
                                            placeholder="Contexto..." name="coment" readonly><?= $r['COMMENT'] ?></textarea>
                                    </div>
                                    <div class="pt-5 d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-danger">Editar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </td>
                    <?php endforeach; ?>
                </tr>
            </table>
        </div>
        <?php } else{ ?>

            <div class="card col-md-4 bg-secondary text-white mb-5">
                        <div class="py-2">
                            <div class="card bg-dark">

                                <div class="px-3 py-3 text-center">
                                    <img src="" height="400px" width="400px">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fTitulos">
                                        Titulo
                                    </h5>
                                    <p class="card-text fNormal">
                                       Descripcion
                                    </p>
                                    <p class="card-text fNormal">
                                        Noticia
                                    </p>
                                    <p class="card-text"><small class="text-muted">
                                            Fecha
                                        </small></p>
                                    <hr>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    Pais
                                                </small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    Ciudad
                                                </small></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="card-text"><small class="text-muted">
                                                    Colonia
                                                </small></p>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-3">
                                                        <p class="card-text"><small class="text-muted">
                                                            Categoria
                                                        </small></p>
                                            </div>
                                            <div class="col-md-4">
                                                        <p class="card-text"><small class="text-muted"> Palabra clave: 
                                                        </small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <label for="exampleFormControlTextarea1"
                                            class="form-label fNormal">Comentarios</label>
                                        <textarea class="form-control bg-dark text-white" rows="4"
                                            placeholder="Contexto..." name="coment" readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
        </div>

                                    <?php }
                                            $user_check = $_SESSION['email'];
                                            $sql = "SELECT * FROM Status_News_Rechazada WHERE CREATED_BY = '$user_check' ";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            $count = $stmt->rowCount();
                                            $count2 = $stmt->rowCount();
                                            if($count < 1){
                                    ?>

            <div class="col-md-4 text-white">
                <div class="row col-md-6 offset-md-4">
                    <div class="card bg-secondary ">
                        <div class="py-2">
                            <div class="card my-3 bg-dark"><br>
                                <div>
                                    <h5 class="pt-1 ps-3 fTitulos">No hay noticias por corregir</h5> <br>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
                                        <?php
                                                
                                            } else if($count > 0){
                                                $registros = $stmt->fetchAll();

                                        ?>

            <div class="col-md-4 text-white">
                <div class="row col-md-6 offset-md-4">
                    <div class="card bg-secondary ">
                        <div class="py-2">
                            <div class="card my-3 bg-dark">
                                <div>
                                    <h5 class="pt-1 ps-3 fTitulos">Noticias NO validadas:</h5>
                                </div>
                            </div><?php foreach($registros AS $r): ?>
                            <div class="card bg-dark">
                                <table>
                                    <tr>
                                        <td>
                                            <form action="aprobar_Noticia.php" method="POST" enctype="multipart/form-data">
                                                <div class="card-body">
                                                <input type="hidden" name="idnews" value="<?= $r['NEWS_ID'] ?>">
                                                    <h5 class="card-title fTitulos"><?= $r['TITLE'] ?></h5>
                                                    <p class="card-text fNormal"><?= $r['DESCRIPTION'] ?> </p>
                                                    <p class="card-text"><small class="text-muted"><?= $r['CREATION_DATE'] ?></small></p>
                                                    <button type="submit" name="submit" class="btn btn-danger">Ver
                                                        noticia</button>
                                                </div>
                                            </form>
                                        </td>
                                        <?php endforeach; ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</div>

</body>

</html>