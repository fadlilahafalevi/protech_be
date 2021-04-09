<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TEKNISI APP
    </title>
    <style type="text/css">
      #centered-text-table {
        text-align: center; 
        vertical-align: middle;
      }
    </style>
  </head>
  <body>
    <?php require 'application/views/header.php'; ?>
    <?php require 'application/views/sidebar.php'; ?>
    <!-- first row starts here -->
    <div class="main-panel">
      <div class="content-wrapper">
        <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Order/inputOrder'; ?>">
          <input type="hidden" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $jenis_layanan ?>" />
          <input type="hidden" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" value="<?php echo $waktu_perbaikan ?>" />
          <input type="hidden" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>" />
          <input type="hidden" class="form-control" id="catatan_alamat" name="catatan_alamat" value="<?php echo $catatan_alamat ?>" />
          <input type="hidden" class="form-control" id="foto_kerusakan" name="foto_kerusakan" value="<?php echo $foto_kerusakan ?>" />
          <!-- <img src="data:image/png;base64,<?php echo $foto_kerusakan ?>" alt="Red dot" /> -->
          <input type="hidden" class="form-control" id="detail_keluhan" name="detail_keluhan" value="<?php echo $detail_keluhan ?>" />
          <input type="hidden" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="<?php echo $metode_pembayaran ?>" />
          <input type="hidden" class="form-control" id="latitude" name="latitude" value="<?php echo $latitude ?>" />
          <input type="hidden" class="form-control" id="longitude" name="longitude" value="<?php echo $longitude ?>" />
          <input type="hidden" class="form-control" id="service_category_code" name="service_category_code" value="<?php echo $service_category_code ?>" />
          <input type="hidden" class="form-control" id="service_type_code" name="service_type_code" value="<?php echo $service_type_code ?>" />
          <input type="hidden" class="form-control" id="tech_code" name="tech_code" value="<?php echo $technician_code ?>" />
          <!-- <?php print_r($service_type) ?> -->
          <div class="col-12 grid-margin">
            <div class="card">
              <!-- <div class="card-body"> -->
                <div class="card-body" style="">
                  <font size="4" face="Courier New" >
                  <table style="border-collapse:separate; border-spacing:0 15px; width: 910px; ">
                    <tr" style="padding-bottom: 1em;">
                      <th colspan="3" id="centered-text-table">DETAIL PEMESANAN - <?php echo $service_category[0]->service_category_name ?></th>
                    </tr>
                    <tr>
                      <th colspan="3" id="centered-text-table">--------------------------------------------</th>
                    </tr>
                    <tr>
                      <td width="200px">Jenis Layanan</td>
                      <td width="10px">:</td>
                      <td width="700px"><?php echo $jenis_layanan ?></td>
                    </tr>
                    <tr>
                      <td>Layanan</td>
                      <td>:</td>
                      <td><?php echo $service_type[0]->service_type_name ?></td>
                    </tr>
                    <tr>
                      <td>Waktu Perbaikan</td>
                      <td>:</td>
                      <td><?php echo $waktu_perbaikan ?></td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>:</td>
                      <td><?php echo $alamat ?></td>
                    </tr>
                    <tr>
                      <td>Foto Kerusakan</td>
                      <td>:</td>
                      <td><img src="data:image/png;base64,<?php echo $foto_kerusakan ?>" style="max-width: 200px" alt="Red dot" /></td>
                    </tr>
                    <tr>
                      <td>Detail Keluhan</td>
                      <td>:</td>
                      <td><?php echo $detail_keluhan ?></td>
                    </tr>
                    <tr>
                      <td>Metode Pembayaran</td>
                      <td>:</td>
                      <td><?php echo $metode_pembayaran ?></td>
                    </tr>
                    <tr>
                      <td>Nama Teknisi</td>
                      <td>:</td>
                      <td><?php echo $technician[0]->first_name.' '.$technician[0]->middle_name.' '.$technician[0]->last_name ?></td>
                    </tr>
                  </table>
                </font>
                <br>
        <button style="align-content: center;" type="submit" class="btn btn-success">Konfirmasi</button>
                </div>
            <!-- </div> -->
          </div>
        </div>
            </form>
          </div>
<?php require 'application/views/footer.php'; ?>
      </div>
</body>
</html>
