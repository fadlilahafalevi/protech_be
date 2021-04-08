<!DOCTYPE html>
<html>
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>TEKNISI APP</title>

       <style>
      #map {
        width: 100%;
        height: 300px;
        border: 1px solid #000;
      }
    </style>

    <link crossorigin="anonymous" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" rel="stylesheet">
    <script crossorigin="anonymous" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script crossorigin="anonymous" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script crossorigin="anonymous" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="/protech/assets/css/bootstrap-datetimepicker.min.css" type="text/css" media="all" />
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="/protech/assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/protech/assets/js/demo.js"></script>
</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>

<!-- first row starts here -->
  <div class="main-panel">
    <div class="content-wrapper">
      <form class="form-sample" method="post" action="<?php echo base_url() . 'Controller_Order/confirmOrder'; ?>">
        <input type="hidden" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $jenis_layanan ?>" />
        <input type="hidden" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" value="<?php echo $waktu_perbaikan ?>" />
        <input type="hidden" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>" />
        <input type="hidden" class="form-control" id="catatan_alamat" name="catatan_alamat" value="<?php echo $catatan_alamat ?>" />
        <input type="hidden" class="form-control" id="foto_kerusakan" name="foto_kerusakan" value="<?php echo $foto_kerusakan ?>" />
        <input type="hidden" class="form-control" id="detail_keluhan" name="detail_keluhan" value="<?php echo $detail_keluhan ?>" />
        <input type="hidden" class="form-control" id="metode_pembayaran" name="metode_pembayaran" value="<?php echo $metode_pembayaran ?>" />
        <input type="hidden" class="form-control" id="latitude" name="latitude" value="<?php echo $latitude ?>" />
        <input type="hidden" class="form-control" id="longitude" name="longitude" value="<?php echo $longitude ?>" />
        <input type="hidden" class="form-control" id="service_category_code" name="service_category_code" value="<?php echo $service_category_code ?>" />
        <input type="hidden" class="form-control" id="service_type_code" name="service_type_code" value="<?php echo $service_type_code ?>" />
      <div class="col-12 grid-margin">
          <div class="card">
                <div class="card-body">
                  <p class="card-title">Nearest Technician</p>
                  <div class="table-responsive" style="overflow-x: visible;">
                    <div id="recent-purchases-listing_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                      <div class="row">
                        <div class="col-sm-12 col-md-6">
                        </div>
                        <div class="col-sm-12 col-md-6">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="recent-purchases-listing" class="table dataTable no-footer" role="grid">
                            <thead>
                              <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 2px;">No</th>
                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Status report: activate to sort column ascending" style="width: 30px;">Nama</th>
                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 216px;">Jarak</th>
                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending" style="width: 113px;">Nilai</th>
                                <th class="sorting" tabindex="0" aria-controls="recent-purchases-listing" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 166px;">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i=0; foreach ($nearestTech as $teknisi) { ?>
                              <?php if (0 == $i % 2) { ?>
                              <tr role="row" class="even">
                                <td class="sorting_1"><?php echo $teknisi->row_number ?></td>
                                <td hidden="hidden'"><input type="text" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" value="<?php echo $teknisi->tech_id ?>" /></td>
                                <td><?php echo $teknisi->first_name.' '.$teknisi->middle_name.' '.$teknisi->last_name ?></td>
                                <td><?php echo $teknisi->distance ?> KM</td>
                                <td>ini belum</td>
                                <td><input style="padding: 0.5rem 1rem" type='submit' class="btn btn-success" name='submit' value='Pilih'></td>
                              </tr>
                                <?php } else { ?>
                              <tr role="row" class="odd">
                                <td class="sorting_1"><?php echo $i ?></td>
                                <td hidden="hidden'"><input type="text" class="form-control" id="waktu_perbaikan" name="waktu_perbaikan" value="<?php echo $teknisi->tech_id ?>" /></td>
                                <td><?php echo $teknisi->first_name.' '.$teknisi->middle_name.' '.$teknisi->last_name ?></td>
                                <td><?php echo $teknisi->distance ?></td>
                                <td>ini belum</td>
                                <td><input style="padding: 0.5rem 1rem" type='submit' class="btn btn-success" name='submit' value='Pilih'></td>
                              </tr>  
                                <?php } } $i++; ?> 
                             </tbody>
                           </table>
                         </div>
                       </div>
                       <div class="row">
                        <div class="col-sm-12 col-md-5">
                          
                        </div>
                        <div class="col-sm-12 col-md-7">
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </form>
        </div>
      </div>
    </form>
    </div>
  </div>
<?php require 'application/views/footer.php'; ?>

</body>
</html>