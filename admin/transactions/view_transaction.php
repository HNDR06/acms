<?php
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
    echo '<script> alert("Shipment\'s ID is required to access the page."); location.replace("./?page=transactions"); </script>';
}
$status = isset($status) ? $status : '';
?>
<div class="content py-3">
    <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
            <h4 class="card-title">Transaction Details</h4>
            <div class="card-tools">
                <a href="./?page=transactions/manage_transaction&id=<?= isset($id) ? $id : '' ?>" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-edit"></i> Edit Details</a>
                <button id="delete_cargo" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash"></i> Delete Data</button>
            </div>
        </div>
        <div class="card-body">
            <div class="text-right">
                <?php if ($status == 'In Transit') : ?>
                    <span class="badge badge-primary bg-gradient-primary px-3 rounded-pill"><?php echo $status ?></span>
                <?php elseif ($status == 'Arrived') : ?>
                    <span class="badge badge-warning bg-gradient-warning px-3 rounded-pill"><?php echo $status ?></span>
                <?php elseif ($status == 'OnTheWay') : ?>
                    <span class="badge badge-light bg-gradient-light border px-3 rounded-pill"><?php echo $status ?></span>
                <?php elseif ($status == 'Completed') : ?>
                    <span class="badge badge-success bg-gradient-success px-3 rounded-pill"><?php echo $status ?></span>
                <?php else : ?>
                    <span class="badge badge-secondary bg-gradient-secondary px-3 rounded-pill"><?php echo $status ?></span>
                <?php endif; ?>
                <button class="btn btn-default border btn-flat" id="update_status">Update Status</button>
                <button class="btn btn-default border btn-flat" id="trace">Trace</button>
                <button class="btn btn-default border btn-flat" id="print" title="Print"><i class="fa fa-print"></i></button>
            </div>
            <div id="outprint">
                <h4 class="text-muted">Shipment Number :</h4>
                <h2><?= isset($ship) ? $ship : "" ?></h2>   
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <fieldset>
                            <large class="font-weight-bolder">Sender Information</large>
                            <div class="pl-3">
                                <span><?= isset($sender_name) ? $sender_name : "" ?></span><br>
                                <span><?= isset($sender_contact) ? $sender_contact : "" ?></span><br>
                                <span><?= isset($sender_address) ? ucwords($sender_address) : "" ?></span><br>
                                <span><?= isset($sender_provided_id_type) ? $sender_provided_id_type : "" ?></span><br>
                                <span><?= isset($sender_provided_id) ? $sender_provided_id : "" ?></span>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <fieldset>
                            <large class="font-weight-bolder">Receiver Information</large>
                            <div class="pl-3">
                                <span><?= isset($receiver_name) ? ucwords($receiver_name) : "" ?></span><br>
                                <span><?= isset($receiver_contact) ? $receiver_contact : "" ?></span><br>
                                <span><?= isset($receiver_address) ? $receiver_address : "" ?></span><br>
                                <span><?= isset($receiver_provided_id_type) ? $receiver_provided_id_type : "" ?></span><br>
                                <span><?= isset($receiver_provided_id) ? $receiver_provided_id : "" ?></span>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="clear-fix my-3"></div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <fieldset>
                            <large class="font-weight-bolder">Shipment From:</large>
                            <div class="pl-3">
                                <span><?= isset($origin) ? $origin : "" ?></span>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <fieldset>
                            <large class="font-weight-bolder">Shipment To:</large>
                            <div class="pl-3">
                                <span><?= isset($destination) ? $destination : "" ?></span>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <fieldset>
                            <large class="font-weight-bolder">Shipment Type:</large>
                            <div class="pl-3">
                                <span>
                                    <?php
                                    $status = isset($status) ? $status : '';
                                    switch ($status) {
                                        case '1':
                                            echo "City to City";
                                            break;
                                        case '2':
                                            echo "State to State";
                                            break;
                                        case '1':
                                            echo "Country to Country";
                                            break;
                                        default:
                                            echo $shipping_type;
                                            break;
                                    }
                                    ?>
                                </span>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="clear-fix my-3"></div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <colgroup>
                                <col width="40%">
                                <col width="20%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="px-2 py-1 text-center">Cargo Type</th>
                                    <th class="px-2 py-1 text-center">Price</th>
                                    <th class="px-2 py-1 text-center">Weight (kg.)</th>
                                    <th class="px-2 py-1 text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-2 py-1 align-middle"><?= isset($cargo_type_id) ? $cargo_type_id : '' ?></td>
                                    <td class="px-2 py-1 text-right align-middle"><?= isset($price) ? $price : '' ?></td>
                                    <td class="px-2 py-1 text-right align-middle"><?= isset($weight) ? $weight : '' ?></td>
                                    <td class="px-2 py-1 text-right align-middle"><?= isset($total_amount) ? $total_amount : '' ?></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="px-1 py-1 text-center" colspan="3"><b>Total Amount</b></th>
                                    <th class="px-1 py-1 text-right"><b><?= isset($total_amount) ? format_num($total_amount) : "" ?></b></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<noscript id="print-head">
    <div>
        <style>
            #sys-logo {
                height: 150px;
                width: 150px;
                object-fit: scale-down;
                object-position: center center;
            }
        </style>
        <div class="d-flex justify-content-center align-items-center">
            <div class="col-1">
                <img src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="img-fluid w-100" id="sys-logo">
            </div>
            <div class="col-10 text-center">
                <h5 class="text-center m-0"><b><?= $_settings->info('name') ?></b></h5>
                <div class="text-center"><b>Shipment Details</b></div>
            </div>
        </div>
    </div>
    <hr>
</noscript>
<script>
    $(function() {
        $('#print').click(function() {
            start_loader();
            var h = $('head').clone()
            var p = $('#outprint').clone()
            var ph = $($('noscript#print-head').html()).clone()
            var el = $('<div>')
            h.find("title").html("Shipment Details - Print View")
            el.append(h)
            el.append(ph)
            el.append(p)
            var nw = window.open("", "_blank", "height=800,width=1000,top=50, left=150")
            nw.document.write(el.html())
            nw.document.close()
            setTimeout(() => {
                nw.print()
                setTimeout(() => {
                    end_loader();
                    nw.close()
                }, 200);
            }, 500);
        })
        $('#update_status').click(function() {
            uni_modal("Update Shipment Status - <b><?= isset($ship) ? $ship : "" ?></b>", "transactions/update_status.php?id=<?= isset($id) ? $id : '' ?>")
        })
        $('#trace').click(function() {
            uni_modal("Shipment Tracking History - <b><?= isset($ref_code) ? $ref_code : "" ?></b>", "transactions/track_shipment.php?id=<?= isset($id) ? $id : '' ?>")
        })
        $('#delete_cargo').click(function() {
            _conf("Are you sure to delete this Shipment permanently?", "delete_cargo", [])
        })
    })

    function delete_cargo($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_cargo",
            method: "POST",
            data: {
                id: '<?= isset($id) ? $id : "" ?>'
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.replace('./?page=transactions');
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>