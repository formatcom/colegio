<?php
	require_once("funciones/php/mysqli.php");
	$instancia = new jsonPhp();
?>


Agregar estudiante

<form action="funciones/php/consultas.php">

	<select name="grado">

<?php $instancia->estudianteGrado(); ?>

	</select><br/>
	<input type="hidden" name="consulta" value="1" />
	<input name="nombre" placeholder="Nombre" /><br/>
	<input name="apellido" placeholder="Apellido" /><br/>
	<input name="ci" placeholder="Cedula" /><br/>
	<input type="submit" />

</form>


<?php $instancia->cerrar(); ?>