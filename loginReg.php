<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crai.informaticapp.com/superadmin',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 
                'nombres='.$_POST["nombres"].
                '&apellidos='.$_POST["apellidos"].
                '&email='.$_POST["email"].
                '&telefono='.$_POST["telefono"].
                '&direccion='.$_POST["direccion"],
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic YTJhYTA3YWRmaGRmcmV4ZmhnZGZoZGZlcnR0Z2VPbUt6dlQ2ajJ6aGsvbVZkbnpvd1BSMk5KRlJSa0txOm8yYW8wN29kZmhkZnJleGZoZ2RmaGRmZXJ0dGdlTjN4OW82Mk1xVFpTVURtdGV5SmxXVkQ0NVJUQ3NZQw=='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      width: 400px; /* Ajusta el ancho del contenedor según tus necesidades */
      margin: 0 20px; /* Margen de separación igual en ambos lados */
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    .form-group input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-group input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      cursor: pointer;
    }

    .form-group .register-link {
      display: block;
      margin-top: 10px;
      text-align: center;
    }
    
  </style>
</head>
<body>
  <div class="container">
    <h2>Registro</h2>
    <form action="" method="post">
      <div class="form-group">
        <label for="nombres">Nombres</label>
        <input type="text" name="nombres" id="nombres" placeholder="Ingrese sus nombres" required>
      </div>

      <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos" placeholder="Ingrese sus apellidos" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Ingrese su email" required>
      </div>

      <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="tel" name="telefono" id="telefono" placeholder="Ingrese su n° de teléfono" required>
      </div>

      <div class="form-group">
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" placeholder="Ingrese su dirección" required>
      </div>

      <div class="form-group">
        <input type="submit" value="Registrarse">
      </div>

      <div class="form-group">
        <a class="register-link" href="login.php">Volver al inicio de sesión</a>
      </div>
    </form>
  </div>
</body>
</html>
