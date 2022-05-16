
<?php
    // HEADER
    include_once("header.php");

            if(isset($_POST['btnenviar'])){
                $Key = $_POST['buscar'];
            }
?>

<br><br>
<div class ="container text-white text-center">
<h1>REPORTE DE SECCIONES</h1>
</div><br><br>
<hr class ="text-white">
<div class ="container text-white">



            <?php 
                                                        $status = "PUBLICADA";
                                                        $sql = "SELECT N.PORTADA, N.TITLE, N.DESCRIPTION,N.KEY_WORDS, N.DATE_OF_NEWS, N.NEWS_ID, N.SIGN, N.LIKES, C.HEXA, C.CATEGORIES_ID, C.CATEGORY
                                                        FROM NEWS  AS N 
                                                        INNER JOIN CATEGORIES AS C ON N.CATEGORIES_ID =  C.CATEGORIES_ID
                                                        WHERE `STATUS` = '$status'
                                                        ORDER BY LIKES DESC ";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->execute(); 
                                                        $count = $stmt->rowCount();

                                                        if($count > 0){
                                                            $registros = $stmt->fetchAll();
                                                        foreach($registros AS $r):
            ?>

    <table border="1" cellpadding="15" cellspacing="10" width="100%" bgcolor = "#545657">


        <tbody>

            <tr >
                    <th bgcolor =  "<?= $r['HEXA'] ?>" >
                
                    <td>
                    <div class="fTitulos text-center"  font color="red">
                    <a style="text-decoration:none; color:<?= $r['HEXA'] ?>"  href="secciones.php?id=<?= $r['CATEGORIES_ID']?>">
                        <h1>
                            <?= $r['CATEGORY'] ?>
                        </h1>
                    </a>
                    </div><br><br><br><br><br><br><br><br><br><br>
                    <p>Likes: <?= $r['LIKES'] ?> </p>
                    </td>
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

                    <p class="card-text fNormal"> <small class=""> Firma:
                            <?= $r['SIGN'] ?>
                        </small></p>

                </td>


                <td><br><br><br><br><br>
                    <h4 class="fSubtitulo">
                        <?= $r['DESCRIPTION'] ?>
                        <hr>
                    </h4>

                    <p class="card-text"><small class="">
                            <?= $r['DATE_OF_NEWS'] ?>
                        </small></p>
                </td>
            </tr>
                
        </tbody>
    </table> <br><br>

        <?php endforeach; ?>
        </div><br><br><br><br><br><br><br><br>
      
        <?php }else if($count < 1) { ?>

<div class="container">
    <div class="row">
        <div class="card col-12 bg-secondary text-white mb-5">
            <div class="py-2">
                <div class="card bg-dark">
                    <div class="card-body text-center">
                        <h5 class="card-title fTitulos">
                            No se encontraron resultados para su busqueda :C
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php }?>
<hr class="bg-light">


<?php include_once("footer.php");?>