<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TEKNISI APP</title>

</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>
<script type="text/javascript">
  $('.datepicker').datepicker();
</script>
<!-- first row starts here -->
  <div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-10 col-12">
                  <h4 class="card-title">Data Pengaduan</h4>
                </div>
                <form class="form-inline justify-content-center" method="post" action="<?php echo base_url() . 'Controller_Complain'; ?>" enctype="multipart/form-data">
                <!-- <form class="form-inline justify-content-center"> -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mulai Tanggal</label>
                        <div class="col-sm-9">
                          <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input name="from_date" type="search" class="form-control datetimepicker-input" data-target="#datetimepicker1" value="<?php echo $from_date?>" read-only="true" />
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="mdi mdi-calendar-clock"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sampai Tanggal</label>
                        <div class="col-sm-9">
                          <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                            <input name="to_date" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" value="<?php echo $to_date?>" read-only />
                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="mdi mdi-calendar-clock"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <button type="submit" class="btn btn-success btn-sm">Filter</button>
                  &nbsp;
                  <a class="btn btn-primary btn-sm" href="/protechapp/index.php/Controller_Complain/printComplain/<?=$from_date?>/<?=$to_date?>">Cetak</a>
                </form>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th style="text-align: center">Kode Pengaduan</th>
                      <th style="text-align: center">Kode Pesanan</th>
                      <th style="text-align: center">Judul Pengaduan</th>
                      <th style="text-align: center">Status</th>
                      <th style="text-align: center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no=0;
                      foreach ($list as $list_complain){
                      $no++;
                    ?>
                      <tr>
                        <td><?=$list_complain->complain_code?></td>
                        <td><?=$list_complain->order_code?></td>
                        <td><?=$list_complain->subject?></td>
                        <td><?=$list_complain->complain_status?></td>
                        <td style="text-align: center">
                          <a class="btn btn-primary" href="/protechapp/index.php/Controller_Complain/getOne/<?=$list_complain->complain_code?>" data-toggle="tooltip" title="Lihat" style="padding: 4px">
                            <i class="mdi mdi-eye"></i>
                          </a>
                          <a class="btn btn-primary" href="/protechapp/index.php/Controller_Complain/updateComplain/<?=$list_complain->complain_code?>" data-toggle="tooltip" title="Ubah" style="padding: 4px">
                            <i class="mdi mdi-pencil"></i>
                          </a>
                        </td>
                      </tr>
                    <?php
                      }
                    ?>    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
   var bindDateRangeValidation = function (f, s, e) {
    if(!(f instanceof jQuery)){
      console.log("Not passing a jQuery object");
    }
  
    var jqForm = f,
        startDateId = s,
        endDateId = e;
  
    var checkDateRange = function (startDate, endDate) {
        var isValid = (startDate != "" && endDate != "") ? startDate <= endDate : true;
        return isValid;
    }

    var bindValidator = function () {
        var bstpValidate = jqForm.data('bootstrapValidator');
        var validateFields = {
            startDate: {
                validators: {
                    notEmpty: { message: 'This field is required.' },
                    callback: {
                        message: 'Start Date must less than or equal to End Date.',
                        callback: function (startDate, validator, $field) {
                            return checkDateRange(startDate, $('#' + endDateId).val())
                        }
                    }
                }
            },
            endDate: {
                validators: {
                    notEmpty: { message: 'This field is required.' },
                    callback: {
                        message: 'End Date must greater than or equal to Start Date.',
                        callback: function (endDate, validator, $field) {
                            return checkDateRange($('#' + startDateId).val(), endDate);
                        }
                    }
                }
            },
            customize: {
                validators: {
                    customize: { message: 'customize.' }
                }
            }
        }
        if (!bstpValidate) {
            jqForm.bootstrapValidator({
                excluded: [':disabled'], 
            })
        }
      
        jqForm.bootstrapValidator('addField', startDateId, validateFields.startDate);
        jqForm.bootstrapValidator('addField', endDateId, validateFields.endDate);
      
    };

    var hookValidatorEvt = function () {
        var dateBlur = function (e, bundleDateId, action) {
            jqForm.bootstrapValidator('revalidateField', e.target.id);
        }

        $('#' + startDateId).on("dp.change dp.update blur", function (e) {
            $('#' + endDateId).data("DateTimePicker").setMinDate(e.date);
            dateBlur(e, endDateId);
        });

        $('#' + endDateId).on("dp.change dp.update blur", function (e) {
            $('#' + startDateId).data("DateTimePicker").setMaxDate(e.date);
            dateBlur(e, startDateId);
        });
    }

    bindValidator();
    hookValidatorEvt();
};

 $(function() {
  var dateFormat = "YYYY-MM-DD";

  $("#datetimepicker1").datetimepicker({
    format: dateFormat
  });

  $("#datetimepicker2").datetimepicker({
    format: dateFormat
  });
});

</script>

<?php require 'application/views/footer.php'; ?>
</body>
</html>