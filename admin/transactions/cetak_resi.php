<?php
require_once('../../config.php');
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `cargo_list` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k)) {
                $$k = $v;
            }
        }
    }
} else {
    echo '<script> alert("Shipment\'s ID is required to access the page."); location.replace("../?page=transactions"); </script>';
}
$status = isset($status) ? $status : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $ship ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            font-size: 11px;
        }
    </style>

</head>

<body>

    <img width="100%" src="../../assets/images/kop.jpg" alt="">
    <!-- tabel 1 -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No. Resi</th>
                <th scope="col">Asal</th>
                <th scope="col">Tujuan</th>
                <th scope="col">Cust Type</th>
                <th scope="col">Kilo/Volume</th>
                <th scope="col">Jenis Barang</th>
                <th scope="col">Layanan</th>
                <th scope="col">Cara Bayar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><?php echo $ship ?></th>
                <td><?php echo $origin ?></td>
                <td><?php echo $destination ?></td>
                <td><?php echo $cust_type ?></td>
                <td><?php echo $weight ?></td>
                <td><?php
                    echo  $cargo_type_id;
                    // if ($cargo_type_id != ' ') {
                    //     $items = $conn->query("SELECT B.name FROM cargo_list as A INNER JOIN cargo_type_list as B ON A.cargo_type_id = B.id WHERE A.cargo_type_id = $cargo_type_id");
                    //     if ($items->num_rows > 0) {
                    //         $row = $items->fetch_row();
                    //         echo $row[0];
                    //     }
                    // }

                    ?></td>
                <td><?php echo $shipping_type ?></td>
                <td><?php echo $metode_pembayaran ?></td>
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
                <td><?php echo $sender_name ?></td>
                <td><?php echo $receiver_name ?></td>
                <td><?php echo $keterangan_barang ?></td>
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
                <td><?php echo $sender_contact ?></td>
                <td><?php echo $receiver_contact ?></td>
                <td><?php echo $no_do ?></td>
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
                <td><?php echo $sender_address ?></td>
                <td><?php echo $receiver_address ?></td>
                <td>
                    <table>
                        <tr>
                            <td>Biaya Kirim</td>
                            <td>:</td>
                            <td>Rp. <?php echo $total ?></td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td>:</td>
                            <td><?php echo $diskon ?></td>
                        </tr>
                        <tr>
                            <td>Biaya Packing</td>
                            <td>:</td>
                            <td><?php echo $packing ?></td>
                        </tr>
                        <tr>
                            <td>Asuransi</td>
                            <td>:</td>
                            <td><?php echo $asuransi ?></td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td>:</td>
                            <td>Rp. <?php echo $total_amount ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <th>Pickup Date Time :</th>
            <th><?php echo str_replace("T", " ", $pickup_date) ?></th>
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
                <td> CS SSC
                    <br><br><br><br>
                    .....................................
                </td>
                <td>
                    <?php echo $sender_name ?>
                    <br><br><br><br>
                    .....................................
                </td>
                <td>
                    <?php echo $receiver_name ?>
                    <br><br><br><br>
                    .....................................
                </td>
            </tr>
        </tbody>
    </table>
    <!-- footer -->
    <img width="100%" src="../../assets/images/footer.jpg" alt="">
    <hr>
    <img width="100%" src="../../assets/images/kop.jpg" alt="">
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
                <th><?php echo $ship ?></th>
                <td><?php echo $origin ?></td>
                <td><?php echo $destination ?></td>
                <td><?php   ?></td>
                <td><?php   ?></td>
                <td><?php  ?></td>
                <td><?php  ?></td>
                <td><?php echo $metode_pembayaran ?></td>
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
                <td><?php echo $sender_name ?></td>
                <td><?php echo $receiver_name ?></td>
                <td><?php echo $keterangan_barang ?></td>
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
                <td><?php echo $sender_contact ?></td>
                <td><?php echo $receiver_contact ?></td>
                <td><?php echo $no_do ?></td>
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
                <td><?php echo $sender_address ?></td>
                <td><?php echo $receiver_address ?></td>
                <td>
                    <table>
                        <tr>
                            <td>Biaya Kirim</td>
                            <td>:</td>
                            <td>Rp. <?php echo $total ?></td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td>:</td>
                            <td><?php echo $diskon ?></td>
                        </tr>
                        <tr>
                            <td>Biaya Packing</td>
                            <td>:</td>
                            <td><?php echo $packing ?></td>
                        </tr>
                        <tr>
                            <td>Asuransi</td>
                            <td>:</td>
                            <td><?php echo $asuransi ?></td>
                        </tr>
                        <tr>
                            <td>Grand Total</td>
                            <td>:</td>
                            <td>Rp. <?php echo $total_amount ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <th>Tanggal :</th>
            <th><?php echo str_replace("T", " ", $pickup_date) ?></th>
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
                <td> CS SSC
                    <br><br><br><br>
                    .....................................
                </td>
                <td>
                    <?php echo $sender_name ?>
                    <br><br><br><br>
                    .....................................
                </td>
                <td>
                    <?php echo $receiver_name ?>
                    <br><br><br><br>
                    .....................................
                </td>
            </tr>
        </tbody>
    </table>
    <!-- footer -->

    <img width="100%" src="../../assets/images/footer.jpg" alt="">
</body>

<script>
    window.print();
</script>

</html>