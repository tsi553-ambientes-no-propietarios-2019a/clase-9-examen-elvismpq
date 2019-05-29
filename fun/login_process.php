<?php
session_start();
if($_POST){
    if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
        $username=$_POST['username'];
        $pass=MD5($_POST['password']);
        $role=$_POST['role'];
        $conn= new mysqli('localhost','root','12345','examenb1');

        $sql="select * from user where username= '$username' and password='$pass' and role='$role'";

        $res=$conn->query($sql);
        if ($res->num_rows> 0 ) {
            while ($row=$res->fetch_assoc()) {
                $_SESSION['user']=[
                'username'=>$row['username'],
                'id'=>$row['iduser'],
            'name'=>$row['name'],
        'role'=>$row['role']];    
            }
            if ($_SESSION['user']['role']=='Administrador') {
                header('Location: ../admin.php');
                exit;
            }elseif($_SESSION['user']['role']=='Cliente'){
                header('Location: ../cliente.php');
                exit;
            }else{
            header('Location: ../index.php?error_message= Usuario o clave incorrectas!');
            exit;
            }
        }else {
            header('Location: ../index.php?error_message= Usuario o clave incorrectas!');
            exit;
        }
    }else{
        header('Location: ../index.php?error_message=Ingrese los datos!');
    }
}else{
    header('Location: ../index.php');
}
?>