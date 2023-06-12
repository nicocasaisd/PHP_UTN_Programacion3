<?php
/* 
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
los métodos.
*/

include "./Garage.php";

echo '<h3>  Crear Autos y Garage  </h3>';

$auto1 = new Auto('CELTA', 'Gris', 10000, new DateTime());
$auto2 = new Auto('KA', 'Azul', 8000, new DateTime());
$auto3 = new Auto('FOCUS', 'Azul', 5000, new DateTime());

$garage1 = new Garage("Garage Motors", 100);

$garage1->Add($auto2);
$garage1->Add($auto2);
$garage1->Add($auto3); 
$garage1->Add($auto1); 



// EQUALS

echo '<h3> Test funcion Equals  </h3>';

if ($garage1->Equals($auto1)) {
    echo "El auto existe en el garage";
} else {
    echo "El auto NO existe en el garage";
}

// REMOVE

echo '<h3> Test funcion Remove  </h3>';
$garage1->Remove($auto2);

// MOSTRAR
echo '<h3> Mostrar Garage  </h3>';
$garage1->MostrarGarage();