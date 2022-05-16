<?php
    include "db.php";
session_start();


if(isset($_POST["submit"])){
    if(empty($_POST['coment']) ){
        header("location: ../BDM-PWCI-Proyecto-Final/aprobar_Noticia.php?error=InserteComentario");
    } else{ 
        $id = $_POST['idnews'];
        $sql = "CALL sp_rechazar(?)";
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(1, $id);
        if ($stmt->execute()){   

            $comment = $_POST['coment'];
            $id = $_POST['idnews'];
            $user_check = $_SESSION['email'];
        
            $sql_coment = "CALL sp_editorComment(?, ?, ?, sysdate())";
            $consulta = $conn->prepare($sql_coment);
            $consulta->bindParam(1, $comment);
            $consulta->bindParam(2, $id);
            $consulta->bindParam(3, $user_check);

            if ($consulta->execute()){
                header("location: aprobar_Noticia.php?Exito");
            } else header("location: ../BDM-PWCI-Proyecto-Final/aprobar_Noticia.php?error=comentarioEditor");
        } else header("location: ../BDM-PWCI-Proyecto-Final/aprobar_Noticia.php?error=rechazarNoticia ");
    }
} else if(isset($_POST["submit2"])){

    $id = $_POST['idnews'];
    $sql = "CALL sp_aprobar(?)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(1, $id);
    
        if ($stmt->execute()){
            header("location: aprobar_Noticia.php?Exito");                    
        } else header("location: ../BDM-PWCI-Proyecto-Final/aprobar_Noticia.php?error=ErrorAprobar");

    } else if(isset($_POST["submit3"])){

        $id = $_POST['idnews'];
        $sql = "CALL sp_publicar(?, sysdate())";
        $stmt = $conn->prepare($sql);
    
        $stmt->bindParam(1, $id);
        
            if ($stmt->execute()){
                header("location: aprobar_Noticia.php?Exito");                    
            } else header("location: ../BDM-PWCI-Proyecto-Final/aprobar_Noticia.php?error=ErrorAprobar");
        } else header("location: ../BDM-PWCI-Proyecto-Final/aprobar_Noticia.php?error=BotonAprobar");
    


?>