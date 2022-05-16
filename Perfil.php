<?php
    // HEADER
    include_once("header.php");
?>

    <!--Principal-->
    <div class="container">
        <h1 class="fSubtitulo text-white text-center mt-4">MI PERFIL</h1>
        <hr class="bg-light">
        <div class="container datos">

            <div class="main text-white">
            <div class="panel panel-primary">
        </div>
    </div>

    <div class="container col-6 bg-secondary rounded fSubtitulo"><br>
        <div class="container col-10">
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
                <!--Form-->
                <form class="fNormal">
                    <div class="text-center">
                        <img src="<?= $r['IMG'] ?>"  name = "image" id="idimg" width= "200px"alt="..."> 
                    </div>
                    <div>
                    <h6 class="fnormal text-black mt-4">USUARIO: </h6>                  
                    <input type="text" class="form-control bg-dark text-white" name = "user" value="<?= $r['NICK_NAME'] ?>" id="usuario" readonly>
                    </div>
                    <div>
                    <h6 class="fnormal text-black mt-4">CORREO: </h6> 
                    <input type="email" class="form-control bg-dark text-white"name = "email"  value="<?= $r['EMAIL'] ?>" id="correo" readonly>
                    </div>
                    <div>
                    <h6 class="fnormal text-black mt-4">CONTRASEÑA: </h6> 
                    <input type="password" class="form-control bg-dark text-white" name = "pass" value="<?= $r['PASS'] ?>" id="contraseña" readonly>
                    </div>
                    <div>
                    <h6 class="fnormal text-black mt-4">NOMBRE: </h6> 
                    <input type="text" class="form-control bg-dark text-white" name = "fullname" value="<?= $r['USER_FULL_NAME'] ?>" id="nombre" readonly>
                    </div>
                    <div>
                    <h6 class="fnormal text-black mt-4">TELEFONO (opcional): </h6> 
                    <input type="text" class="form-control bg-dark text-white" name = "phone" value="<?= $r['PHONE'] ?>" id="telefono" readonly>
                    </div> <br>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger"><a href="updPerfil.php" style="text-decoration:none; color:white"> Actualizar</a></button>
                    </div><br>
                    <?php endforeach; ?>
                </form>
            </div>
        </div>
        <hr class="bg-light">
    </div>
</div>   <br><br> 

    <?php include_once("footer.php");?>