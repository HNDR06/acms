<?php
if ($_settings->chk_flashdata('success')):
?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline rounded-0 card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Transactions</h3>
        <div class="card-tools">
            <a id="create_excel" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-file-excel"></i> Generate Excel</a>
            <a class="btn btn-sm btn-flat btn-primary" id="create_new" href="./?page=transactions/manage_transaction"><i class="fa fa-plus"></i> Add New Shipment</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-hover table-striped table-bordered">
                    <colgroup>
                        <col width="5%">
                        <col width="20%">
                        <col width="20%">
                        <col width="30%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Book Date</th>
                            <th>Shipment Number</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $qry = $conn->query("SELECT * FROM `cargo_list` order by unix_timestamp(date_created) desc ");
                        while ($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?= date("Y-m-d", strtotime($row['date_created'])) ?></p>
                                </td>
                                <td>
                                    <p class="m-0 truncate-1"><?= $row['ship'] ?></p>
                                </td>
                                <td>
                                    <p class="m-0 truncate-1 text-right">Rp. <?= format_num($row['total_amount']) ?></p>
                                </td>
                                <td class="text-center">
                                    <?php if ($row['status'] == 'In Transit'): ?>
                                        <span class="badge badge-primary bg-gradient-primary px-3 rounded-pill"><?php echo $row['status'] ?></span>
                                    <?php elseif ($row['status'] == 'Arrived'): ?>
                                        <span class="badge badge-warning bg-gradient-warning px-3 rounded-pill"><?php echo $row['status'] ?></span>
                                    <?php elseif ($row['status'] == 'OnTheWay'): ?>
                                        <span class="badge badge-light bg-gradient-light border px-3 rounded-pill"><?php echo $row['status'] ?></span>
                                    <?php elseif ($row['status'] == 'Completed'): ?>
                                        <span class="badge badge-success bg-gradient-success px-3 rounded-pill"><?php echo $row['status'] ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary bg-gradient-secondary px-3 rounded-pill"><?php echo $row['status'] ?></span>
                                    <?php endif; ?>
                                </td>
                                <td align="center">
                                    <a class="btn btn-default bg-gradient-light btn-flat btn-sm" href="?page=transactions/view_transaction&id=<?php echo $row['id'] ?>"><span class="fas fa-edit text-dark"></span> Edit</a>
                                    <a class="btn btn-default bg-gradient-light btn-flat btn-sm" href="transactions/cetak_resi.php?id=<?php echo $row['id'] ?>"><span class="fa fa-file-pdf text-dark"></span> PDF</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
        $('#create_excel').click(function() {
        	uni_modal("<i class='fa fa-calendar'></i> Masukkan Tanggal Report","transactions/manage_cargo_type.php");
        })

</script>