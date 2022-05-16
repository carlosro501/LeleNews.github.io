<?php
    // HEADER
    include_once("header.php");
?>

    <!--Principal-->
    <div class="container">
        <h1 class="fSubtitulo text-white text-center mt-4">LISTA DE REPORTEROS</h1>
        <hr class="bg-light">
        <div class="container datos">

            <div class="main text-white">
            <div class="panel panel-primary">
        </div>
    </div>


    
    <div class = "">
    <form class="fNormal text-white" method="POST" action="eliminarEmpleado_inc.php">


        <table border="1" cellpadding="15" cellspacing="10" width="100%" bgcolor="#545657" >
            <thead>
            <tr>
                <td>Email</td>
                <td>Contraseña</td>
                <td>Usuario</td>
                <td>Nombre completo</td>
                <td>Telefono</td>
                <td>Inicio en</td>
                <td>Estado</td>
                <td colspan = "2"> Acciones</td>
                <td colspan = "2"><button type="button" class="btn btn-danger"><a href="Signup.php" style="text-decoration:none; color:white"> Agregar </a></button></td>
            </tr>
            </thead>

            <tbody>
            <?php  
                    $sql = "SELECT * FROM view_Perfiles WHERE ROL > 2";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $count = $stmt->rowCount();

                    if($count > 0){
                        $registros = $stmt->fetchAll();
                    foreach($registros AS $r):
                ?>
                <tr>
                    <td id = "id"> <?= $r['EMAIL']?> </td>
                    <td> <?= $r['PASS']?> </td>
                    <td> <?= $r['NICK_NAME']?> </td>
                    <td> <?= $r['USER_FULL_NAME']?> </td>
                    <td> <?= $r['PHONE']?> </td>
                    <td> <?= $r['CREATION_DATE']?> </td>
                    <td> <?= $r['STATUS']?> </td>
                    <td>
                        <div>
                            <button type="button" class="btn btn-dark"> <a href="eliminarUsuario_inc.php?id=<?= $r['EMAIL']?> " style="text-decoration:none; color:white">Eliminar</a> </button>
                        </div><br>
                        <?php if($r['STATUS'] < 2 ){?>
                        <div>
                            <button type="button" name = "suspender" class="btn btn-dark"> <a href="suspenderUsuario_inc.php?id=<?= $r['EMAIL']?> " style="text-decoration:none; color:white">Suspender</a> </button>
                        </div>
                        <?php }else  if($r['STATUS'] > 1 ){ ?>
                            <div>
                            <button type="button" class="btn btn-primary" name = "activar" > <a href="activarUsuario_inc.php?id=<?= $r['EMAIL']?> " style="text-decoration:none; color:white">Re-activar</a> </button>
                        </div>
                        <?php }?>
                    </td>
                </tr>
                <?php endforeach; }else if($count < 1){?>
            </tbody>
        </table>
        <?php ?>
    </form>
<div class="container">
<div class="row">
<div class="card col-12 bg-secondary text-white mb-5">
    <div class="py-2">
        <div class="card bg-dark">
            <div class="card-body text-center">
                <h5 class="card-title fTitulos">
                    No hay usuarios registrados :C
                </h5>
            </div>
        </div>
    </div>
</div>
</div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php }?>



    
        <hr class="bg-light">
    </div>