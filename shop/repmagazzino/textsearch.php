<?php

require_once("prodotto.php");
require_once("gestionale.php");

$k = 0;
$textsearch = $_GET['textsearch'];
$textsearch = ucfirst($textsearch);
$array2 = Gestionale::estrai_tutti();
$array = [];

for($i = 0;$i<count($array2);$i++){
    if(strchr($array2[$i]->nome,  $textsearch)){
        $array[$k] = $array2[$i];
        $k ++;
    }
}

?>
    
    <table>
        <thead>
            <tr>
                <th> Nome </th>
                <th> </th>
                <th> Marca </th>
                <th> </th>
                <th> Modello </th>
                <th> </th>
                <th> Numero Seriale </th>
                <th> </th>
                <th> Quantità </th>   
            </tr>
        </thead>
        <tbody>
    
<?php
    for($i = 0; $i < count($array);$i++){

        $objsmtv = $array[$i];
    
        echo"
            <td> $objsmtv->nome</td>
            <td> | </td>
            <td> $objsmtv->marca</td>
            <td> | </td>
            <td> $objsmtv->modello</td>
            <td> | </td>
            <td> $objsmtv->numero_seriale</td>
            <td> | </td>
            <td> $objsmtv->quantità</td>
            <tr>
            "; 

    }

?>

</table><br><br>




