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
   
<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  
  <br><br>

  E-mail: <input type="text" name="email">

  

    <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>


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

//leer datos
   $ch = curl_init();  
   curl_setopt($ch, CURLOPT_URL, "localhost:8080/demo/all");  
   curl_setopt($ch, CURLOPT_HEADER, false);  
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
   json_decode(('localhost:8080/demo/all'), true);  
   $data = curl_exec($ch);  
 
$array = json_decode($data);
 // print_r($array);
 echo $array[0]->name;

for($i=0;$i<count($array);$i++){ 

	$id=$array[$i]->id;
    $name = $array[$i]->name;
    $email = $array[$i]->email;
   // echo $id;
   // echo $name;
   // echo $email;
 

echo"<html>";
echo"   <head>";
echo"      <link href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css' rel='stylesheet'>";
echo"   </head>";
echo"   <body>";



echo "<table id='lookup' class='table table-bordered table-hover'>  ";
echo "	 <thead bgcolor='#eeeeee' align='center'> ";                
                                echo "        <tr>";
	  
                                 echo "       <th>id</th>";
	                              echo "      <th>name </th>";
	                              echo "      <th>email </th>";

	                              echo " </tr>";
                                  echo "   </thead>";



echo "<tr>"; 
echo " <td>$id</td>";
echo " <td>$name</td>";
echo " <td>$email</td>";

 
echo "</tr>";
echo "</table>";







echo"      <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js'></script>";
echo"   </body>";
echo"</html>";










}




  curl_close($ch);



//grabar datos
 $postData = array( 
   "name"=>$_POST["name"],
   "email"=>$_POST["email"]

   
  );  
  $ch = curl_init();  
  curl_setopt($ch, CURLOPT_URL, "localhost:8080/demo/add");  
  curl_setopt($ch, CURLOPT_HEADER, false);  
  curl_setopt($ch, CURLOPT_POST, true);  
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
  $data = curl_exec($ch);  
  print_r($data);  
  curl_close($ch);  





//Borrar datos

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



  ?>
</body>
</html>