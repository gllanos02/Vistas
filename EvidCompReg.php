<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crai.informaticapp.com/evidencia_compra',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 
                'nombre='.$_POST["nombre"].
                '&id_prov='.$_POST["proveedor"].
                '&fecha='.$_POST["fecha"].
                '&evi='.$_POST["evi"],
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic YTJhYTA3YWRmaGRmcmV4ZmhnZGZoZGZlcnR0Z2VPbUt6dlQ2ajJ6aGsvbVZkbnpvd1BSMk5KRlJSa0txOm8yYW8wN29kZmhkZnJleGZoZ2RmaGRmZXJ0dGdlTjN4OW82Mk1xVFpTVURtdGV5SmxXVkQ0NVJUQ3NZQw=='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        header("Location: evidcomp.php");
        //var_dump($data); die;
        
    }else{
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crai.informaticapp.com/proveedores',
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
        $proveedores = json_decode($response, true);
        //var_dump($proveedores); die;
    }
?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="./dist/img/upeuLogo.png">
        <title>Registro de Compra | CRAI-Tarapoto</title>
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
                                <h1 class="m-0">Registro de Compra</h1>
                            </div>
                           
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Registro de Compra</li>
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
                                                <label for="nombre">Descripción:</label>
                                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingrese la descripción" />
                                            </div>

                                            <div class="form-group">
                                                <label for="proveedor">Proveedor:</label>
                                                <select name="proveedor" class="form-control" id="proveedor">
                                                    <?php foreach ($proveedores["Detalles"] as $prov): ?>
                                                        <option value="<?= $prov["idproveedor"] ?>"><?= $prov["razon_social"] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="fecha">Fecha:</label>
                                                <input type="date" name="fecha" class="form-control" id="fecha" placeholder="Ingrese la fecha" />
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="evi">N° Comprobante:</label>
                                                <input type="text" name="evi" class="form-control" id="evi" placeholder="Ingrese el número de comprobante" />
                                            </div>

                                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                                            <a href="EvidComp.php" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</a>
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
