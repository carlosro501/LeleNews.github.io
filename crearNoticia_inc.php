<?php 
include "db.php";
session_start();

    if(isset($_POST["submit"])){
        if(!empty($_POST['titulo']) && !empty($_POST['categoria']) && !empty($_POST['descripcion']) && !empty($_POST['texto']) 
            && !empty($_POST['key']) && !empty($_POST['colonia']) && !empty($_POST['ciudad']) && !empty($_POST['pais']) 
            && !empty($_POST['fecha']) && !empty($_POST['firma']) && !empty($_POST['imp']) && !empty($_FILES['portada'])){
                if($_SESSION['status'] < 2){
  


        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $texto = $_POST['texto'];
        $colonia = $_POST['colonia'];
        $ciudad = $_POST['ciudad'];
        $pais = $_POST['pais'];
        $fecha = $_POST['fecha'];
        $key_word = $_POST['key'];
        $firma = $_POST['firma'];
        $user = $_POST['email'];
        $categoria = $_POST['categoria'];
        $level = $_POST['imp'];
        $status = "REDACCION";
        $portada = $_FILES['portada'];

        $tmp_name = $portada['tmp_name'];
        $directorio_destino = "images";
    
        $img_file = $portada['name'];
        $img_type = $portada['type'];

        // Si se trata de una imagen   

        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
            strpos($img_type, "jpg")) || strpos($img_type, "png")))
        {
            //¿Tenemos permisos para subir la imágen?

            $destino = $directorio_destino . '/' .  $img_file;

            $sql = "CALL sp_crearNoticia(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, sysdate() )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $titulo);
            $stmt->bindParam(2, $descripcion);
            $stmt->bindParam(3, $texto);
            $stmt->bindParam(4, $colonia);
            $stmt->bindParam(5, $ciudad);
            $stmt->bindParam(6, $pais);
            $stmt->bindParam(7, $fecha);
            $stmt->bindParam(8, $key_word);
            $stmt->bindParam(9, $firma);
            $stmt->bindParam(10, $user);
            $stmt->bindParam(11, $categoria);
            $stmt->bindParam(12, $destino);
            $stmt->bindParam(13, $level);
            $stmt->bindParam(14, $status);

            if ($stmt->execute()){
                header("location: crear_Noticia.php");
            } else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=Error"); 

            if (move_uploaded_file($tmp_name, $destino))
            {
                return true;

            }
        } return false;//Si llegamos hasta aquí es que algo ha fallado
    
            }else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=Bloqueado");
        } else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=CamposFaltantes"); 
        
    }else if(isset($_POST["submit2"])){

        if(!empty($_POST['titulo']) && !empty($_POST['categoria']) && !empty($_POST['descripcion']) && !empty($_POST['texto']) 
        && !empty($_POST['key']) && !empty($_POST['colonia']) && !empty($_POST['ciudad']) && !empty($_POST['pais']) 
        && !empty($_POST['fecha']) && !empty($_POST['firma']) && !empty($_POST['imp']) && !empty($_FILES['portada'])){
            if($_SESSION['status'] < 2){

    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $texto = $_POST['texto'];
    $colonia = $_POST['colonia'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $fecha = $_POST['fecha'];
    $key_word = $_POST['key'];
    $firma = $_POST['firma'];
    $user = $_POST['email'];
    $categoria = $_POST['categoria'];
    $level = $_POST['imp'];
    $status = "TERMINADA";
    $portada = $_FILES['portada'];

    $tmp_name = $portada['tmp_name'];
    $directorio_destino = "images";

    $img_file = $portada['name'];
    $img_type = $portada['type'];

    // Si se trata de una imagen   

    if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
        strpos($img_type, "jpg")) || strpos($img_type, "png")))
    {
        //¿Tenemos permisos para subir la imágen?

        $destino = $directorio_destino . '/' .  $img_file;

        $sql = "CALL sp_crearNoticia(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, sysdate() )";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $titulo);
        $stmt->bindParam(2, $descripcion);
        $stmt->bindParam(3, $texto);
        $stmt->bindParam(4, $colonia);
        $stmt->bindParam(5, $ciudad);
        $stmt->bindParam(6, $pais);
        $stmt->bindParam(7, $fecha);
        $stmt->bindParam(8, $key_word);
        $stmt->bindParam(9, $firma);
        $stmt->bindParam(10, $user);
        $stmt->bindParam(11, $categoria);
        $stmt->bindParam(12, $destino);
        $stmt->bindParam(13, $level);
        $stmt->bindParam(14, $status);

        if ($stmt->execute()){
            header("location: crear_Noticia.php");
        } else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=Error"); 

        if (move_uploaded_file($tmp_name, $destino))
        {
            return true;

        }
    } return false;//Si llegamos hasta aquí es que algo ha fallado
    }else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=Bloqueado");
    
    } else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=CamposFaltantes"); 


    } else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=CamposFaltantes"); 

?>
