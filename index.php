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

<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h3>Insertar</h3>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <!-- Name input -->
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" id="name">
        </div>

        <!-- Email input -->
        <div class="form-group">
          <label for="email">E-mail:</label>
          <input type="text" class="form-control" name="email" id="email">
        </div>

        <input type="submit" name="submit" value="Submit" class="btn btn-primary">  
      </form>
    </div>

    <div class="col-sm-4">
      <h3>Borrar</h3>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <!-- ID input -->
        <div class="form-group">
          <label for="id">BORRAR_POR_ID:</label>
          <input type="text" class="form-control" name="id" id="id">
        </div>

        <input type="submit" name="enviar" value="enviar" class="btn btn-primary">  
      </form>
    </div>
  </div>
</div>

<?php
// Leer datos
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/demo/all"); // Specify the correct URL
curl_setopt($ch, CURLOPT_HEADER, false);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$data = curl_exec($ch);  
$array = json_decode($data);

// Display data in table
echo "<table class='table table-bordered table-hover'>";  
echo "<thead class='bg-light'>";                
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

curl_close($ch);

// Grabar datos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (isset($_POST["submit"])) {
    $postData = array(
      "name" => $_POST["name"],
      "email" => $_POST["email"]
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/demo/add"); // Specify the correct URL
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    print_r($data);
    curl_close($ch);
  }

  if (isset($_POST["enviar"])) {
    $id = $_POST["id"];
    $url = "http://localhost:8080/demo/delete/$id";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    print_r($data);
    curl_close($ch);
  }
}
?>
</body>
</html>
