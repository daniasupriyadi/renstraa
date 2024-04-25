<?php
include('../../config.php');
require '../../vendor/autoload.php';
use Dompdf\Dompdf;

// Fungsi tampil data
$no = 1;
$query = mysqli_query($connection, "SELECT unit_id, nama_unit FROM unit ORDER BY unit_id");


// Membaca konten HTML untuk konversi ke PDF
$html = '
<!DOCTYPE html>
    <html>
    <head>
        <title>Daftar Unit/PIC</title>
        <style>
        h2{
            text-align: center;
            margin-bottom: 16px;
        }
            table{
                width: 100%;
                border-collapse: collapse;
            }
            table, th, td{
                border: 1px solid black;
            }
            td{
                padding: 8px;
            }
            th{
                padding: 8px;
                background-color : #8DB4E2;
                font-weight: bold;
                text-align: center;
            }
            .small_column{
                width: 50px;
                text-align: center !important;
              }
        </style>
    </head>
    <body>
    <h2>Daftar Tabel Unit</h2>
    <table id="table" class="table table-hover">
        <thead>
            <tr>
                <th class="small_column">No</th>
                <th>Nama Unit / PIC</th>
            </tr>
        </thead>
        <tbody>';
        while($data = mysqli_fetch_array($query)){
        $html .= '<tr>';
            $html .= '<td class="small_column">' .$no++. '</td>';
            $html .= '<td>' .$data['nama_unit']. '</td>';
        $html .= '</tr>';
        }
        $html .= '
        </tbody>
        </table>
    </body>
</html>';


// Membuat objek Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Menghasilkan konten PDF
$pdfContent = $dompdf->output();

// Tentukan nama file untuk file PDF
$pdfFilename = 'Daftar Unit PIC.pdf';

// Mendownload file PDF
header('Content-Type: application/pdf');
header('Content-Disposition: attachment;filename="'. $pdfFilename . '"');
header('Content-Length: ' . strlen($pdfContent));
echo $pdfContent;

exit;
?>
