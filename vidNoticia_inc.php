<?php 
include 'db.php';


if(isset($_POST["submit"])){
$id = $_POST['id'];
$vid = $_FILES['foto'];


$tmp_name = $vid['tmp_name'];
$directorio_destino = "videos";
    
        $vid_file = $vid['name'];
        $vid_type = $vid['type'];

        // Si se trata de una imagen   
        if (((strpos($vid_type, "mp4") )))
        {
            //¿Tenemos permisos para subir la imágen?

            $destino = $directorio_destino . '/' .  $vid_file;
            $sql = "CALL sp_subirVid(?, ?)";

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

        $id_vid = $_POST['id_vid'];
        $id_news = $_POST['id_new'];
        $vid = $_FILES['foto'];
        
        
        $tmp_name = $vid['tmp_name'];
        $directorio_destino = "videos";
            
                $vid_file = $vid['name'];
                $vid_type = $vid['type'];
        
                // Si se trata de una imagen   
                if (((strpos($vid_type, "mp4") )))
                {
                    //¿Tenemos permisos para subir la imágen?
        
                    $destino = $directorio_destino . '/' .  $vid_file;
                    $sql = "CALL sp_updVid(?, ?, ?)";
        
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(1, $destino);
                    $stmt->bindParam(2, $id_vid);
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
