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

    public function CreatePdf($request, $response, $args)
    {
        $list = Sale::getAll();

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

        foreach ($list as $sale) {
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
