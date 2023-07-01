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
        $pdf->SetFont('Arial', '', 12);

        // Añadimos titulo
        $pdf->Cell(15, 15, 'Titulo del PDF');
        $pdf->Ln(5);

        // foreach($list as $sale){
        //     $pdf->Cell(15, 15,$sale->name);
        // }

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
