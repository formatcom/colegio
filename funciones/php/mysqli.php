<?php

class jsonPhp{

	private $mysqli;

	public function __construct() {
		$this->mysqli = new mysqli("localhost","root","","colegio");

		/* verificar la conexión */
		if (mysqli_connect_errno()) {
    		printf("Conexión fallida: %s\n", mysqli_connect_error());
    		exit();
		}
	}

	public function maestroGrado(){
		$query = "SELECT * FROM grados WHERE id NOT IN (SELECT id_grado FROM maestros)";
		if ($result = $this->mysqli->query($query)) {
	    	/* obtener array asociativo */
		    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
	    	    print "\t\t<option value=\"".$row[0]."\">".$row[1]."</option> \n";
	    	}
	    	$result->free();
		}
	}

	public function estudianteGrado(){
		$query = "SELECT * FROM grados";
		if ($result = $this->mysqli->query($query)) {
	    	/* obtener array asociativo */
		    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
	    	    print "\t\t<option value=\"".$row[0]."\">".$row[1]."</option> \n";
	    	}
	    	$result->free();
		}
	}

	public function maestros(){
		$query = "SELECT * FROM maestros";
		if ($result = $this->mysqli->query($query)) {
	    	/* obtener array asociativo */
		    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
	    	    print "\t\t<option value=\"".$row[0]."|".$row[1]."\">".$row[3]." ".$row[2]."</option> \n";
	    	}
	    	$result->free();
		}
	}

	public function materias($grado){
		$query = "SELECT * FROM materias WHERE id_grado = '$grado'";
		if ($result = $this->mysqli->query($query)) {
	    	/* obtener array asociativo */
	    	$json = [];
		    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
	    	    $json[] = "<option value=\"".$row[0]."\">".$row[2]."</option>";
	    	}
	    	$result->free();
	    	return json_encode($json);
		}
	}

	public function estudiantes($grado, $materia){
		$query  = "SELECT a.id, a.apellido, a.nombre, SUM(b.peso) '%' ";
		$query .= "FROM estudiantes a LEFT JOIN notas b ON a.id = b.id_estudiante ";
		$query .= "AND b.id_materia = '$materia' WHERE a.id_grado = '$grado' GROUP BY a.id";
		if ($result = $this->mysqli->query($query)) {
	    	/* obtener array asociativo */
	    	$json = [];
		    while ($row = $result->fetch_array(MYSQLI_BOTH)) {
		    	if (!isset($row[3]))	$row[3] = 0;
	    	    $json[] = "<option value=\"".$row[0]."\">".$row[1]." ".$row[2]." ".$row[3]."%</option>";
	    	}
	    	$result->free();
	    	return json_encode($json);
		}
	}

	public function addMaestro($grado, $nombre, $apellido, $ci){
		$query = "INSERT INTO maestros (id_grado, nombre, apellido, ci) VALUES ('$grado','$nombre','$apellido','$ci')";
		if ($this->mysqli->query($query)) {
		}else return 1;
	}

	public function addEstudiante($grado, $nombre, $apellido, $ci){
		$query = "INSERT INTO estudiantes (id_grado, nombre, apellido, ci) VALUES ('$grado','$nombre','$apellido','$ci')";
		if ($this->mysqli->query($query)) {
		}else return 1;
	}

	public function cerrar(){
		$this->mysqli->close();
	}
}
?>
