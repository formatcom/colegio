<?php
	require_once("mysqli.php");
	$instancia = new jsonPhp();


	if (isset($_GET["consulta"])){

		$select = $_GET["consulta"];
		
		switch ($select) {
		    case 0:

		    	if (isset($_GET['grado']) && isset($_GET['nombre']) && 
		    		isset($_GET['apellido']) &&	isset($_GET['ci'])){
					
					$grado = $_GET['grado'];
					$nombre = $_GET['nombre'];
					$apellido = $_GET['apellido'];
					$ci = $_GET['ci'];

					if ($instancia->addMaestro($grado, $nombre, $apellido, $ci) == 1)
						die('Error al agregar los datos');

					echo '<a href="/colegio/index.php">Volver</a>';
				
				}else die('Por favor llenar todos los campos.');

				$instancia->cerrar();
		        break;

		    case 1:

		    	if (isset($_GET['grado']) && isset($_GET['nombre']) && 
		    		isset($_GET['apellido']) &&	isset($_GET['ci'])){
					
					$grado = $_GET['grado'];
					$nombre = $_GET['nombre'];
					$apellido = $_GET['apellido'];
					$ci = $_GET['ci'];

					if ($instancia->addEstudiante($grado, $nombre, $apellido, $ci) == 1)
						die('Error al agregar los datos');

					echo '<a href="/colegio/index.php">Volver</a>';
				
				}else die('Por favor llenar todos los campos.');

				$instancia->cerrar();
		        break;
            
            case 2:
                if (isset($_GET['grado'])){
                	$grado = $_GET['grado'];
                	echo $instancia->materias($grado);
                }
                $instancia->cerrar();
                break;

            case 3:
                if (isset($_GET['grado']) && isset($_GET['materia'])){
                	$grado = $_GET['grado'];
                	$materia = $_GET['materia'];
                	echo $instancia->estudiantes($grado, $materia);
                }
                $instancia->cerrar();
                break;
		}
	}

?>