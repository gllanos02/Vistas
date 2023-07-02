<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://crai.informaticapp.com/evidencia_compra',
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
$data = json_decode($response, true);

?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="./dist/img/upeuLogo.png">
        <title>Evidencia de compras | CRAI-Tarapoto</title>
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
                                <h1 class="m-0">Evidencia de compras</h1>
                            </div>
                           
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Evidencia de compras</li>
                                </ol>
                            </div>                        
                        </div>
                    </div>
                </div>        

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <a href="EvidCompreg.php" class="btn btn-primary">Registrar</a>                     
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">

                                        <div class="container col-xl-12">
                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col" style="text-align: center">#</th>
                                                        <th scope="col" style="text-align: center">Descripción</th>
                                                        <th scope="col" style="text-align: center">Proveedor</th>
                                                        <th scope="col" style="text-align: center">Fecha</th>
                                                        <th scope="col" style="text-align: center">N° Compobante</th>
                                                        <th scope="col" style="text-align: center">Estado</th>
                                                        <th scope="col" style="text-align: center" colspan="2">Operaciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($data["Detalles"] as $comp): ?>
                                                    <tr> 
                                                        <td style="text-align: center"> <?= $comp['idevidencia']?> </td> 
                                                        <td> <?= $comp['nombre']?> </td>
                                                        <td> <?= $comp['razon_social']?> </td>
                                                        <td style="text-align: center"> <?= $comp['fecha']?> </td>
                                                        <td> <?= $comp['evi']?> </td>
                                                        <td style="text-align: center">
                                                            <?= $comp["estado_aceptado"] == 1 ? '<span class="text-center badge badge-success">Activado</span>' : '<span class="text-center badge badge-danger">Desactivado</span>' ?>
                                                        </td>
                                                        <td style="text-align: center"><a href="EvidCompEdit.php?idevidencia=<?= $comp['idevidencia'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                                                        <td style="text-align: center"><a href="EvidCompElim.php?idevidencia=<?= $comp['idevidencia'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                                                    </tr>
                                                    <?php endforeach?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>         
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