<?php

class Cupon
{
    public int $id;
    public int $nro_de_pedido;
    public float $descuento;
    public bool $esValido;
    public DateTime $fecha_vencimiento;

    public function __construct($nro_de_pedido, $descuento)
    {
        $this->id = rand(20000, 30000);
        $this->nro_de_pedido = $nro_de_pedido;
        $this->descuento = $descuento;
        $this->esValido = true;
        $this->fecha_vencimiento = $this->GetFechaVencimiento();
    }

    private function GetFechaVencimiento()
    {
        $fecha_vencimiento = new DateTime();
        $intervalo = DateInterval::createFromDateString('3 days');
        $fecha_vencimiento->add($intervalo);

        return $fecha_vencimiento;
    }

    static function ValidarCupon($id)
    {
        $array_cupones = ReadJson('./cupones.json');
        $now = new DateTime();

        foreach ($array_cupones as $cupon) {
            $fecha_vencimiento = new DateTime($cupon->fecha_vencimiento->date);
            if (
                $cupon->id == $id &&
                $cupon->esValido == true &&
                $fecha_vencimiento > $now
            ) {
                return true;
            }
        }

        return false;
    }

    static function AplicarDescuento($id, $importe)
    {
        $array = ReadJson('./cupones.json');

        foreach ($array as $cupon) {
            if (Self::ValidarCupon($id)) {
                $importe -= ($cupon->descuento * $importe) / 100;
                $cupon->esValido = false;
                WriteJson($array, './cupones.json');
                return $importe;
            }
        }

        return $importe;
    }

    static function AddCupon($cupon)
    {
        $array_cupones = ReadJson('./cupones.json');

        array_push($array_cupones, $cupon);
        echo "Se agrego el cupón" . PHP_EOL;

        WriteJson($array_cupones, './cupones.json');
    }
}
