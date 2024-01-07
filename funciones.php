<?php
$arrayDatos=array();

 function cargabicis(){
    
    if (($archivo = fopen("bicicletas.csv", 'r')) !== false) {  
        while (($linea = fgetcsv($archivo)) !== false) {
            $arrayDatos[] = $linea;
        }
    
        fclose($archivo);
    } else {
        $arrayDatos[]= "No se pudo abrir el archivo CSV.";
    }
    
    //echo("<script>console.log('PHP: " . json_encode($arrayDatos) . "');</script>");
    
    return $arrayDatos;
 }

 function cargarbicis2(): array
{
    $fich = @fopen("bicicletas.csv", "r");
    if ($fich == false) {
        die("Error al abrir el fichero");
    }
    $tabla = [];

    while ($valor = fgetcsv($fich)) {
        $bici = new BiciElectrica();
        $bici->id = $valor[0];
        $bici->coordx = $valor[1];
        $bici->coordy = $valor[2];
        $bici->bateria = $valor[3];
        $bici->operativa = $valor[4];
        $tabla[] = $bici;
    }

    return $tabla;
}

 function mostrartablabicis($datos){
    $msg="";
    
        $msg  .=  '<table border="1">';
        $msg  .=  '<tr><th>ID</th><th>Coordenada X</th><th>Coordenada Y</th><th>Batería</th></tr>';

        foreach ($datos as $fila) {
          $msg  .=  '<tr>';
          if (end($fila) == 1) {
                foreach ($fila as $valor) {      
                    if($valor>=4){
                        $msg  .=  '<td>' . $valor . '</td>';} 
                } $msg  .=  '</tr>';
            }
        }
    
        $msg  .=  '</table>';
    return $msg;
 }

function bicimascercana($x, $y,$tabla)
{
    $bicicerca = null;
    $distanciamin = PHP_INT_MAX;
    foreach ($tabla as $bici) {
        if ($bici->operativa == 1) {
            $longitud =  $bici->distancia($x, $y);
            if ($longitud < $distanciamin) {
                $bicicerca = $bici;
                $distanciamin = $longitud;
            }
        }
    }
    return $bicicerca;
}


?>