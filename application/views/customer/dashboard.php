<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>TEKNISI APP</title>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">


<style>
  html, body{
      font-size: 100%;
    font-family:Arial, Helvetica, sans-serif;
  }
  body{
    background:#FFFFFF;
  }
  h2{font-size:24px; font-weight:bold; text-transform:uppercase; text-align:center;}
  .services{
    padding:4em 0;
  }

  /*-- services --*/
  .services{
    background:#00CCCC;
  }
  .agile-heading h3{
    text-align:center;
  }
  .wthree-services-grids{
    margin:4em 0 0 0;
  }
  .wthree-services-grid {
    overflow: hidden;
    position: relative;
    display: block;
    box-shadow: 0 0px 1px rgb(107, 107, 107),0 1px 2px rgba(0,0,0,.24);
  }
  .wthree-services-info{
      padding: 6em 0;
      background: #FFFFFF;
      text-align: center;
  }
  .wthree-services-info i.fa.fa-wrench,.wthree-services-info i.fa.fa-comment-o,.wthree-services-info i.fa.fa-scissors,.wthree-services-info i.fa.fa-thumbs-o-up,.wthree-services-info i.fa.fa-bell-o,.wthree-services-info i.fa.fa-sun-o,.wthree-services-info i.fa.fa-credit-card,.wthree-services-info i.fa.fa-bullhorn{
    color: #212121;
      font-size: 3em;
  }
  .wthree-services-info h4{
      color: #212121;
      font-size: 1.2em;
      margin: 1em 0 0 0;
      text-transform: uppercase;
      font-weight: 600;
  }
  .services-border{
      width: 30%;
      margin: 1em auto 0;
      border: double 4px #000;
  }
  .wthree-services-captn {
    height: 100%;
      width: 100%;
      position: absolute;
      padding: 6em 1em;
      text-align: center;
      top: -100%;
      right: 0;
      background-color: #5D322F;
     -o-transition: all 0.5s ease;
      -moz-transition: all 0.5s ease;
      -ms-transition: all 0.5s ease;
      -webkit-transition: all 0.5s ease;
      transition: all 0.5s ease;
  }
  .wthree-services-captn h4 {
      color: #fff;
      font-size: 1em;
      text-transform: uppercase;
      font-weight: 600;
      letter-spacing: 4px;
      margin: 0;
  }
  .wthree-services-captn p {
      font-size: .9em;
      margin-top: 1em;
      color: #fff;
      line-height: 1.8em;
  }
  .wthree-services-grid:hover .wthree-services-captn {
    display:block;
    top: 0%;
  }
  .services-grids1{
    margin:2em 0 0 0 !important;
  }

  .download-div{text-align:center; margin-top:40px; padding:40px 0px; clear:both;}
  .download{
    padding:10px 30px;
    background-color:#006699;
    color:#000000;
    font-size:24px;
    text-transform:uppercase;
    text-decoration:none;
    margin-top:2px;
    border-radius:10px;
  }
</style>
</head>
<body>
<?php require 'application/views/header.php'; ?>
<?php require 'application/views/sidebar.php'; ?>

<!-- services -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="container">
      <h2>Layanan apa yang Anda butuhkan?</h2>
        <div class="row">
          <?php 
            $no=0;
            foreach ($listCategory as $listCategory){
              $no++;
          ?>
          <div class="col-sm-3 wthree-services" style="margin-top: 20px;">
            <div class="wthree-services-grid">
              <div class="wthree-services-info">
                <i class="fa fa-wrench" aria-hidden="true"></i>
                <h4><?php echo $listCategory->service_category_name ?></h4><br>
                <center><a href="/teknisi-app/index.php/Controller_Order/preorder/<?php echo $listCategory->service_category_code ?>" class="btn btn-success">Pesan</a></center>
              </div>
            </div>
          </div>
          <?php } ?>
          <div class="clearfix"> </div>
        </div>
      </div>
    </div>
  </div>
  <!-- //services -->
</div>
<!-- content-wrapper ends -->
<?php require 'application/views/footer.php'; ?>
</body>
</html>