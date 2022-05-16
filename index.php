<?php
    // HEADER
    include_once("header.php");
?>
<br><br><br><br>
  <div class="container text-white">
  <div>
      <h3 class="fSubtitulo">Noticias mas IMPORTANTES </h3> 
    </div><br>
    <hr class="bg-light">
  <?php
                                                    $status="PUBLICADA";
                                                    $level="URGENTE";
                                                    $sql = "SELECT N.PORTADA, N.TITLE, N.DESCRIPTION, N.DATE_OF_NEWS,N.SIGN, N.NEWS_ID, N.KEY_WORDS, C.HEXA, C.CATEGORIES_ID, N.`STATUS`, N.CATEGORIES_ID,
                                                    C.HEXA
                                                    FROM NEWS  AS N 
                                                    INNER JOIN CATEGORIES AS C ON N.CATEGORIES_ID =  C.CATEGORIES_ID
                                                    WHERE N.`LEVEL` = '$level' AND N.`STATUS` = '$status'
                                                    ORDER BY NEWS_ID DESC";
                                            
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $count = $stmt->rowCount();
      
                                                        if($count > 0){
                                                            $registros = $stmt->fetchAll();
                                                        foreach($registros AS $r):
                                                    
                                                ?>

        <table border="1" cellpadding="15" cellspacing="10" width="100%" bgcolor="#545657">

            <tr>
                <td bgcolor=<?= $r['HEXA'] ?>>

                    <div class="px-3 py-3">
                        <a href="Noticia.php?id=<?= $r['NEWS_ID'] ?>&cat=<?= $r['CATEGORIES_ID']?>&key=<?= $r['KEY_WORDS']?>">
                            <img src="<?= $r['PORTADA'] ?>" height="400px" width="400px">
                        </a>
                    </div>
                    <p class="card-text fNormal"> <small class=""> Firma:
                            <?= $r['SIGN'] ?>
                        </small></p>
                </td>


                <td>
                  
                    <div class=" ">
                        <h1 class="fTitulos text-center">
                            <?= $r['TITLE'] ?>
                        </h1>
                    </div><br><br><br><br><br><br><br><br><br><br>
                    <h4 class="fSubtitulo">
                        <?= $r['DESCRIPTION'] ?>
                        <hr>
                    </h4>
                    
                    <p class="card-text"><small class="">
                            <?= $r['DATE_OF_NEWS'] ?>
                        </small></p>
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
                               Aqui se mostraran las noticias mas importantes del momento!! :D
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php }?>
       



    <hr class="bg-light">
    <div>
      <h3 class="fSubtitulo">Noticias MAS gustadas </h3>
    </div><br>
    
    <?php
                                                    $status="PUBLICADA";
                                                    $level="NORMAL";
                                                    $sql = "SELECT N.PORTADA, N.TITLE, N.DESCRIPTION, N.DATE_OF_NEWS,N.SIGN, N.NEWS_ID, C.HEXA, C.CATEGORIES_ID, N.`STATUS`, N.CATEGORIES_ID
                                                    FROM NEWS  AS N 
                                                    INNER JOIN CATEGORIES AS C ON N.CATEGORIES_ID =  C.CATEGORIES_ID
                                                    WHERE N.`LEVEL` = '$level' AND N.`STATUS` = '$status'
                                                    ORDER BY LIKES DESC";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();
                                                    $count = $stmt->rowCount();
      
                                                        if($count > 0){
                                                            $registros = $stmt->fetchAll();
                                                        foreach($registros AS $r):
                                                    
                                                ?>

        <table border="1" cellpadding="15" cellspacing="10" width="100%" bgcolor="#545657">

            <tr>
                <td  bgcolor=<?= $r['HEXA'] ?>>
                    <div class="fTitulos text-center">
                        <h1 >
                            <?= $r['TITLE'] ?>
                        </h1>
                    </div>
                    <div class="px-3 py-3">
                        <a href="Noticia.php?id=<?= $r['NEWS_ID'] ?>&cat=<?= $r['CATEGORIES_ID']?>">
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
                                Mantente al pendiente por  mas noticias! :D
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php }?>

    


  </div>


      <!-- FOOTER -->
<?php include_once("footer.php");?>