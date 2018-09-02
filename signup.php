<?php
  try{
    require 'database.php';
    $message = '';
    if (!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['rpass'])) {
      //Comprueba correo existente 
      $mail=$_POST['email'];
      $consulta=$conexion->prepare("Select correo from login where correo=$mail");
      $consulta->execute(); 
      $consulta=$consulta->rowCount();
      if($consulta>0){
        $message="Este usuario ya esta registrado";
      }else{
        //Comprueba pass iguales
        if($_POST['pass']===$_POST['rpass']){
          $sql = "Insert into login (correo,contrasena) values (:email,:pass)";
          $stmt = $conexion->prepare($sql);
          $stmt->bindValue(':email', $_POST['email']);
          $p=$_POST['pass'];
          $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
          $stmt->bindValue(':pass', $pass);
          $stmt->execute();
          $cambio=$stmt->rowCount();
          if($cambio>0) { 
            //Enviar correo con contraseña
            $textomail="Gracias por registrarte! Tu contraseña es: $p";
            $destinatario=$_POST['email'];
            $asunto="Ya estas registrado!";
            $headers="MIME-Version: 1.0\r\n";
            $headers.="Content-type: text/html; chartset=iso-8859-1\r\n";
            $headers.="From: Aplicacion|\r\n".date("Y");
            $exito=mail($destinatario,$asunto,$textomail,$headers);
            if($exito){
              $message = 'Nuevo usuario registrado con exito';
            }else{
              echo ("ha habido un error");
            }
        }else{
          $message = 'No se ha podido registrar el usuario';
        }
       }else{
         $message="Las contraseñas no coinciden";
       }
      }
    }  
  }catch(Exception $e){
    die("Error: ".$e->getMessage());
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrate</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php require 'partials/header.php' ?>
<?php if(!empty($message)): ?>
    <p id="error"><?= $message ?></p>
<?php endif; ?>
<h1>Registrate</h1>
<span>o <a href="login.php">Inicia Sesion</a></span>
<form action="signup.php" method="post" onsubmit="return Validate()" name="form">
    <input type="email" name="email" placeholder="Ingrese su correo" required>
    <input type="password" name="pass" placeholder="Ingrese su contraseña" id="pass" minlength="8" required>
    <input type="password" name="rpass" placeholder="Repita su contraseña" required>
    <input class="btn btn-outline-dark" type="submit" value="Registrar" id="boton">
</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>