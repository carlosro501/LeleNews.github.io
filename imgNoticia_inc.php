<?php 
include 'db.php';

if(isset($_POST["submit"])){
    $id = $_POST['id'];
    $img = $_FILES['foto'];


    $tmp_name = $img['tmp_name'];
    $directorio_destino = "images";
        
            $img_file = $img['name'];
            $img_type = $img['type'];

            // Si se trata de una imagen   
            if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
    strpos($img_type, "jpg")) || strpos($img_type, "png")))
            {
                //¿Tenemos permisos para subir la imágen?

                $destino = $directorio_destino . '/' .  $img_file;
                $sql = "CALL sp_subirImg(?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $destino);
                $stmt->bindParam(2, $id);


                if ($stmt->execute()){
                    header("location: crear_Noticia.php");
                } else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=Error"); 

                if (move_uploaded_file($tmp_name, $destino))
                {
                    return true;

                }
            } return false;//Si llegamos hasta aquí es que algo ha fallado
}else if(isset($_POST["submit2"])){

    $id_img = $_POST['id_img'];
    $id_news = $_POST['id_new'];
    $img = $_FILES['foto'];


    $tmp_name = $img['tmp_name'];
    $directorio_destino = "images";
        
            $img_file = $img['name'];
            $img_type = $img['type'];

            // Si se trata de una imagen   
            if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
    strpos($img_type, "jpg")) || strpos($img_type, "png")))
            {
                //¿Tenemos permisos para subir la imágen?

                $destino = $directorio_destino . '/' .  $img_file;
                $sql = "CALL sp_updImg(?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $destino);
                $stmt->bindParam(2, $id_img);
                $stmt->bindParam(3, $id_news);


                if ($stmt->execute()){
                    header("location: aprobar_Noticia.php?Exito");
                } else header("location: ../BDM-PWCI-Proyecto-Final/aprobar_Noticia.php?error=Error"); 

                if (move_uploaded_file($tmp_name, $destino))
                {
                    return true;

                }
            } return false;//Si llegamos hasta aquí es que algo ha fallado
    }else header("location: ../BDM-PWCI-Proyecto-Final/index.php?error=Error"); 

?>
