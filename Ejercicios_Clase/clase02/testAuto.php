<?php
include './Auto.php';

echo '<h3>  Crear dos objetos “Auto” de la misma marca y distinto color.  </h3>';

$auto1 = new Auto('CELTA', 'Gris', 10000, new DateTime());
$auto2 = new Auto('CELTA', 'Azul', 8000);

echo '<h3>   Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.  </h3>';

$auto3 = new Auto('Clio', 'Gris', 15000, new DateTime());
$auto4 = new Auto('Clio', 'Gris', 7000, new DateTime());

echo '<h3>  Crear un objeto “Auto” utilizando la sobrecarga restante  </h3>';

$auto5 = new Auto('C3', 'Gris');

echo '<h3>  Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.  </h3>';

$auto3->AgregarImpuestos(1500);
$auto4->AgregarImpuestos(1500);
$auto5->AgregarImpuestos(1500);

echo '<h3>Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.</h3>';

echo '<br/> Suma: ' . Auto::Add($auto1, $auto2);

echo '<h3>Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.</h3>';

echo '<br/> Comparacion: ';
echo (string)$auto1->Equals($auto2);
echo '<br/> Comparacion: ';
echo (string)$auto1->Equals($auto5);

echo '<h3> Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5)</h3>';
$arr_autos = array($auto1, $auto2, $auto3, $auto4, $auto5);
foreach($arr_autos as $index=>$auto)
{
    if(($index+1) %2 != 0)
    {
        echo 'Index: ' . $index+1 . '<br>';
        Auto::MostrarAuto($auto);
    }
}
