<?php

	// Include the main TCPDF library (search for installation path).
	require_once('C:\xampp\htdocs\acms\libs\TCPDF\tcpdf.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicole Asuni');
	$pdf->SetTitle('PDF file using TCPDF');

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(20, 20, 20);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// add a page
	$pdf->AddPage();

	$html = <<<EOD
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            font-size: 11px;
        }
    </style>

  </head>
<body>

<img width="100%" src="images/kop.jpg" alt="">
<!-- tabel 1 -->
<table class="table">
            <thead>
                <tr>
                <th scope="col">No. Resi</th>
                <th scope="col">Asal</th>
                <th scope="col">Tujuan</th>
                <th scope="col">Koli</th>
                <th scope="col">Kilo/Volume</th>
                <th scope="col">Jenis Barang</th>
                <th scope="col">Layanan</th>
                <th scope="col">Cara Bayar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th><?php echo ; ?></th>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                </tr>
            </tbody>
        </table>

<!-- tabel 2 -->
<table class="table">
            <thead>
                <tr>
                <th width="35%" scope="col">Pengirim</th>
                <th width="35%" scope="col">Penerima</th>
                <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                </tr>
            </tbody>
        </table>
<!-- tabel 3 -->
        <table class="table">
            <thead>
                <tr>
                <th width="35%" scope="col">No. Telp. Pengirim</th>
                <th width="35%" scope="col">No. Telp. Penerima</th>
                <th scope="col">No. DO / Surat Jalan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                </tr>
            </tbody>
        </table>

<!-- tabel 4 -->
<?php 
?>
<table class="table">
            <thead>
                <tr>
                <th width="35%" scope="col">Alamat Pengirim</th>
                <th width="35%" scope="col">Alamat Penerima</th>
                <th scope="col">BIAYA KIRIMAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td></td>
                <td><?php echo ; ?></td>
                <td>
                    <table>
                        <tr>
                            <td>Biaya Kirim</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Biaya Packing</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Biaya Lain</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Asuransi</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                    </table>
                </td>
                </tr>
            </tbody>
        </table>
        
        <table>
                <thead>
                <th>Tanggal</th>
                <th>:</th>
                <th><?php echo ; ?></th>
                </thead>            
        </table>

        <!-- tabel 5 -->
        <table class="table">
            <thead>
                <tr>
                <th width="35%" scope="col">Customer Service</th>
                <th width="35%" scope="col">Nama Pengirim</th>
                <th scope="col">Nama Penerima</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td></td>
                <td>
                    <br><br>
                    <?php echo ; ?></td>
                <td>
                    <br><br>
                    ............................
                </td>
                </tr>
            </tbody>
        </table>
        <!-- footer -->
        
        <img width="100%" src="images/footer.jpg" alt="">
        <hr>
<img width="100%" src="images/kop.jpg" alt="">
<!-- tabel 1 -->
<table class="table">
            <thead>
                <tr>
                <th scope="col">No. Resi</th>
                <th scope="col">Asal</th>
                <th scope="col">Tujuan</th>
                <th scope="col">Koli</th>
                <th scope="col">Kilo/Volume</th>
                <th scope="col">Jenis Barang</th>
                <th scope="col">Layanan</th>
                <th scope="col">Cara Bayar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th><?php echo ; ?></th>
                <td></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                </tr>
            </tbody>
        </table>

<!-- tabel 2 -->
<table class="table">
            <thead>
                <tr>
                <th width="35%" scope="col">Pengirim</th>
                <th width="35%" scope="col">Penerima</th>
                <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                </tr>
            </tbody>
        </table>
<!-- tabel 3 -->
        <table class="table">
            <thead>
                <tr>
                <th width="35%" scope="col">No. Telp. Pengirim</th>
                <th width="35%" scope="col">No. Telp. Penerima</th>
                <th scope="col">No. DO / Surat Jalan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                <td><?php echo ; ?></td>
                </tr>
            </tbody>
        </table>

<!-- tabel 4 -->
<?php 
?>
<table class="table">
            <thead>
                <tr>
                <th width="35%" scope="col">Alamat Pengirim</th>
                <th width="35%" scope="col">Alamat Penerima</th>
                <th scope="col">BIAYA KIRIMAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td></td>
                <td><?php echo ; ?></td>
                <td>
                    <table>
                        <tr>
                            <td>Biaya Kirim</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Biaya Packing</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Biaya Lain</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Asuransi</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td>:</td>
                            <td>Rp. <?php echo ; ?></td>
                        </tr>
                    </table>
                </td>
                </tr>
            </tbody>
        </table>
        
        <table>
                <thead>
                <th>Tanggal</th>
                <th>:</th>
                <th><?php echo ; ?></th>
                </thead>            
        </table>

        <!-- tabel 5 -->
        <table class="table">
            <thead>
                <tr>
                <th width="35%" scope="col">Customer Service</th>
                <th width="35%" scope="col">Nama Pengirim</th>
                <th scope="col">Nama Penerima</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td></td>
                <td>
                    <br><br>
                    <?php echo ; ?></td>
                <td>
                    <br><br>
                    ............................
                </td>
                </tr>
            </tbody>
        </table>
        <!-- footer -->
        
        <img width="100%" src="images/footer.jpg" alt="">
    
        



 

    

    
    
</body>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

	 
	// $pdf->writeHTML($html, true, false, true, false, '');
	
        // add a page
	$pdf->AddPage();

	$html = '<h4>Second page</h4>';
	
	$pdf->writeHTML($html, true, false, true, false, '');

	// reset pointer to the last page
	$pdf->lastPage();
	//Close and output PDF document
	$pdf->Output('example.pdf', 'I');

?>