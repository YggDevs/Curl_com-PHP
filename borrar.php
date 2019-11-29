<html>
<title>index.html</title>
<head>
  <title>App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Consume spring boot </h1>
  <p>Pagina responsive hecha con PHP Curl </p> 
</div>
  

</div>

<div class="container">


<form action="/insertar.php">
<div class="row">
 <div class="col-sm-6" >
  <button  type="submit" class="btn btn-primary">Insertar</button>
 </div>
 
</form>

<form action="/borrar.php">

 
    <div class="col-sm-6">
  <button type="submit" class="btn btn-primary">Borrar</button>
 </div>


</form>

<form action="/vertablas.php">

 
    <div class="col-sm-6">
  <button type="submit" class="btn btn-primary">Ver tablas</button>
 </div>


</form>

</div>


 
<div class="container">
  <h2>Panel de control</h2>
</div>




<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Insertar</h3>
   
</div>

<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<div class="col-sm-4">
      <h3>Borrar</h3>
 
   BORRAR_POR_ID: <input type="text" name="id">

    <br><br>
  <input type="submit" name="enviar" value="enviar">  
</form>
    </div>
   </div>


<?php
error_reporting(0);


//Borrar datos
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$ID = $_POST["id"];
$ruta = "localhost:8080/demo/delete/";

$nuevoStr = $ruta. $ID;


   $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $nuevoStr); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
    curl_setopt($ch, CURLOPT_FAILONERROR, true);                                                                                                                    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
     $data = curl_exec($ch);  
      print_r($nuevoStr); 
      curl_close($ch);  

}

  ?>
</body>
</html>