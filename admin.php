<?php 
session_start();
if(empty($_SESSION)){
    header('Location: index.php');
    exit;
}else{
    $iduser=$_SESSION['user']['id'];
}
$conn= new mysqli('localhost','root','12345','examenb1');
if ($_POST) {
    if(isset($_POST['product']) &&isset($_POST['price'])&& !empty($_POST['product']) && !empty($_POST['price'])){
        $producto=$_POST['product'];
        if (is_numeric( $_POST['price'])) {
            $precio=$_POST['price'];
        }else{
            header('Location: admin.php?error_message=EL precio debe contener valores numericos');
            exit;
        }
        $iduser=$_SESSION['user']['id'];
            
            $sql="insert into product(product,price,iduser) values('$producto','$precio','$iduser')";
            $conn->query($sql);
            if($conn->error){
                header("Location: admin.php?error_message=$conn->error");
                exit;
            }else {
                header('Location: admin.php?successful_message=Prducto registrado exitosamente!');
                exit;
            }
        

    }else {
        header('Location: admin.php?error_message=Por favor,llene todos los datos');
        exit;
    }
}
//separador
    $sql="select * from product where iduser='$iduser'";
    $res=$conn->query($sql);
    if($conn->error){
        header('Location: admin.php?error_message=Ocurrió un error: '.$conn->error);
        exit;
    }
//separador

    if($_GET){
        if (isset($_GET['error_message'])) {
            $error_message=$_GET['error_message'];
        }
    

}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Administrador</title>
</head>
<body>
<div class="container">
<?php
echo 'Bienvenido ';
print_r($_SESSION['user']['name']);?>
<div class="row">
    <div class="col-sm">
    
    </div>
    <div class="col-sm">
    </div>
    <div class="col-sm">
      <a href="fun/cerrarSesion.php">Cerrar Sesión</a>
    </div>
  </div>
    <form  method="post">
    Producto: <input type="text" name="product"><br>
    Precio:<input type="number" name="price"><br>
    <input type="submit" value="Registrar">
    </form>
    <?php

    if (isset($error_message)) {
        echo '<strong>'.$error_message.'</strong>';
        }
        if (isset($successful_message)) {
            echo '<strong>'.$successful_message.'</strong>';
            }?>
    <center><h1>Productos</h1></center>
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Producto</th>
      <th scope="col">Precio</th>
    </tr>
  </thead>
  <tbody>
  <?php if ($res->num_rows> 0 ) {
        while($row=$res->fetch_assoc()) {?>
  <tr>
      <th scope="row"><?php print_r($row['product']);?></th>
      <td><?php print_r($row['price']); ?></td>
    </tr>
  <?php
        }
}else {
    echo 'No hay productos<br>';
    

}
$sql="select * from pedidos,product,user where pedidos.iduser=user.iduser and product.idproduct=pedidos.idproduct and product.iduser='$iduser'";
    $res=$conn->query($sql);
    if($conn->error){
        header('Location: admin.php?error_message=Ocurrió un error: '.$conn->error);
        exit;
    }
  ?>
 
    
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Cliente</th>
      <th scope="col">Producto</th>
      <th scope="col">Cantidad pedida</th>
      <th scope="col">Total a pagar</th>
    </tr>
  </thead>
  <tbody>
  <?php 
        if ($res->num_rows> 0 ) {
        while($row=$res->fetch_assoc()) {?>
  <tr>
      <th scope="row"><?php print_r($row['username']);?></th>
      <td><?php print_r($row['product']); ?></td>
      <td><?php print_r($row['cant']); ?></td>
      <td><?php print_r($row['total']); ?></td>
    </tr>
  <?php
        }
}else {
    echo 'No hay productos<br>';
    

}

  ?>
    
</table>

</div>
</body>
</html>