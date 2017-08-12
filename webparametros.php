<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema Préstamos</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">SISTEMA PRÉSTAMOS</a>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
        	<div class="row">
        		<div class="col-sm-3 col-md-2 sidebar" id="sidebar">
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="index.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-home"></span> Principal</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="webcliente.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-user"></span> Clientes</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="webprestamo.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-list-alt"></span> Prestamos</a>
                        </li>
                    </ul>
                    <ul class="nav nav-sidebar">
                        <li>
                            <a href="webparametros.php" class="w3-bar-item w3-button"><span class="glyphicon glyphicon-wrench"></span> Configuración</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                	<h1 class="page-header">Configuración</h1>
                	<form class="form-horizontal" method="POST" action="webparametros2.php">
                		<div class="container" id="panelInfo">
	                		<div class="form-group">
                                <?php
                                    require_once 'Parametro.php';
                                    
                                    $par = new Parametro();
                                    $Parametro = $par->obtener();
                                    $nombre_empresa = '"' . $Parametro[0]->valor . '"';
                                    $correo = '"' . $Parametro[1]->valor . '"';
                                    $telefono = '"' . $Parametro[2]->valor . '"';
                                    $interes = '"' . $Parametro[3]->valor . '"';
                                    $mora = '"' . $Parametro[4]->valor . '"';
                                    $capitalizacion = $Parametro[5]->valor;
                                    $direccion = $Parametro[6]->valor;

                                    if ($capitalizacion == 'M') {
                                        $capitalizacionO = '<label class="radio-inline" for="capitalizacion-m"><input name="capitalizacion" id="capitalizacion-m" value="M" checked="checked" type="radio">Mensual</label><label class="radio-inline" for="capitalizacion-d"><input name="capitalizacion" id="capitalizacion-d" value="D" type="radio">Diaria</label>';
                                    } else {
                                        $capitalizacionO = '<label class="radio-inline" for="capitalizacion-m"><input name="capitalizacion" id="capitalizacion-m" value="M" type="radio">Mensual</label><label class="radio-inline" for="capitalizacion-d"><input name="capitalizacion" id="capitalizacion-d" value="D" checked="checked" type="radio">Diaria</label>';
                                    }
                                ?>
	                			<label class="col-md-4 control-label">Nombre de la empresa</label>
	                			<div class="col-md-4">
	                				<input id="nombre_empresa" name="nombre_empresa" class="form-control input-md" type="text" required value=
                                        <?php
                                        echo $nombre_empresa;
                                        ?>
                                    >
	                			</div>
	                		</div>
	                		<div class="form-group">
	                			<label class="col-md-4 control-label">Correo electrónico</label>
	                			<div class="col-md-4">
	                				<input id="email" name="email" class="form-control input-md" type="email" required value=
                                        <?php
                                        echo $correo;
                                        ?>
                                    >
	                			</div>
	                		</div>

                            <div class="form-group">
                               <label class="col-md-4 control-label">Dirección</label>
                               <div class="col-md-4">
                               <textarea class="form-control input-md" id="direccion" name="direccion">
                                  <?php
                                     echo $direccion;
                                  ?> 
                               </textarea>
                               </div>
                            </div>

	                		<div class="form-group">
	                			<label class="col-md-4 control-label">Teléfono</label>
	                			<div class="col-md-4">
	                				<input id="telefono" name="telefono" class="form-control input-md" type="text" required value=
                                        <?php
                                        echo $telefono;
                                        ?>
                                    >
	                			</div>
	                		</div>
                		</div>
                		<div class="container" id="panelInfo">
                			<div class="form-group">
	                			<label class="col-md-4 control-label">Tasa de interés</label>
	                			<div class="col-md-4">
	                				<input id="tasa_interes" name="tasa_interes" class="form-control input-md" type="number" required min="0" max="100" value=
                                        <?php
                                        echo $interes;
                                        ?>
                                    >
	                			</div>
	                		</div>
	                		<div class="form-group">
	                			<label class="col-md-4 control-label">Interés por mora</label>
	                			<div class="col-md-4">
	                				<input id="interes_mora" name="interes_mora" class="form-control input-md" type="number" required min="0" max="100" value=
                                        <?php
                                        echo $mora;
                                        ?>
                                    >
	                			</div>
	                		</div>
	                		<div class="form-group">
	                			<label class="col-md-4 control-label">Capitalización</label>
	                			<div class="col-md-4">
					               <?php
                                    echo $capitalizacionO;
                                   ?>
					          	</div>
	                		</div>
                		</div>
                		<div class="form-group" align="center">
                			<button id="guardar" name="guardar" class="btn btn-primary" type="submit">Guardar</button>
                		</div>
                	</form>
                </div>
        	</div>
        </div>
	</body>
</html>