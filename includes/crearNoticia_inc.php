<?php
    include "db.php";


    if(!empty($_POST['titulo']) && !empty($_POST['descripcion']) && !empty($_POST['noticia']) && !empty($_POST['colonia']) && !empty($_POST['ciudad']) && !empty($_POST['pais']) && !empty($_POST['fecha']) && !empty($_POST['firma']) ){

        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $noticia = $_POST['noticia'];
        $colonia = $_POST['colonia'];
        $ciudad = $_POST['ciudad'];
        $pais = $_POST['pais'];
        $fecha = $_POST['fecha'];
        $firma = $_POST['firma'];
  
        

        $sql = "CALL sp_CrearNoticia(?, ?, ?, ?, ?, ?, ?, ?, sysdate())";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1, $titulo);
        $stmt->bindParam(2, $descripcion);
        $stmt->bindParam(3, $noticia);
        $stmt->bindParam(4, $colonia);
        $stmt->bindParam(5, $ciudad);
        $stmt->bindParam(6, $pais);
        $stmt->bindParam(7, $fecha);
        $stmt->bindParam(8, $firma);
        $stmt->bindParam(9, $user_check);

        if ($stmt->execute()){
            header("location: crear_Noticia.php");
        } else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=Error");
        
    }else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=CamposFaltantes");
?>