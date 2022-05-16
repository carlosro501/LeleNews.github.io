
<?php 
include "db.php";
session_start();

if(isset($_POST["submit"])){
        if(!empty($_POST['titulo']) && !empty($_POST['categoria']) && !empty($_POST['descripcion']) && !empty($_POST['texto']) 
            && !empty($_POST['key']) && !empty($_POST['colonia']) && !empty($_POST['ciudad']) && !empty($_POST['pais']) 
            && !empty($_POST['fecha']) && !empty($_POST['imp']) ){
                if($_SESSION['status'] < 2){

                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];
                $texto = $_POST['texto'];
                $colonia = $_POST['colonia'];
                $ciudad = $_POST['ciudad'];
                $pais = $_POST['pais'];
                $fecha = $_POST['fecha'];
                $key_word = $_POST['key'];
                $categoria = $_POST['categoria'];
                $portada = $_FILES['portada'];
                $id = $_POST['news_id'];
                $level = $_POST['imp'];
                $status = "REDACCION";

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

            $sql = "CALL sp_updNoticia(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, sysdate())";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $titulo);
            $stmt->bindParam(2, $descripcion);
            $stmt->bindParam(3, $texto);
            $stmt->bindParam(4, $colonia);
            $stmt->bindParam(5, $ciudad);
            $stmt->bindParam(6, $pais);
            $stmt->bindParam(7, $fecha);
            $stmt->bindParam(8, $key_word);
            $stmt->bindParam(9, $categoria);
            $stmt->bindParam(10, $destino);
            $stmt->bindParam(11, $id);
            $stmt->bindParam(12, $level);
            $stmt->bindParam(13, $status);

            if ($stmt->execute()){
                header("location: index.php");
            } else header("location: ../BDM-PWCI-Proyecto-Final/editar_Noticia.php?error=Error"); 

            (move_uploaded_file($tmp_name, $destino));
            


        }
    }else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=Bloqueado");
        } else header("location: ../BDM-PWCI-Proyecto-Final/editar_Noticia.php?error=CamposFaltantes"); 
        
    } else if(isset($_POST["submit2"])){
        if(!empty($_POST['titulo']) && !empty($_POST['categoria']) && !empty($_POST['descripcion']) && !empty($_POST['texto']) 
            && !empty($_POST['key']) && !empty($_POST['colonia']) && !empty($_POST['ciudad']) && !empty($_POST['pais']) 
            && !empty($_POST['fecha']) && !empty($_POST['imp']) ){
                if($_SESSION['status'] < 2){

                $titulo = $_POST['titulo'];
                $descripcion = $_POST['descripcion'];
                $texto = $_POST['texto'];
                $colonia = $_POST['colonia'];
                $ciudad = $_POST['ciudad'];
                $pais = $_POST['pais'];
                $fecha = $_POST['fecha'];
                $key_word = $_POST['key'];
                $categoria = $_POST['categoria'];
                $portada = $_FILES['portada'];
                $id = $_POST['news_id'];
                $level = $_POST['imp'];
                $status = "TERMINADA";

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

            $sql = "CALL sp_updNoticia(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, sysdate())";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $titulo);
            $stmt->bindParam(2, $descripcion);
            $stmt->bindParam(3, $texto);
            $stmt->bindParam(4, $colonia);
            $stmt->bindParam(5, $ciudad);
            $stmt->bindParam(6, $pais);
            $stmt->bindParam(7, $fecha);
            $stmt->bindParam(8, $key_word);
            $stmt->bindParam(9, $categoria);
            $stmt->bindParam(10, $destino);
            $stmt->bindParam(11, $id);
            $stmt->bindParam(12, $level);
            $stmt->bindParam(13, $status);

            if ($stmt->execute()){
                header("location: index.php");
            } else header("location: ../BDM-PWCI-Proyecto-Final/editar_Noticia.php?error=Error"); 

            (move_uploaded_file($tmp_name, $destino));
            


        }
    }else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=Bloqueado");
        } else header("location: ../BDM-PWCI-Proyecto-Final/editar_Noticia.php?error=CamposFaltantes"); 
        
    }  else if(isset($_POST["submit3"])){
        $id = $_POST['news_id'];
                if($_SESSION['status'] < 2){


           
            $sql ="DELETE FROM NEWS WHERE NEWS_ID = '$id' ";
            $stmt = $conn->prepare($sql);



            $stmt = $conn->prepare($sql);
    
            if ($stmt->execute()){
                header("location: index.php");
            } else header("location: ../BDM-PWCI-Proyecto-Final/editar_Noticia.php?error=Error"); 

       

        }else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=Bloqueado");
    }else header("location: ../BDM-PWCI-Proyecto-Final/crear_Noticia.php?error=Error");

    ?>