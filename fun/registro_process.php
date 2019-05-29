<?php if ($_POST) {
    if(isset($_POST['name']) &&isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['passagain']) &&isset($_POST['role'])&& !empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['passagain'])&& !empty($_POST['role'])){
        $name=$_POST['name'];
        $user=$_POST['username'];
        $pass1=MD5($_POST['password']);
        $pass2=MD5($_POST['passagain']);
        $role=$_POST['role'];
        if ($pass1==$pass2) {
            $conn= new mysqli('localhost','root','12345','examenb1');

            $sql="insert into user(name,username,password,role) values('$name','$user','$pass1','$role')";
            $conn->query($sql);
            if($conn->error){
                header("Location: ../registro.php?error_message=El usuario $user ya existe!");
                exit;
            }else {
                header('Location: ../index.php?successful_message=Usuario registrado correctamente, puede iniciar sesión.');
                exit;
            }
        }else {
            header('Location: ../registro.php?error_message=Las contraseñas no coinciden!');
            exit;
        }

    }else {
        header('Location: ../registro.php?error_message=Ingrese todos los datos');
        exit;
    }
}