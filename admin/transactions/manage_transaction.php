<?php
date_default_timezone_set('Asia/Jakarta');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `cargo_list` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
$cargo_type = [];
$cargo_type_qry = $conn->query("SELECT id,`name`, city_price, state_price, country_price FROM `cargo_type_list` where delete_flag = 0 order by `name` asc");
while ($row = $cargo_type_qry->fetch_assoc()) {
    $cargo_type[$row['id']] = $row;
}
    $pref = date("dmY");
    $code = sprintf("%'.05d", 1);
    while (true) {
        $check = $conn->query("SELECT * FROM cargo_list where ship = 'SSC{$pref}{$code}'")->num_rows;
        if ($check > 0) {
            $code = sprintf("%'.05d", ceil($code) + 1);
        } else {
            break;
        }
    }
    $shipmentno = 'SSC' . $pref . $code;
?>
<style>
    img#cimg {
        max-height: 15vh;
        width: 100%;
        object-fit: scale-down;
        object-position: center center;
    }
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="content py-3">
    <div class="card card-outline card-primary rounded-0 shadow">
        <div class="card-header">
            <h4 class="card-title"><b><?= isset($id) ? "" : "Informasi Transaksi" ?></b></h4>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form action="" id="cargo-form">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <div class="col-lg-12 col-md-6 col-sm-12 col-sm-12">
                        <div class="form-group mb-2">
                            <label for="cust_type" class="control-label">Customer Type</label>
                            <select name="cust_type" id="cust_type" class="form-control form-control-sm  form-control-border" required>
                                <option value="Umum" <?= isset($cust_type)  ? $cust_type : "" ?>>Umum</option>
                                <option value="Korporasi" <?= isset($cust_type)  ? $cust_type : "" ?>>Korporasi</option>
                                <option value="Project" <?= isset($cust_type)  ? $cust_type : "" ?>>Project</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="card rounded-0 shadow">
                                <div class="card-header">
                                    <h5 class="font-weight-bolder">Informasi Pengirim</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <label for="sender_name" class="control-label">Nama Lengkap</label>
                                        <input type="text" name="sender_name" id="sender_name" class="form-control form-control-sm form-control-border" value="<?= isset($sender_name) ? $sender_name : '' ?>" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="sender_contact" class="control-label">Nomor Telepon</label>
                                        <input type="text" name="sender_contact" id="sender_contact" class="form-control form-control-sm form-control-border" value="<?= isset($sender_contact) ? $sender_contact : '' ?>" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="sender_address" class="control-label">Alamat</label>
                                        <textarea rows="3" name="sender_address" id="sender_address" class="form-control form-control-sm rounded-0" required><?= isset($sender_address) ? $sender_address : '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="card rounded-0 shadow">
                                <div class="card-header">
                                    <h5 class="font-weight-bolder">Informasi Penerima</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <label for="receiver_name" class="control-label">Nama Lengkap</label>
                                        <input type="text" name="receiver_name" id="receiver_name" class="form-control form-control-sm form-control-border" value="<?= isset($receiver_name) ? $receiver_name : '' ?>" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="receiver_contact" class="control-label">Nomor Telepon</label>
                                        <input type="text" name="receiver_contact" id="receiver_contact" class="form-control form-control-sm form-control-border" value="<?= isset($receiver_contact) ? $receiver_contact : '' ?>" required>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="receiver_address" class="control-label">Alamat</label>
                                        <textarea rows="3" name="receiver_address" id="receiver_address" class="form-control form-control-sm rounded-0" required><?= isset($receiver_address) ? $receiver_address : '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-5 col-sm-12 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="from_location" class="control-label">Shipment Number</label>
                                <input type="text" name="ship" id="ship" class="form-control form-control-sm rounded-0" value=<?= isset($ship) ? $ship : $shipmentno ?> required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="No_DO" class="control-label">No DO</label>
                                <input type="text" name="no_do" id="No_DO" class="form-control form-control-sm rounded-0" value="<?= isset($no_do) ? $no_do : ' ' ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-12 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="Origin" class="control-label">Origin</label>
                                <input type="text" name="origin" id="Origin" class="form-control form-control-sm rounded-0" value="<?= isset($origin) ? $origin : '' ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="Destination" class="control-label">Destination</label>
                                <input type="text" name="destination" id="Destination" class="form-control form-control-sm rounded-0" value="<?= isset($destination) ? $destination : ' ' ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-12 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="shipping_type" class="control-label">Layanan Pengiriman</label>
                                <select name="shipping_type" id="shipping_type" class="form-control form-control-sm  form-control-border" required>
                                    <option value="Reguler" <?= isset($shipping_type) ? $shipping_type : "" ?>>Reguler</option>
                                    <option value="Express" <?= isset($shipping_type) ? $shipping_type : "" ?>>Express</option>
                                    <option value="Trucking" <?= isset($shipping_type) ? $shipping_type : "" ?>>Trucking</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="Metode_Pembayaran" class="control-label">Metode Pembayaran</label>
                                <select name="metode_pembayaran" id="Metode_Pembayaran" class="form-control form-control-sm  form-control-border" required>
                                    <option value="Tunai" <?= isset($metode_membayaran) ? $metode_membayaran : "" ?>>Tunai</option>
                                    <option value="Transfer" <?= isset($metode_membayaran)  ? $metode_membayaran : "" ?>>Transfer</option>
                                    <option value="QRIS" <?= isset($metode_membayaran)  ? $metode_membayaran : "" ?>>QRIS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card card-outline card-info shadow rounded0">
                                <div class="card-header">
                                    <h5 class="card-title"><b>Informasi Kiriman</b></h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center mb-0 pb-0">
                                        <div class="col-3 border text-center"><b>Type</b></div>
                                        <div class="col-3 border text-center"><b>Harga</b></div>
                                        <div class="col-3 border text-center"><b>Berat Volume/Kg</b></div>
                                        <div class="col-3 border text-center"><b>Total</b></div>
                                    </div>
                                    <div id="cargo-item-list" class="d-table w-100">
                                        <?php
                                        if (isset($id)):
                                            $items = $conn->query("SELECT i.*,t.name as cargo_type FROM `cargo_items` i inner join cargo_type_list t on i.cargo_type_id = t.id where i.cargo_id = '{$id}'");
                                            while ($row = $items->fetch_array()):
                                        ?>
                                                <div class="d-table-row align-items-center justify-content-center my-0 py-0 cargo-item">
                                                    <div class="d-table-cell col-3 px-2 py-1 border text-center">
                                                        <input type="hidden" name="price[]" id="price" value="<?= $row['price'] ?>">
                                                        <input type="hidden" name="total[]" id="total" value="<?= $row['total'] ?>">
                                                        <select name="cargo_type_id[]" id="cargo_type_id" class="form-control form-control-sm form-control-border select2">
                                                            <option value="" disabled='' selected></option>
                                                            <?php
                                                            foreach ($cargo_type as $crow):
                                                            ?>
                                                                <option value="<?= $crow['id'] ?>" <?= $crow['id'] == $row['cargo_type_id'] ? 'selected' : ''  ?>><?= $crow['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="d-table-cell col-3 px-2 py-1 border text-right"><span id="price" class="font-weight-bold price"><b>Rp </b><?= format_num($row['price']) ?></span></div>
                                                    <div class="d-table-cell col-3 px-2 py-1 border text-center"><input type="number" step="any" id="weight" name="weight[]" class="form-control form-control-sm form-control-border text-right" value="<?= ($row['weight']) ?>"></div>
                                                    <div class="d-table-cell col-3 px-2 py-1 border text-right"><span id="total" class="font-weight-bold total"><b>Rp </b><?= format_num($row['total']) ?></span></div>
                                                </div>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-0 pb-0">
                                        <div class="col-9 border text-center"><b>Diskon</b></div>
                                        <input type="text" id="diskon" name="diskon" class="col-3 border text-center">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-0 pb-0">
                                        <div class="col-9 border text-center"><b>Biaya Packing</b></div>
                                        <input type="text" id="packing" name="packing" class="col-3 border text-center">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-0 pb-0">
                                        <div class="col-9 border text-center"><b>Asuransi</b></div>
                                        <input type="text" id="asuransi" name="asuransi" class="col-3 border text-center">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-0 pb-0">
                                        <input type="hidden" name="total_amount">
                                        <div class="col-9 border text-center"><b>Grand Total</b></div>
                                        <div class="col-3 border text-right"><b id="gtotal" name="total_amount"> <?= isset($total_amount) ? format_num($total_amount) : 'Rp 0.00' ?></b></div>
                                    </div>
                                    <div class="clear-fix my-2"></div>
                                    <div class="text-right">
                                        <button class="btn btn-sm btn-flat btn-primary" type="button" id="calc">Calc</button>
                                        <button class="btn btn-default border btn-sm btn-flat" id="add_item" type="button"><i class="fa fa-plus"></i> Add Item</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-12 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="Keterangan_Barang" class="control-label">Keterangan Barang Kiriman</label>
                                <textarea rows="2" name="keterangan_barang" id="Keterangan_Barang" class="form-control form-control-sm rounded-0" required><?= isset($sender_address) ? $sender_address : '' ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-12 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="Comments" class="control-label">Comments</label>
                                <textarea rows="2" name="comments" id="comments" class="form-control form-control-sm rounded-0" required><?= isset($sender_address) ? $sender_address : '' ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-12 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="Pickup_Date" class="control-label">Pickup Date/Time</label>
                                <input name="pickup_date" class="form-control" id="Pickup_Date" type="datetime-local">
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12">
                            <div class="form-group mb-2">
                                <label for="Status" class="control-label">Status</label>
                                <select name="status" id="Status" class="form-control form-control-sm  form-control-border" required>
                                    <option value="In Transit" <?= isset($Status) ? 'selected' : "" ?>>In Transit</option>
                                    <option value="OTW" <?= isset($Status) ? 'selected' : "" ?>>OTW</option>
                                    <option value="XXX" <?= isset($Status) ? 'selected' : "" ?>>XXX</option>
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-sm btn-flat btn-primary" type="submit" form="cargo-form">Save</button>
        <a class="btn btn-sm btn-flat btn-default border" href="./?page=transactions">Cancel</a>
    </div>
</div>
</div>
<noscript id="cargo-item-clone">
    <div class="d-table-row align-items-center justify-content-center my-0 py-0 cargo-item">
        <div class="d-table-cell col-3 px-2 py-1 border text-center">
            <input type="hidden" name="price[]">
            <input type="hidden" name="total[]">
            <select name="cargo_type_id[]" class="form-control form-control-sm form-control-border select2">
                <option value="" disabled='' selected></option>
                <?php
                foreach ($cargo_type as $row):
                ?>
                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="d-table-cell col-3 px-2 py-1 border text-right"><b>Rp </b><span id="price" class="font-weight-bold price">0.00</span></div>
        <div class="d-table-cell col-3 px-2 py-1 border text-center"><input type="number" step="any" name="weight[]" class="form-control form-control-sm form-control-border text-right"></div>
        <div class="d-table-cell col-3 px-2 py-1 border text-right"><b>Rp </b><span class="font-weight-bold total">0.00</span></div>
    </div>
    <? echo $_POST ?>
</noscript>
<script>
    const cargo_type = $.parseJSON('<?= json_encode($cargo_type) ?>');

    function change_price(_this, cargo_type_id) {
        var type = $('#shipping_type').val()
        console.log(cargo_type)

        if (!!cargo_type[cargo_type_id]) {
            if (type == "Reguler") {
                var price = cargo_type[cargo_type_id].city_price
            } else if (type == "Express") {
                var price = cargo_type[cargo_type_id].state_price
            } else if (type == "Trucking") {
                var price = cargo_type[cargo_type_id].country_price
            } else {
                var price = 0;
            }
            _this.find("[name='price[]'").val(price)
            _this.find(".price").text(parseFloat(price).toLocaleString("en-US"))

            calc()
        }
    }

    function calc() {
        var gtotal = 0;
        $('#cargo-item-list .cargo-item').each(function() {
            var price = $(this).find('[name="price[]"').val();
            var weight = $(this).find('[name="weight[]"]').val();
            price = price > 0 ? price : 0;
            weight = weight > 0 ? weight : 0;
            var total = parseFloat(price) * parseFloat(weight)
            $(this).find('[name="total[]"]').val(total)
            $(this).find('.total').text(parseFloat(total).toLocaleString('en-US'))
            gtotal += parseFloat(total)
        })

        $('[name="total_amount"]').val(gtotal)
        $('#gtotal').text("Rp. " + parseFloat(gtotal).toLocaleString('en-US'))
    }
    $(document).ready(function() {
        $('.select2').select2({
            width: "100%",
            placeholder: "Please Select Here"
        })
        $('#add_item').click(function() {
            var item = $($('noscript#cargo-item-clone').html()).clone()
            $('#cargo-item-list').append(item)
            item.find('.select2').select2({
                width: "100%",
                placeholder: "Please Select Here"
            })
            item.find("[name='cargo_type_id[]']").change(function() {
                var id = $(this).val();
                change_price(item, id)
            })
            item.find('[name="weight[]"]').on('input', function() {
                console.log('test')
                calc()
            })
            var diskon = document.getElementById('diskon');
            var packing = document.getElementById('packing');
            var asuransi = document.getElementById('asuransi');
            diskon.value = " ";
            packing.value = " ";
            asuransi.value = " ";

        })
        $("[name='cargo_type_id[]']").change(function() {
            var id = $(this).val();
            change_price(item, id)
        })
        $('[name="weight[]"]').on('input', function() {
            console.log('test')
            calc()
        })
        $('#shipping_type').change(function() {
            $('#cargo-item-list .cargo-item').each(function() {
                var id = $(this).find('[name="cargo_type_id[]"]').val()
                change_price($(this), id)
            })
        })
        $('#cargo-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_cargo",
                contentType: 'application/json; charset=utf-8',
                //dataType: "json",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                error: err => {
                    console.log(err)
                    console.log(resp)
                    alert_toast("Error", 'error');
                    end_loader();
                },
                success: function(resp) {
                    let obj = JSON.parse(resp);
                    console.log(obj.status)
                    //JSON.parse(resp)
                    if (obj.status == 'success') {
                        // swal(obj.msg,"","success")
                        swal(obj.msg,"","success")
                        .then((value) => {
                            location.replace("./?page=transactions/view_transaction&id=" + obj.cid);
                        });
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({
                            scrollTop: _this.closest('.card').offset().top
                        }, "fast");
                    } else {
                        swal("Error","","error")
                        .then((value) => {
                            location.replace("./?page=transactions/manage_transaction");
                        });
                    }
                    end_loader();
                }
            })
        })

    })

    /* Dengan Rupiah */
    var diskon = document.getElementById('diskon');
    diskon.addEventListener('keyup', function(e) {
        diskon.value = formatRupiah(this.value, 'Rp. ');
    });

    // diskon.value = parseFloat(diskon.value)
    // var gtotal = parseFloat(document.getElementById('gtotal').innerHTML.replaceAll(",", ""))
    // gtotal -= diskon.value
    // $('#gtotal').text(parseFloat(gtotal).toLocaleString('en-US'))
    // console.log(gtotal)

    var packing = document.getElementById('packing');
    packing.addEventListener('keyup', function(e) {
        packing.value = formatRupiah(this.value, 'Rp. ');
    });
    var asuransi = document.getElementById('asuransi');
    asuransi.addEventListener('keyup', function(e) {
        asuransi.value = formatRupiah(this.value, 'Rp. ');
    });

    document.getElementById('calc').addEventListener("click", function() {
        diskon = parseFloat(diskon.value.substr(4).replaceAll(".", ""))
        packing = parseFloat(packing.value.substr(4).replaceAll(".", ""))
        asuransi = parseFloat(asuransi.value.substr(4).replaceAll(".", ""))
        gtotal = parseFloat(document.getElementById('gtotal').innerHTML.substr(4).replaceAll(",", ""))
        gtotal += -(diskon) + packing + asuransi
        $('[name="total_amount"]').val(gtotal)
        $('#gtotal').text("Rp. " + parseFloat(gtotal).toLocaleString('en-US'))
    });


    /* Fungsi */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>