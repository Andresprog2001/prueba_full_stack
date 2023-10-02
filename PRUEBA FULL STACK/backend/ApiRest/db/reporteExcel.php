<?php
require 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

function permisos()
{
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Credentials: true');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
        exit(0);
    }
}

permisos();

$spreadsheet = new SpreadSheet();
$spreadsheet->getProperties()->setCreator("funcionalidad")->setTitle("Reporte de procesos");

// Se indica que se va a trabajar con la posicion 0( la primera que encuentre), la hoja de excel que se va a utilizar
$spreadsheet->setActiveSheetIndex(0);

$hojaActiva = $spreadsheet->getActiveSheet();

// $hojaActiva->setCellValue('A1', 'ID oferta');
// $hojaActiva->setCellValue('B1', 'Creador oferta');
$hojaActiva->setCellValue('A1', 'Objeto');
$hojaActiva->setCellValue('B1', 'Actividad');
$hojaActiva->setCellValue('C1', 'Descripción');
$hojaActiva->setCellValue('D1', 'Moneda');
$hojaActiva->setCellValue('E1', 'Presupuesto');
$hojaActiva->setCellValue('F1', 'Fecha de inicio');
$hojaActiva->setCellValue('G1', 'Hora de inicio');
$hojaActiva->setCellValue('H1', 'Fecha de cierre');
$hojaActiva->setCellValue('I1', 'Estado');

// $hojaActiva = $spreadsheet->getActiveSheet()
//     ->fromArray(
//         $arrayData,
//         // The data to set
//         NULL,
//         // Array values with this value will not be set
//         'C3' // Top left coordinate of the worksheet range where
//         //    we want to set these values (default is A1)
//     );

try {

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="myfile.xls"');
    header('Cache-Control: max-age=0');

    // $writer = IOFactory::createWriter($spreadsheet, 'xls');

    // $writer->save('php://output');
} catch (Exception $e) {
    echo $e;
}


?>