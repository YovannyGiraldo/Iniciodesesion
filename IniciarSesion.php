<?php
session_start();

    include('Conexion.php');
    if(isset($_POST['Usuario']) && isset($_POST['Clave'])) {
        //se crean las funciones para el acceso a la base de datos
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $Usuario = validate($_POST['Usuario']);
        $Clave = validate($_POST['Clave']);
        // se genera un condicional para el acceso al inicio, validando los datos de usuario y contraseña
        if(empty($Usuario)) {
            header("Location: Index.php?error=El usuario es requerido");
            exit();
        }elseif (empty($Clave)){
            header("Location: Index.php?error=La clave es requerida");
            exit();
        }else {
            
            // $Clave = md5($Clave);
            // se realizan las funciones para validar que los datos en la pagina web de usuario y contraseña, sean iguales a las de las bases de datos para el acceso correcto.

            $Sql = "SELECT * FROM  usuarios WHERE  Usuario = '$Usuario' AND Clave='$Clave'";
            $result = mysqli_query($conexion, $Sql);

            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                if($row['Usuario'] === $Usuario && $row['Clave'] === $Clave){
                $_SESSION['Usuario'] = $row['Usuario'];
                $_SESSION['Nombre_Completo'] = $row['Nombre_Completo'];
                $_SESSION['Id'] = $row['Id'];
                header("Location: Inicio.php");
                exit();
            }else {
                header("Location: Index.php?error=El usuario o la clave son incorrectas"); //si lo datos son incorrectos se saltan los mensajes de error

            }
        }else {
            header("Location: Index.php?error=El usuario o la clave son incorrectas");
        }
    }
}else {
    header("Location: Index.php?error=El usuario o la clave son incorrectas");
}