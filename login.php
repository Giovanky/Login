<?php
try{
    session_start();
require 'database.php';
$message = '';
if (!empty($_POST['email']) && !empty($_POST['pass'])) {
    $mail=htmlentities(addslashes($_POST['email']));
    $contrasena=htmlentities(addslashes($_POST['pass']));
    $sql = "Select id,contrasena,correo from login where correo=:email";
    $cont=0;
    $stmt = $conexion->prepare($sql);
    $stmt->execute(array(":email" => $mail));
    while($resultado=$stmt->fetch(PDO::FETCH_ASSOC)){
        if(password_verify($contrasena,$resultado['contrasena'])){
            $cont++;
        }
        if($cont>0){
            $_SESSION['email'] = $resultado['correo'];
            header("Location: index.php");
        }else{
            $message ='No coinciden los registros';
        }
    }
}
}catch(Exception $e){
    echo "Error: ".$e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php require 'partials/header.php' ?>
<?php if(!empty($message)): ?>
    <p id="error"><?= $message ?></p>
<?php endif; ?>
    <h1>Inicia Sesion</h1>
    <span>o <a href="signup.php">Registrate</a></span>
    <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Ingrese su correo" required>
        <input type="password" name="pass" placeholder="Ingrese su contraseña" required>
        <input type="submit" class="btn btn-outline-dark" value="Entrar">
    </form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>