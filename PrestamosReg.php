<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crai.informaticapp.com/circulacion',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 
                'id_estudiante='.$_POST["id_estudiante"].
                '&id_lib='.$_POST["id_lib"].
                '&fecha_adq='.$_POST["fecha_adq"].
                '&fecha_dev='.$_POST["fecha_dev"].
                '&estado_libro='.$_POST["estado_libro"],
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic YTJhYTA3YWRmaGRmcmV4ZmhnZGZoZGZlcnR0Z2VPbUt6dlQ2ajJ6aGsvbVZkbnpvd1BSMk5KRlJSa0txOm8yYW8wN29kZmhkZnJleGZoZ2RmaGRmZXJ0dGdlTjN4OW82Mk1xVFpTVURtdGV5SmxXVkQ0NVJUQ3NZQw=='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        header("Location: Prestamos.php");
        
    }else{
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crai.informaticapp.com/estudiantes',
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
        curl_close($curl);
        $est = json_decode($response, true);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crai.informaticapp.com/libros',
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

        curl_close($curl);
        $libros = json_decode($response, true);
    }
?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="./dist/img/upeuLogo.png">
        <title>Registro de Préstamos | CRAI-Tarapoto</title>
        <?php require "./resource/head.php"; ?>
    </head>
    <body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed ">
        <div class="wrapper">

            <?php
                require './resource/nav.php';
                require './resource/aside.php';
            ?> 
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Registro de Préstamos</h1>
                            </div>
                           
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Registro de Préstamos</li>
                                </ol>
                            </div>                        
                        </div>
                    </div>
                </div>         

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary card-outline">
                                    <h3 class="text-center mt-4">Nuevo registro</h3>
                                    <div class="container">
                                        <form method="post" class="col-xl-8 offset-2">
                                            <div class="form-group">
                                                <label for="id_lib">Libro:</label>
                                                <select name="id_lib" class="form-control" id="id_lib">
                                                    <?php foreach ($libros["Detalles"] as $lib): ?>
                                                        <option value="<?= $lib["idlibros"] ?>"><?= $lib["titulo"] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="id_estudiante">Estudiante:</label>
                                                <select name="id_estudiante" class="form-control" id="id_estudiante">
                                                    <?php foreach ($est["Detalles"] as $estu): ?>
                                                        <option value="<?= $estu["idestudiante"] ?>"><?= $estu["nombres"] ?> <?= $estu["apellidos"] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="fecha_adq">Fecha de adquisición:</label>
                                                <input type="date" name="fecha_adq" class="form-control" id="fecha_adq" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="fecha_dev">Fecha de devolución:</label>
                                                <input type="date" name="fecha_dev" class="form-control" id="fecha_dev" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="estado_libro">Estado del libro:</label>
                                                <select name="estado_libro" class="form-control" id="estado_libro">
                                                    <option value="1">Disponible</option>
                                                    <option value="2">No disponible</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                                            <a href="Prestamos.php" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</a>
                                        </form>
                                    </div>
                                    <div class="mb-4"></div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </section> 

            </div>
            <?php require './resource/footer.php'; ?>

        </div>
        <?php require './resource/script.php'; ?>
    </body>
  
</html>

