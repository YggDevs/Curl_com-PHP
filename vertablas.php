<!DOCTYPE html>
<html>
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
  <h1>Consume Spring Boot</h1>
  <p>Pagina responsive hecha con PHP Curl</p> 
</div>

<div class="container">
  <!-- Insertar Form -->
  <form action="/insertar.php">
    <div class="row">
      <div class="col-sm-6">
        <button type="submit" class="btn btn-primary">Insertar</button>
      </div>
    </div>
  </form>

  <!-- Borrar Form -->
  <form action="/borrar.php">
    <div class="row">
      <div class="col-sm-6">
        <button type="submit" class="btn btn-primary">Borrar</button>
      </div>
    </div>
  </form>

  <!-- Ver tablas Form -->
  <form action="/vertablas.php">
    <div class="row">
      <div class="col-sm-6">
        <button type="submit" class="btn btn-primary">Ver tablas</button>
      </div>
    </div>
  </form>
</div>

<div class="container">
  <h2>Panel de control</h2>
</div>

<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/demo/all");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);

$array = json_decode($data);

// Imprimir tabla con los datos recibidos
echo "<html>";
echo "<head>";
echo "<link href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css' rel='stylesheet'>";
echo "</head>";
echo "<body>";

echo "<table id='lookup' class='table table-bordered table-hover'>";
echo "<thead bgcolor='#eeeeee' align='center'>";
echo "<tr>";
echo "<th>id</th>";
echo "<th>name</th>";
echo "<th>email</th>";
echo "</tr>";
echo "</thead>";

foreach ($array as $item) {
  $id = $item->id;
  $name = $item->name;
  $email = $item->email;

  echo "<tr>";
  echo "<td>$id</td>";
  echo "<td>$name</td>";
  echo "<td>$email</td>";
  echo "</tr>";
}

echo "</table>";

echo "</body>";
echo "</html>";
?>
</body>
</html>
