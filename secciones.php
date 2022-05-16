<?php
// HEADER
include_once("header.php");
?>




<div class="container">
    <?php 
                                                    $id = $_GET['id'];
                                                    $sql = "SELECT * FROM ver_Cat_Header WHERE CATEGORIES_ID = $id ";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute(); 
                                                    $count = $stmt->rowCount();

                                                    if($count > 0){
                                                        $categoria = $stmt->fetchAll();
                                                    }foreach($categoria AS $r):
    ?>

    <div class="container">
        <h1 class="fSubtitulo text-center mt-4" style="text-decoration:none; color:<?= $r['HEXA'] ?>">
            <?= $r['CATEGORY']?>
        </h1>
        <?php endforeach ?>
        <hr class="bg-light">
    </div>


        <?php
                                                    $id = $_GET['id'];
                                                    $status="PUBLICADA";
                                                    $sql = "SELECT N.PORTADA, N.TITLE, N.`DESCRIPTION`, N.DATE_OF_NEWS,N.SIGN, N.NEWS_ID, N.KEY_WORDS, N.`STATUS`, N.CATEGORIES_ID, C.HEXA, C.CATEGORIES_ID 
                                                    FROM NEWS  AS N 
                                                    INNER JOIN CATEGORIES AS C ON N.CATEGORIES_ID =  C.CATEGORIES_ID
                                                    WHERE N.CATEGORIES_ID = '$id' AND N.`STATUS` = '$status'
                                                    ORDER BY NEWS_ID ASC";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $count = $stmt->rowCount();
      
                                                        if($count > 0){
                                                            $registros = $stmt->fetchAll();
                                                        foreach($registros AS $r):
                                                    
                                                ?>

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

    <?php endforeach; }else if($count < 1) { ?>

    <div class="container">
        <div class="row">
            <div class="card col-12 bg-secondary text-white mb-5">
                <div class="py-2">
                    <div class="card bg-dark">
                        <div class="card-body text-center">
                            <h5 class="card-title fTitulos">
                                No se han agregado noticias con esta categoria :C
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
    <hr class="bg-light">
</div> <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
// FOOTER
include_once("footer.php");
?>