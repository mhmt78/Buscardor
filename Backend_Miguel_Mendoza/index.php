<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Formulario Buscador</title>
</head>


<body>
  <video src="img/video.mp4" id="vidFondo"></video>

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Buscador</h1>
    </div>
    <div class="colFiltros">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="formulario">

    <?php
		$listaCiudad = array();
		$listaTipo = array();
  		$data = file_get_contents("data-1.json");
		$array = json_decode($data, true);
		
		foreach ($array as $key => $jsons) { 
			foreach($jsons as $key => $value) {
				if($key == 'Id'){
					$id = $value; 
				}
				if($key == 'Direccion'){
					$direccion = $value;
				}
				if($key == 'Ciudad'){
					$ciudad = $value;
					if (!in_array($ciudad, $listaCiudad)) {
					  array_push($listaCiudad, $ciudad); 
					}
				}
				if($key == 'Telefono'){
					$telefono = $value;
				}
				if($key == 'Codigo_Postal'){
					$codigo_postal = $value;
				}
				if($key == 'Tipo'){
					$tipo = $value;
					if (!in_array($tipo, $listaTipo)) {
					  array_push($listaTipo, $tipo);
					}
				}
				if($key == 'Precio'){
					$precio = $value;
				}
		   	}
		}
	?>

        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Realiza una búsqueda personalizada</h5>
          </div>
          
          <div class="filtroCiudad input-field">
            <label for="selectCiudad">Ciudad:</label>
            <select name="verciudad" id="selectCiudad">//se crea un select para seleccionar la ciudad
            <option value="" selected>Elige una ciudad</option>
			
			<?php
				foreach($listaCiudad as $key => $value) {
            ?>
              <option value="<?php echo $value; ?>" <?=($value == $value)?>> <?php echo $value; ?> </option>//se introduce el nombre de cada ciudad
            
			<?php  
              }
            ?>
			
            </select>
          </div>
          <div class="filtroTipo input-field">
            <label for="selecTipo">Tipo:</label><br>
            <select name="vertipo" id="selectTipo">
              <option value="" selected>Elige un tipo</option>
            
			<?php
				foreach($listaTipo as $key => $value) {
            ?>
				<option value="<?php echo $value; ?>" <?=($value == $value)?>> <?php echo $value; ?> </option>
            
			<?php  
              }
            ?>
          
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="verprecio" value="" />


          </div>
          <div class="botonField">
            <input name="Filtrar" type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
          <div class="botonField">
            <input name="Todos" type="submit" class="btn white" value="Mostrar todos" id="todosButton">
          </div>
        </div>
      </form>
    </div>

    <div class="colContenido">
      <div class="tituloContenido card">
        <h5>Resultados de la búsqueda:</h5>
        <div class="divider"></div>
   
    
    </div> 

   
<?php
	if(isset($_POST['Filtrar']))
	{
		$selectCiudad = $_POST['verciudad']; 
		$selectTipo = $_POST['vertipo'];  
		$selectPrecio = $_POST['verprecio'];  
		$separarcantidad = strripos($selectPrecio, ';'); 
	  
		$minimo = substr($selectPrecio, 0, ($separarcantidad));
		$maximo = substr($selectPrecio, ($separarcantidad+1), 5);
	  
		foreach ($array as $key => $jsons) { 
			foreach($jsons as $key => $value) {
				if($key == 'Id'){
					$id = $value;
				}
				if($key == 'Direccion'){
					$direccion = $value;
				}
				if($key == 'Ciudad'){
					$ciudad = $value;
				}
				if($key == 'Telefono'){
					$telefono = $value;
				}
				if($key == 'Codigo_Postal'){
					$codigo_postal = $value;
				}
				if($key == 'Tipo'){
					$tipo = $value;
				}
				if($key == 'Precio'){
					$precio = substr($value,1,12);
				}   
			}
	   
		
			if(trim($selectTipo)<>'' and trim($selectCiudad)<>'')
			{
				if(trim($selectCiudad) == trim($ciudad) and trim($selectTipo) == trim($tipo) and ($precio >= $minimo and $precio <=$maximo))
				{
					echo "<div class='tituloContenido card'>";
					echo "<div class='itemMostrado'>";
					echo "<img src = 'img/home.jpg' height=85% width=85%>";
					echo "Dirección:  $direccion <br>";
					echo "Ciudad: $ciudad <br>";
					echo "Teléfono: $telefono <br>";
					echo "Còdigo Postal: $codigo_postal <br>";
					echo "Tipo: $tipo <br>";
					echo "Precio: $precio <br>";
					echo "</div>";
					echo "</div>";
				}
			}
		
			if(trim($selectCiudad)=='' and trim($selectTipo)=='')
			{
				if($precio >= $minimo and $precio <=$maximo)
				{
					echo "<div class='tituloContenido card'>";
					echo "<div class='itemMostrado'>";
					echo "<img src = 'img/home.jpg' height=85% width=85%>";
					echo "Dirección:  $direccion <br>";
					echo "Ciudad: $ciudad <br>";
					echo "Teléfono: $telefono <br>";
					echo "Còdigo Postal: $codigo_postal <br>";
					echo "Tipo: $tipo <br>";
					echo "Precio: $precio <br>";
					echo "</div>";
					echo "</div>";
				}
			}
		
			if(trim($selectTipo)=='')
			{
				if(trim($selectCiudad) == trim($ciudad) and ($precio >= $minimo and $precio <=$maximo))
				{
					echo "<div class='tituloContenido card'>";
					echo "<div class='itemMostrado'>";
					echo "<img src = 'img/home.jpg' height=85% width=85%>";
					echo "Dirección:  $direccion <br>";
					echo "Ciudad: $ciudad <br>";
					echo "Teléfono: $telefono <br>";
					echo "Còdigo Postal: $codigo_postal <br>";
					echo "Tipo: $tipo <br>";
					echo "Precio: $precio <br>";
					echo "</div>";
					echo "</div>";
				}
			}
			
			if(trim($selectCiudad)=='')
			{
				if(trim($selectTipo) == trim($tipo) and ($precio >= $minimo and $precio <=$maximo))
				{
					echo "<div class='tituloContenido card'>";
					echo "<div class='itemMostrado'>";
					echo "<img src = 'img/home.jpg' height=85% width=85%>";
					echo "Dirección:  $direccion <br>";
					echo "Ciudad: $ciudad <br>";
					echo "Teléfono: $telefono <br>";
					echo "Còdigo Postal: $codigo_postal <br>";
					echo "Tipo: $tipo <br>";
					echo "Precio: $precio <br>";
					echo "</div>";
					echo "</div>";
				}
			}
		}
	}
		

	if(isset($_POST['Todos'])) 
	{
		foreach ($array as $key => $jsons) { 
			foreach($jsons as $key => $value) {
				if($key == 'Id'){
					$id = $value;
				}
				if($key == 'Direccion'){
					$direccion = $value;
				}
				if($key == 'Ciudad'){
					$ciudad = $value;
				}
				if($key == 'Telefono'){
					$telefono = $value;
				}
				if($key == 'Codigo_Postal'){
					$codigo_postal = $value;
				}
				if($key == 'Tipo'){
					$tipo = $value;
				}
				if($key == 'Precio'){
					$precio = $value;
				}
			}
		
			echo "<div class='tituloContenido card'>";
			echo "<div class='itemMostrado'>";
			echo "<img src = 'img/home.jpg' height=85% width=85%>";
			echo "Dirección:  $direccion <br>";
			echo "Ciudad: $ciudad <br>";
			echo "Teléfono: $telefono <br>";
			echo "Còdigo Postal: $codigo_postal <br>";
			echo "Tipo: $tipo <br>";
			echo "Precio: $precio <br>";
			echo "</div>";
			echo "</div>";
		}
	}  
?>
     
             
 
  <script type="text/javascript" src="js/jquery-3.0.0.js"></script>
  <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
  
  <script>
    $(document).ready(function() {
      $('select').material_select();
    })
  </script>
  
</body>
</html>
