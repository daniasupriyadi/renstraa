<?php
include('../../config.php');
require '../../vendor/autoload.php';
use Dompdf\Dompdf;

// Fungsi tampil data ok

// Membaca konten HTML untuk konversi ke PDF
$html = '
<!DOCTYPE html>
    <html>
    <head>
        <title>Daftar Instrument Renstra</title>
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
    <h2>Daftar Tabel Tabel - Instrument Renstra (Rencana Strategis)</h2>
    <div class="table-responsive text-nowrap">
                <table style="width:100%; background-color: grey; border: solid grey 2px; color: black;"  class="table table-hover table-bordered">
                  <thead style="background-color: yellowgreen; color: black;">
                  <tr>
                    <th  rowspan="2">Tujuan</th>
                    <th rowspan="2" >Sasaran Kegiatan</th>
                    <th rowspan="2" >Indikator Kinerja Kegiatan</th>
                    <th rowspan="2">Indikator Kinerja Sub Kegiatan</th>
                    <th colspan="3" >Indikator Kinerja Unit Kerja</th>
                    <th rowspan="3" >PIC/Unit</th>
                  </tr>
                        <tr>
                          <th colspan="1">Kode</th>
                          <th colspan="2">IKUK</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr style="background-color: antiquewhite;">
                              <td colspan="8">1. Terwujudnya kualitas sumber daya manusia untuk menghasilkan lulusan yang berdaya saing global</td>
                          </tr>
                          <tr>
                              <td colspan="1"></td>
                              <td colspan="6" style="background-color: rgb(112, 228, 112);">1. Terwujudnya kualitas sumber daya manusia untuk menghasilkan lulusan yang berdaya saing global</td>
                              <td colspan="1"  style="background-color: rgb(112, 228, 112);">Direktur</td>
                          </tr>
                          <tr>
                              <td colspan="2"></td>
                              <td colspan="5" style="background-color: rgb(224, 196, 159);">[IKU 1.1] Persentase lulusan S1 dan D4/D3/D2 yang berhasil mendapat pekerjaan; melanjutkan studi; atau menjadi wiraswasta</td>
                              <td colspan="1"  style="background-color:  rgb(224, 196, 159);"></td>
                          </tr>
                          <tr>
                              <td colspan="3"></td>
                              <td colspan="4" style="background-color: rgb(218, 218, 236);">[IKU 1.1] Persentase lulusan S1 dan D4/D3/D2 yang berhasil mendapat pekerjaan; melanjutkan studi; atau menjadi wiraswasta</td>
                              <td colspan="1"  style="background-color:  rgb(218, 218, 236);">Wadir 4</td>
                          </tr>
                          <tr>
                              <td colspan="4"></td>
                              <td colspan="1" style="background-color: white;">U11.1</td>
                              <td colspan="2" style="background-color: white;">Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP
                              <td colspan="1" style="background-color: white;">Ukarni</td>
                          </tr>
                          <tr>
                              <td colspan="4"></td>
                              <td colspan="1" style="background-color: white;">U11.1</td>
                              <td colspan="2" style="background-color: white;">Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP
                              <td colspan="1" style="background-color: white;">Ukarni</td>
                          </tr>
                          <tr>
                              <td colspan="4"></td>
                              <td colspan="1" style="background-color: white;">U11.1</td>
                              <td colspan="2" style="background-color: white;">Jumlah lulusan prodi yang mendapatkan pekerjaan pertama dengan waktu tunggu ≤ 6 bulan dan bergaji ≥ 1.2 x UMP
                              <td colspan="1" style="background-color: white;">Ukarni</td>
                          </tr>
                      </tbody>
                   </table>
                  </div>
    </body>
</html>';


// Membuat objek Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Menghasilkan konten PDF
$pdfContent = $dompdf->output();

// Tentukan nama file untuk file PDF
$pdfFilename = 'Daftar Instrument Renstra.pdf';

// Mendownload file PDF
header('Content-Type: application/pdf');
header('Content-Disposition: attachment;filename="'. $pdfFilename . '"');
header('Content-Length: ' . strlen($pdfContent));
echo $pdfContent;

exit;
?>
