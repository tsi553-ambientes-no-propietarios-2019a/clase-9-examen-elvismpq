<?php
session_start();
if(empty($_SESSION)){
    header('Location: index.php');
    exit;
}else{
    $iduser=$_SESSION['user']['id'];
}
$conn= new mysqli('localhost','root','12345','examenb1');
$sql="select * from product";
    $res=$conn->query($sql);
    if($conn->error){
        header('Location: admin.php?error_message=Ocurrió un error: '.$conn->error);
        exit;
    }
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
    <title>Cliente</title>
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
    <?php if ($res->num_rows> 0 ) {
        while($row=$res->fetch_assoc()) {?>
    Producto: <select name="product" >
    <option value="<?php print_r($row['product'])?>"><?php print_r($row['product'])?></option>
    <?php
        }
}else 


  ?>
  </select>
    Cantidad:<input type="number" name="price"><br>
    <input type="submit" value="Registrar">
    </form>