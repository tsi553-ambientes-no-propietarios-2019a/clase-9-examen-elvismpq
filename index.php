<?php
if($_GET){
    if (isset($_GET['error_message'])) {
        $error_message=$_GET['error_message'];
    }elseif(isset($_GET['successful_message'])){
        $successful_message=$_GET['successful_message'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<b><h3>Iniciar Sesión</h3></b>
    <form action="fun/login_process.php" method="post">
    Usuario: <input type="text" name='username'><br>
    Contraseña:<input type="password" name='password'><br>
    Rol de Usuario: <select name="role" id="idrole">
    <option value="Administrador">Administrador</option>
    <option value="Cliente">Cliente</option>
    </select><br>
    <input type="submit" value='Ingresar'>
    <a href="registro.php">Registrar mi tienda</a><br>
    </form>
    <?php if (isset($error_message)) {
      echo '<strong>'.$error_message.'</strong>';
      }elseif(isset($successful_message)) {
        echo '<strong>'.$successful_message.'</strong>';
        }
      ?>
</body>
</html>