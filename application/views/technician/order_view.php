<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>TEKNISI APP</title>

  <style>
    input[type="text"][disabled] {
    }
    .rating {
      display: flex;
      width: 100%;
      justify-content: center;
      overflow: hidden;
      flex-direction: row-reverse;
      height: 80px;
      position: relative;
    }

    .rating-0 {
      filter: grayscale(100%);
    }

    .rating > input {
      display: none;
    }

    .rating > label {
      cursor: pointer;
      width: 40px;
      height: 40px;
      margin-top: auto;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: center;
      background-size: 76%;
      transition: .3s;
    }

    .rating > input:checked ~ label,
    .rating > input:checked ~ label ~ label {
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
    }

    .rating > input:not(:checked) ~ label:hover,
    .rating > input:not(:checked) ~ label:hover ~ label {
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
    }
  </style>

</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>

<!-- Modal tambah layanan -->
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    Tambah Layanan
                </h4>
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form role="form" method="post" action="/protechapp/index.php/Controller_Order/requestNewServiceSubmit/<?=$order_code?>/<?=$service_category_code?>">
                  <?php 
                foreach ($data_layanan_tambahan as $service_type){
              ?>
              <input type="hidden" name="price-<?=$service_type->service_type_code?>" value="<?=$service_type->price?>" >
                <div class="form-check form-check-flat form-check-primary">
                  <input type="checkbox" name="<?=$service_type->service_type_code?>" value="<?=$service_type->service_type_code?>" > <?=$service_type->service_type_name?> - Rp <?php echo number_format($service_type->price,2,',','.')?>
                </div>
              <?php } ?>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Selesai -->
<div class="modal fade" id="modalSelesai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <form role="form" method="post" action="/protechapp/index.php/Controller_Order/confirmOrderTechnician/<?=$order_code?>/MENUNGGU PEMBAYARAN">
               <h3 align="center">Apakah anda yakin?</h3>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Ya</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Pembayaran -->
<div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <form role="form" method="post" action="/protechapp/index.php/Controller_Order/confirmOrderTechnician/<?=$order_code?>/SELESAI">
               <h3 align="center">Apakah anda yakin?</h3>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Ya</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lihat Ulasan -->

<?php if ($review) { ?>
<div class="modal fade" id="modalLihatUlasan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <form role="form" method="post" action="/protechapp/index.php/Controller_Order/submitReview/<?php echo $data[0]->order_code ?>">
               <h3 align="center">Ulasan Dari Pelanggan</h3>
               <div class="rating">
                  <input disabled="disabled" type="radio" name="rating" id="rating-5" value="5" <?php if ($review[0]->rate == 5) { ?> checked="" <?php } ?>>
                  <label for="rating-5"></label>
                  <input disabled="disabled" type="radio" name="rating" id="rating-4" value="4" <?php if ($review[0]->rate == 4) { ?> checked="" <?php } ?>>
                  <label for="rating-4"></label>
                  <input disabled="disabled" type="radio" name="rating" id="rating-3" value="3" <?php if ($review[0]->rate == 3) { ?> checked="" <?php } ?>>
                  <label for="rating-3"></label>
                  <input disabled="disabled" type="radio" name="rating" id="rating-2" value="2" <?php if ($review[0]->rate == 2) { ?> checked="" <?php } ?>>
                  <label for="rating-2"></label>
                  <input disabled="disabled" type="radio" name="rating" id="rating-1" value="1" <?php if ($review[0]->rate == 1) { ?> checked="" <?php } ?>>
                  <label for="rating-1"></label>
                </div>
                    <div class="form-group">
                      <label class="col-sm-3 col-form-label">Ulasan</label>
                      <div class="col-sm-9" style="max-width: 100%">
                        <textarea class="form-control" rows="4" cols="50" id="ulasan" name="ulasan" disabled="disabled"><?php echo $review[0]->review ?></textarea>
                      </div>
                    </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<!-- first row starts here -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Detail Pemesanan</h4>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Layanan</label>
                    <div class="col-sm-9">
                      <?php if ($data[0]->jenis_layanan != null) { ?>
                      <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo  $data[0]->jenis_layanan ?>" disabled />
                      <?php } else { ?>
                      <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="PERBAIKAN" disabled />
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kategori Layanan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="layanan" name="layanan" value="<?php echo $data[0]->service_category_name ?>" disabled />
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Layanan</label>
                    <div class="col-sm-9">
                      <?php if ($data[0]->service_type_name != null) { ?>
                      <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $data[0]->service_type_name ?>" disabled />
                       <?php } else { ?>
                      <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $data[0]->order_description ?>" disabled />
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Waktu Perbaikan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" value="<?php echo $waktu_perbaikan ?>" disabled />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Detail Keluhan</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" rows="3" disabled="disabled"><?php echo $data[0]->detail_keluhan; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" rows="3" disabled="disabled"><?php echo $data[0]->alamat_pengerjaan; ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Catatan Alamat</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" rows="3" disabled="disabled"><?php echo $data[0]->address_note; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Foto Kerusakan</label>
                    <div class="col-sm-9">
                      <img width="415px" src="data:image/png;base64,<?php echo $data[0]->photo ?>" alt="Red dot" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Biaya</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="Rp <?php echo number_format($data[0]->order_price,2,',','.'); ?>" disabled />
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Pelanggan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo  $data[0]->nama_customer ?>" disabled />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nomor Pelanggan</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                          <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo  $data[0]->customer_phone ?>" disabled />
                          <div class="input-group-append">
                            <button class="btn btn-sm btn-success"  onclick=" window.open('http://wa.me/<?php echo $customer_wa?>','_blank')" type="button">
                              <i class="mdi mdi-whatsapp"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status Pemesanan</label>
                    <div class="col-sm-9">
                      <?php if ($data[0]->order_status == 'MENUNGGU KONFIRMASI') { ?>
                      <label class="badge badge-danger">Menunggu Konfirmasi</label>
                      <?php } else if ($data[0]->order_status == 'DALAM PROSES') { ?>
                      <label class="badge badge-warning">Dalam Proses</label>
                      <?php } else if ($data[0]->order_status == 'MENUNGGU PEMBAYARAN' && $data[0]->payment_status == 'BELUM BAYAR') { ?>
                      <label class="badge badge-info">Menunggu Pembayaran</label>
                      <?php } else if ($data[0]->order_status == 'MENUNGGU PEMBAYARAN' && $data[0]->payment_status == 'SUDAH UPLOAD') { ?>
                      <label class="badge badge-info">Menunggu Konfirmasi Pembayaran</label>
                      <?php } else if ($data[0]->order_status == 'MENUNGGU PEMBAYARAN' && $data[0]->payment_status == 'DITOLAK') { ?>
                      <label class="badge badge-info">Pembayaran Ditolak</label>
                      <?php } else if ($data[0]->order_status == 'SELESAI') { ?>
                      <label class="badge badge-success">Selesai</label>
                      <?php } else if ($data[0]->order_status == 'DIBATALKAN') { ?>
                      <label class="badge badge-danger">Dibatalkan</label>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>

                <a class="btn btn-light" href="/protechapp/index.php/Controller_Order/getAll/<?=$data[0]->technician_code?>">Kembali</a>

                
                <?php if ($data[0]->order_status == 'DITERIMA') { ?>
                  <a class="btn btn-info" href="../confirmOrderTechnician/<?php echo $data[0]->order_code ?>/DALAM PROSES"><i class="mdi mdi-check-circle-outline"></i>Diproses</a>
                <?php } else if ($data[0]->order_status == 'DALAM PROSES') { ?>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#modalSelesai"></i>Selesai</button>
                <?php } ?>
                <?php if ($data[0]->order_status == 'SELESAI' && !empty($review)) { ?>
                  <button class="btn btn-success" data-toggle="modal" data-target="#modalLihatUlasan"></i>Lihat Ulasan</button>
                <?php } ?>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Detail Layanan</h4>
                <?php foreach ($data_detail as $data_detail) { ?>
                  <div class="row">
                    <div class="col-md-4 d-flex align-items-center">
                      <div class="d-flex flex-row align-items-center">
                        <i class="mdi mdi-checkbox-marked-outline icon-md text-warning"></i>
                          <p class="mb-0 ml-1">
                            <?=$data_detail->service_type_name?> ( Rp <?php echo number_format($data_detail->price,2,',','.'); ?> )
                          </p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <br>
                <?php if ($data[0]->order_status == 'DALAM PROSES') { ?>
                <button class="btn btn-info btn-md" data-toggle="modal" data-target="#myModalNorm"><i class="mdi mdi-plus"></i>Tambah Layanan</button>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php require 'application/views/footer.php'; ?>
<script type="text/javascript">
  
</script>
</body>
</html>