<?php
/* 
Aplicación Nº 20 BIS (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario
*/

class Usuario
{
    private string $nombre;
    private string $clave;
    private string $mail;

    public function __construct($nombre, $clave, $mail)
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->mail = $mail;
    }

    public function __get($atributo)
    {
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }

    public function ToCsvString()
    {
        return $this->nombre . "," . $this->clave . "," . $this->mail;
    }

    public static function Alta(self $usuario)
    {
        $archivo = fopen("./usuarios.csv", "a");
        if (fputs($archivo, $usuario->ToCsvString() . PHP_EOL) > 0) {
            echo "Se agrego el usuario. <br/>";
        }
    }
}

// Pruebas

/* $usuario1 = new Usuario("Nico", "asd", "nico@nico.com");
$usuario2 = new Usuario("Juli", "asd", "juli@nico.com");
$usuario3 = new Usuario("Aru", "asd", "aru@nico.com");

Usuario::Alta($usuario1);
Usuario::Alta($usuario2);
Usuario::Alta($usuario3);
 */


/* echo "<h3>  POST  </h3>";
var_dump($_POST);

$usuario = new Usuario($_POST["nombre"], $_POST["clave"], $_POST["mail"]);

Usuario::Alta($usuario);

echo "<h3>  GET  </h3>";

 */

//var_dump($_SERVER);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo "Recibi GET";
        break;
    case 'POST':
        echo "Recibi POST" . PHP_EOL;
        if (!empty($_POST)) {
            echo "El post NO esta empty"  . PHP_EOL;
            if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
                echo "El nombre esta definido"  . PHP_EOL;
            }

            if (is_numeric($_POST['edad'])) {

                echo gettype($_POST['edad']) . PHP_EOL ;
                echo "La edad es numerica"  . PHP_EOL;
            }
            // $usuario = new Usuario($_POST["nombre"], $_POST["clave"], $_POST["mail"]);
            // Usuario::Alta($usuario);
        }

        break;
}


echo "<h3>  Fin  </h3>";
