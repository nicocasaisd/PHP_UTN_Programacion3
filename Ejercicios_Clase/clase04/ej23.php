
<?php

/* 
Aplicación Nº 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato con la
fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/.

CASAIS DASSIE, NICOLÁS

*/

use Usuario as GlobalUsuario;

class Usuario
{
    public int $id;
    public DateTime $fecha_de_registro;
    public string $nombre;
    public string $clave;
    public string $mail;

    public function __construct($nombre, $clave, $mail)
    {
        $this->id = rand(1, 10000);
        $this->fecha_de_registro = new DateTime();
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
        $archivo = fopen("./usuarios.json", "a");
        if (fputs($archivo, json_encode($usuario) . PHP_EOL) > 0) {
            echo "Se agrego el usuario. <br/>";
        }
    }

    public static function LeerDeJson(string $path)
    {
        $array_de_usuarios = [];

        $archivo = fopen($path, "r");

        /* while (!feof($archivo)) {
            $line = fgets($archivo);
            if ($line != null) {
                array_push($array_de_usuarios, json_decode($line));
            }
        } */



        return $array_de_usuarios;
    }
}



switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (!empty($_GET)) {
            //var_dump($_GET);
            switch ($_GET['lista']) {
                case 'usuarios':
                    //echo "usuarios";
                    //$array_de_usuarios = Usuario::LeerDeJson('./usuarios.json');
                    $array_de_usuarios = json_decode(file_get_contents('./usuarios.json'));
                    var_dump($array_de_usuarios);
                    
                    //echo $array_de_usuarios->fecha_de_registro;

                    $date = new DateTime($array_de_usuarios->fecha_de_registro->date);
                    echo $date->format('d/m/Y');





                    break;
            }
        }
        break;
    case 'POST':

        if (!empty($_POST)) {
            // var_dump($_POST);
            // var_dump($_FILES);
            if (
                isset($_POST['nombre']) && !empty($_POST['nombre']) &&
                isset($_POST['clave']) && !empty($_POST['clave']) &&
                isset($_POST['mail']) && !empty($_POST['mail'])
            ) {

                $usuario = new Usuario($_POST["nombre"], $_POST["clave"], $_POST["mail"]);
                Usuario::Alta($usuario);
            }
            // Guardamos imagen
            if (!empty($_FILES)) {
                echo "Se recibio una foto de perfil " . PHP_EOL;
                echo $_FILES['perfil']['tmp_name'] . PHP_EOL;

                //$archivo = fopen('./foto.jpeg', 'w');

                if (!is_dir('./Usuario/Fotos')) {
                    mkdir('./Usuario/Fotos', 0777, true);
                }
                move_uploaded_file($_FILES['perfil']['tmp_name'], './Usuario/Fotos/perfil' . $usuario->id . '.jpg');
                echo "<h3> FILES </h3>";
                var_dump($_FILES);
            }
        }

        break;
}
