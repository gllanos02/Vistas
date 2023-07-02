<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crai.informaticapp.com/libros/'.$_GET['idlibros'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => 
                'cod_libro='.$_POST["cod_libro"].
                '&cat_libro='.$_POST["cat_libro"].
                '&titulo='.$_POST["titulo"].
                '&autor='.$_POST["autor"].
                '&isbn='.$_POST["isbn"].
                '&paginas='.$_POST["paginas"].
                '&resumen='.$_POST["resumen"].
                '&years_pub='.$_POST["years_pub"].
                '&editorial='.$_POST["editorial"].
                '&codigo_barra='.$_POST["codigo_barra"],
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Basic YTJhYTA3YWRmaGRmcmV4ZmhnZGZoZGZlcnR0Z2VPbUt6dlQ2ajJ6aGsvbVZkbnpvd1BSMk5KRlJSa0txOm8yYW8wN29kZmhkZnJleGZoZ2RmaGRmZXJ0dGdlTjN4OW82Mk1xVFpTVURtdGV5SmxXVkQ0NVJUQ3NZQw=='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        header("Location: Libros.php");
        

    }else{
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crai.informaticapp.com/libros/'.$_GET['idlibros'],
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
        //var_dump($data); die; 

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://crai.informaticapp.com/categorias_libros',
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
        $cat_li = json_decode($response, true);
        
    }  
    
?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="./dist/img/upeuLogo.png">
        <title>Editar Libros | CRAI-Tarapoto</title>
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
                                <h1 class="m-0">Editar Libros</h1>
                            </div>
                           
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Editar Libros</li>
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
                                    <h3 class="text-center mt-4">Editar Libro</h3>
                                    <div class="container">
                                        <form method="post" class="col-xl-8 offset-2">
                                            <input type="hidden" name="idlibros" id="idlibros" value="<?= $data["Detalle"]['idlibros'] ?>">
   
                                            <div class="form-group">
                                                <label for="cod_libro">Código del Libro:</label>
                                                <input type="number" class="form-control" name="cod_libro" id="cod_libro" value="<?= $data["Detalle"]['cod_libro'] ?>">
                                            </div>
        
                                            <div class="form-group">
                                                <label for="cat_libro">Categoría del Libro:</label>
                                                <select name="cat_libro" id="cat_libro" class="form-control" value="<?= $data["Detalles"]["0"]['categoria_id'] ?>">
                                                    <?php foreach($cat_li["Detalles"] as $cat): ?>
                                                    <option value="<?= $cat["categoria_id"] ?>"> <?= $cat["descripcion"];?></option>
                                                    <?php endforeach ?>
                                                </select>     
                                            </div>

                                            <div class="form-group">
                                                <label for="titulo">Título:</label>
                                                <input type="text" class="form-control" name="titulo" id="titulo" value="<?= $data["Detalle"]['titulo'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="autor">Autor:</label>
                                                <input type="text" class="form-control" name="autor" id="autor" value="<?= $data["Detalle"]['autor'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="isbn">ISBN:</label>
                                                <input type="text" class="form-control" name="isbn" id="isbn" value="<?= $data["Detalle"]['isbn'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="paginas">Páginas:</label>
                                                <input type="number" class="form-control" name="paginas" id="paginas" value="<?= $data["Detalle"]['paginas'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="resumen">Resumen:</label>
                                                <textarea name="resumen" id="resumen" class="form-control"><?= $data["Detalle"]['resumen'] ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="years_pub">Año de Publicación:</label>
                                                <input type="number" class="form-control" name="years_pub" id="years_pub" value="<?= $data["Detalle"]['years_pub'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="editorial">Editorial:</label>
                                                <input type="text" class="form-control" name="editorial" id="editorial" value="<?= $data["Detalle"]['editorial'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="codigo_barra">Código de Barras:</label>
                                                <input type="text" class="form-control" name="codigo_barra" id="codigo_barra" value="<?= $data["Detalle"]['codigo_barra'] ?>">
                                            </div>

                                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                                            <a href="Libros.php" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</a>
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