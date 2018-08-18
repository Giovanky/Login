<?php
  require 'database.php';
  $message = '';
  if (!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['rpass'])) {
    $sql = "INSERT INTO login (nombre,contraseña,correo) VALUES (:nombre, :email, :pass)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    if ($stmt->execute()) {
      $message = 'Nuevo usuario ingresado con exito';
    } else {
      $message = 'No se ha podido crear el usuario';
    }
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
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
<?php require 'partials/header.php' ?>
<?php if(!empty($message)): ?>
    <p><?= $message?></p>
<?php endif; ?>
<h1>Registrate</h1>
<span>o <a href="login.php">Inicia Sesion</a></span>
<form action="signup.php" method="post">
    <input type="text" name="nombre" placeholder="Ingrese su nombre" required>
    <input type="email" name="email" placeholder="Ingrese su correo" required>
    <input type="password" name="pass" placeholder="Ingrese su contraseña" required>
    <input type="password" name="rpass" placeholder="Repita su contraseña" required>
    <input class="btn btn-outline-dark"type="submit" value="Registrar">
</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>