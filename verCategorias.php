<?php
    // HEADER
    include_once("header.php");
?>

    <!--Principal-->
    <div class="container">
        <h1 class="fSubtitulo text-white text-center mt-4">SECCIONES</h1>
        <hr class="bg-light">
        <div class="container datos">

            <div class="main text-white">
            <div class="panel panel-primary">
        </div>
    </div>


    

        <table border="1" cellpadding="15" cellspacing="10" width="50%" bgcolor = "#545657" align="center" >
            <thead>
            <tr>
            <td>  
                        <div >
                            <h5 >
                                Categorias:
                            </h5>
                        </div>
                    </td>
                
                    <td>  
                        <div >
                            <h5 >
                                Color asignado:
                            </h5>
                        </div>
                    </td>
                    <td>  
                        <div >
                            <h5 >
                                Codigo hexadecimal:
                            </h5>
                        </div>
                    </td>
                    <td>  
                        <div >
                            <h5 >
                                Fecha de creacion:
                            </h5>
                        </div>
                    </td>
                    <td>  
                        <div >
                            <h5 >
                               Creado por:
                            </h5>
                        </div>
                    </td>
                    <td>  
                        <div >
                            <h5 >
                              Acciones:
                            </h5>
                        </div>
                    </td>

                <td colspan = "2"> <div class="card text-white bg-danger mb-3" style="max-width: 18rem;"><div class="card-header"><a href="addCategoria.php" style="text-decoration:none; color:white">Agregar</a></div></div></td>
            </tr>
            </thead>
            <form class="fNormal" method="POST" action="eliminarEmpleado_inc.php"> 
    <?php  
                    $sql = "SELECT * FROM view_Categoria";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    if($count > 0){
                        $registros = $stmt->fetchAll();
                    

                    foreach($registros AS $r):
                ?>
            <tbody>

                <tr >


                    <td bgcolor = <?= $r['HEXA']?>>  
                        <div >
                            <h5 >
                                <?= $r['CATEGORY']?>
                            </h5>
                        </div>
                    </td>

                    <td>  
                        <div >
                            <h5 >
                                <?= $r['COLOR']?>
                            </h5>
                        </div>
                    </td>
                    <td>  
                        <div >
                            <h5 >
                                <?= $r['HEXA']?>
                            </h5>
                        </div>
                    </td>
                    <td>  
                        <div >
                            <h5 >
                                <?= $r['CREATION_DATE']?>
                            </h5>
                        </div>
                    </td>
                    <td>  
                        <div >
                            <h5 >
                                <?= $r['CREATED_BY']?>
                            </h5>
                        </div>
                    </td>

                    <td>
                        <div>
                            <button class="btn btn-primary"><a href="updCategoria.php? id=<?= $r['CATEGORIES_ID']?>" style="text-decoration:none; color:white">Actualizar</a></button>
                        </div><br>
                        <div>
                            <button class="btn btn-dark"><a href="delCategoria_inc.php? id=<?= $r['CATEGORIES_ID']?>" style="text-decoration:none; color:white">Eliminar</a></button>
                        </div>
                    </td>

                </tr>

            </tbody>        <?php endforeach; ?>
        </table><br>
                        

                <?php }else if($count < 1){  ?>


                <tr>
                    <td>
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                        <div class="card-header">No hay secciones creadas</div>
                    </td>
                    
                </tr>

                <?php } ?>
    </form><br><br><br><br>