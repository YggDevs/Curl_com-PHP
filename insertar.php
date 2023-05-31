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

        <input type="submit" name="submit" value="Insertar" class="btn btn-primary">  
      </form>
    </div>
  </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Grabar datos
  $postData = array(
    "name" => $_POST["name"],
    "email" => $_POST["email"]
  );

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/demo/add");
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $data = curl_exec($ch);
  curl_close($ch);

  echo "Insertado";
}
?>
</body>
</html>
