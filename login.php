    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <?php
        $inputNombres = isset($_POST['nombres']) ? $_POST['nombres'] : '';
        $inputApellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';

        // Verificar si se enviaron datos de inicio de sesión
        if (!empty($inputNombres) && !empty($inputApellidos)) {
        // Realizar la solicitud a la API para obtener los datos registrados
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crai.informaticapp.com/superadmin',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
            'Authorization: Basic YTJhYTA3YWRmaGRmcmV4ZmhnZGZoZGZlcnR0Z2VPbUt6dlQ2ajJ6aGsvbVZkbnpvd1BSMk5KRlJSa0txOm8yYW8wN29kZmhkZnJleGZoZ2RmaGRmZXJ0dGdlTjN4OW82Mk1xVFpTVURtdGV5SmxXVkQ0NVJUQ3NZQw=='
            ),
        ));

        $response = curl_exec($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($statusCode === 200) {
            $data = json_decode($response, true);

            // Verificar si los datos ingresados coinciden con los registrados en la respuesta
            $encontrado = false;

            foreach ($data as $dataItem) {
            $nombresRegistrados = isset($dataItem['nombres']) ? $dataItem['nombres'] : '';
            $apellidosRegistrados = isset($dataItem['apellidos']) ? $dataItem['apellidos'] : '';

            // Comparar los datos ingresados con los registrados
            if ($inputNombres === $nombresRegistrados && $inputApellidos === $apellidosRegistrados) {
                $encontrado = true;
                break;
            }
            }

            if ($encontrado) {
            // Los datos ingresados coinciden con los registrados
            // Redireccionar a la página principal
            header("Location: http://localhost/crai_zlg/");
            exit();
            } else {
            // Los datos ingresados no coinciden con los registrados
            echo '<h2>Login</h2>';
            echo '<form action="" method="post">';
            echo    '<div class="form-group">';
            echo        '<label for="nombres">Nombres</label>';
            echo        '<input type="text" name="nombres" id="nombres" placeholder="Ingrese sus nombres" required>';
            echo    '</div>';

            echo    '<div class="form-group">';
            echo        '<label for="apellidos">Apellidos</label>';
            echo        '<input type="text" name="apellidos" id="apellidos" placeholder="Ingrese sus apellidos" required>';
            echo    '</div>';

            echo    '<div class="form-group" style="text-align: center">';
            echo        'Los datos no coinciden. Verifica la información ingresada.';
            echo        '<br>'; // Agrega un espacio entre el mensaje y el botón
            echo    '</div>';

            echo    '<div class="form-group">';
            echo        '<input type="submit" value="Iniciar sesión">';
            echo    '</div>';

            echo    '<div class="form-group">';
            echo        '<a href="loginReg.php" class="register-link">¿No tienes una cuenta? Regístrate aquí</a>';
            echo    '</div>';
            echo '</form>';
            }
        } else {
            // Error al realizar la solicitud a la API
            echo 'Error al obtener los datos registrados.';
        }
        } else {
        // Formulario de inicio de sesión
            echo '<h2>Login</h2>';
            echo '<form action="" method="post">';
            echo    '<div class="form-group">';
            echo        '<label for="nombres">Nombres</label>';
            echo        '<input type="text" name="nombres" id="nombres" placeholder="Ingrese sus nombres" required>';
            echo    '</div>';

            echo    '<div class="form-group">';
            echo        '<label for="apellidos">Apellidos</label>';
            echo        '<input type="text" name="apellidos" id="apellidos" placeholder="Ingrese sus apellidos" required>';
            echo    '</div>';

            echo    '<div class="form-group">';
            echo        '<input type="submit" value="Iniciar sesión">';
            echo    '</div>';

            echo    '<div class="form-group">';
            echo        '<a href="loginReg.php" class="register-link">¿No tienes una cuenta? Regístrate aquí</a>';
            echo    '</div>';
            echo '</form>';
        }
        ?>
    </div>
    </body>
    </html>
