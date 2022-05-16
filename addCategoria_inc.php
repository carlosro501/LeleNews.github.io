<?php
    include "db.php";


    if(!empty($_POST['categoria']) && !empty($_POST['color']) && !empty($_POST['hexa']) ){

        $categoria = $_POST['categoria'];
        $color = $_POST['color'];
        $hexa = $_POST['hexa'];
        $firma = $_POST['firma'];
        

        $sql = "CALL sp_addCat(?, ?, ?, sysdate(), ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $categoria);
        $stmt->bindParam(2, $color);
        $stmt->bindParam(3, $hexa);
        $stmt->bindParam(4, $firma);


        if ($stmt->execute()){
            header("location: verCategorias.php");
        } else header("location: ../BDM-PWCI-Proyecto-Final/addCategoria.php?error=Error"); 
        
    } else header("location: ../BDM-PWCI-Proyecto-Final/addCategoria.php?error=CamposFaltantes"); 
?>