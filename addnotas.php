<html>
<head>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="funciones/js/funciones.js"></script>
    <script type="text/javascript" src="funciones/js/addnotas.js"></script>
<?php
	require_once("funciones/php/mysqli.php");
	$instancia = new jsonPhp();
?>

</head>
<body>

Agregar notas

<form action="funciones/php/consultas.php">

	<select name="maestro" id="id_maestro">

<?php $instancia->maestros(); ?>

	</select><input type="button" value="Elegir" id="maestro">
	<input type="hidden" name="consulta" value="4" />
	<div id="ajax">
        <div id="mostrarMaterias"></div>
        <div id="mostrarEstudiantes"></div>
        <div id="mostrarNotas"></div>
    </div>
    <input type="submit" />
</form>


<?php $instancia->cerrar(); ?>

</body>
</html>