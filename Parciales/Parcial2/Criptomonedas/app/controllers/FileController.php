<?php

use Fpdf\Fpdf;

class FileController
{
    public static function SaveImage($file, $dirPath, $filename)
    {
        if (!empty($file)) {
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            }
            $newPath = $dirPath . '/' . $filename . '.jpg';
            $file['image']->moveTo($newPath);

            return $newPath;
        }
    }

    function comparator($object1, $object2)
    {
        return $object1->id > $object2->id;
    }

    public function CreatePdf($request, $response, $args)
    {
        $parametros = $request->getQueryParams();

        $list = Sale::getAll();

        //Ordenamiento 
        if (isset($parametros['asc'])) {
            $asc = $parametros['asc'];
            if ($asc == '1') {
                usort($list, function ($object1, $object2) {
                    return $object1->quantity - $object2->quantity;
                });
            } elseif ($asc == '-1') {
                usort($list, function ($object1, $object2) {
                    return $object2->quantity - $object1->quantity;
                });
            }
        }

        // Ventas del mes
        $listByMonth = [];
        $fecha_inicio = DateTime::createFromFormat('Y-m-d', date('Y-m-01'));
        $fecha_final = DateTime::createFromFormat('Y-m-d', date('Y-m-t'));
        // $fecha_inicio = date('Y-m-01');
        // $fecha_final = date('Y-m-t');

        // var_dump($fecha_inicio);
        // var_dump($fecha_final);


        foreach ($list as $sale) {

            $dateTime = DateTimeController::MySQLToDateTime($sale->dateTimeString);
            if (
                $dateTime >= $fecha_inicio
                &&  $dateTime <= $fecha_final
            ) {
                array_push($listByMonth, $sale);
            }
        }

        // Creamos el pdf
        $pdf = new Fpdf();

        $pdf->AddPage();
        //Añadimos tipo de letra
        $pdf->SetFont('Arial', 'BU', 16);

        // Añadimos titulo
        $pdf->Cell(15, 15, 'Listado de Ventas');
        $pdf->Ln();

        // Header
        $pdf->SetFont('Arial', 'B', 12);


        $pdf->Cell(15, 10, 'ID', 0, 0, 'L');
        $pdf->Cell(60, 10, 'DATETIME', 0, 0, 'L');
        $pdf->Cell(30, 10, 'ID COIN', 0, 0, 'L');
        $pdf->Cell(30, 10, 'ID USER', 0, 0, 'L');
        $pdf->Cell(30, 10, 'QUANTITY', 0, 0, 'L');
        $pdf->Cell(30, 10, 'SUBTOTAL', 0, 0, 'L');
        $pdf->Ln();


        // Contenido
        $pdf->SetFont('Arial', '', 12);

        // foreach ($list as $sale) {
        foreach ($listByMonth as $sale) {
            $pdf->Cell(15, 10, $sale->id, 0, 0);
            $pdf->Cell(60, 10, $sale->dateTimeString, 0, 0);
            $pdf->Cell(30, 10, $sale->id_coin, 0, 0);
            $pdf->Cell(30, 10, $sale->id_user, 0, 0);
            $pdf->Cell(30, 10, $sale->quantity, 0, 0);
            $pdf->Cell(30, 10, $sale->subtotal, 0, 0);
            $pdf->Ln();
        }

        // Exportamos hacia el navegador
        $pdf->Output('D', 'miarchivo.pdf');

        // GUARDAR EN EL SERVIDOR

        // $pdf->Output('F', './miarchivo.pdf');
        // return $response
        //     ->withBody(new \Slim\Psr7\Stream(fopen('./miarchivo.pdf', 'r')));

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
