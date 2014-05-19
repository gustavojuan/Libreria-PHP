<?php
function CPRadius($lat, $lon, $radius)
{
    $radius = $radius ? $radius : 20;
    $conn = mysqli_connect('localhost','myusername','mypass','mydb');
    $conn->query("SET NAMES 'utf8'");
    $sql = 'SELECT distinct(poblacion) FROM poblacion  WHERE (3958*3.1415926*sqrt((latitud-'.$lat.')*(latitud-'.$lat.') + cos(latitud/57.29578)*cos('.$lat.'/57.29578)*(longitud-'.$lon.')*(longitud-'.$lon.'))/180) <= '.$radius.';';
    $result = mysqli_query($conn,$sql);

    // get each result
    $cplist = array();
    while($row = mysqli_fetch_array($result))
    {
        array_push($cplist, $row['poblacion']);
    }

    //Preparo el array para procesado posterios
    $separado_por_comas_2 = implode("','", $cplist);

    return $separado_por_comas_2;
    mysqli_free_result($conn);
    mysqli_close($conn);

}