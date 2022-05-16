
<?php
    // HEADER
    include_once("header.php");

            if(isset($_POST['btnenviar'])){
                $Key = $_POST['buscar'];
            }
?>


<hr class="bg-light">


<div class ="container text-white">




<?php 
                 $master = $_GET['com'];
                 $idnews = $_GET['id'];
                $sql ="SELECT C.`TEXT`, C.`CREATION_DATE`,C.COMMENT_ID, U.NICK_NAME, U.IMG 
                FROM NEWS_COMMENTS AS C 
                INNER JOIN USERS AS U 
                ON C.CREATED_BY = U.EMAIL
                WHERE COMMENT_ID = '$master'";
                $consulta = $conn->prepare($sql);
                $consulta->execute(); 
                $count = $consulta->rowCount();

                if($count > 0){
                    $registros = $consulta->fetchAll(); 
                }   
                foreach($registros AS $r): ?>


                <table  border="1" cellpadding="15" cellspacing="10" width="100%" bgcolor = "#545657" class="table text-white fNormal">
                    <tbody>
                        <tr>
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
                </table><br><br>

        <?php endforeach; ?>


<?php 
                 $master = $_GET['com'];
                 $idnews = $_GET['id'];
                $sql ="SELECT C.`TEXT`, C.`CREATION_DATE`,C.COMMENT_ID, U.NICK_NAME, U.IMG 
                FROM NEWS_COMMENTS_REPLY AS C 
                INNER JOIN USERS AS U 
                ON C.CREATED_BY = U.EMAIL
                WHERE COMMENT_ID = '$master'";
                $consulta = $conn->prepare($sql);
                $consulta->execute(); 
                $count = $consulta->rowCount();

                if($count > 0){
                    $registros = $consulta->fetchAll(); 
                         
                foreach($registros AS $r): ?>

            <div class = "row">
                <div class ="col-4"></div>
                <div class ="col-8">
                <table  border="1" cellpadding="15" cellspacing="10" width="100%" bgcolor = "#545657" class="table text-white fNormal">
                    <tbody>
                        <tr>
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
                </div>
                </div>

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