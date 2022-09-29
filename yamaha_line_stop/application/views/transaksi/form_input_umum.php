<!DOCTYPE html>
<html lang="en">
<head>

  <?php 
  // error_reporting(0);
  ?>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Yamaha Line Stop</title>
  
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/vendor_components/bootstrap/dist/css/bootstrap.min.css">
    
    <!-- Bootstrap extend-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/css/bootstrap-extend.css">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/css/master_style.css">

    <!-- skins -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/css/skins/_all-skins.css">
    
    <!-- main-nav -->
    <link href="<?php echo base_url(); ?>assets/login/css/main-nav.css" rel="stylesheet" />    

    <!-- bootstrap datepicker --> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <!-- toast CSS -->
    <link href="<?php echo base_url(); ?>assets/login/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css" rel="stylesheet">


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

    <style>
    table{
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 1px solid $ddd;
    }
    th,td{
      text-align: center;
      padding: 8px;
      font-size: 20px;
    }
    .button3 {width: 100%;}
    tr:nth-child(even){background-color: #f2f2f2}
    </style>

    <script type="text/javascript">
        function loadKategori()
        {
            var tiket = $("#kategori_pilih").val();
            $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>kategori/pilih_kategori",
                data:"id=" + tiket,
                success: function(html)
                { 
                   $("#kategori").html(html);
                }
            }); 
        }

        function loadIdentitas() 
        {
          var nik = $("#nik_pilih").val();

          $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>karyawan/pilih_id",
                data:"id=" + nik,
                success: function(html)
                { 
                   $("#tampil_id").html(html);
                }
            });

            $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>karyawan/pilih_nama",
                data:"id=" + nik,
                success: function(html)
                { 
                   $("#tampil_nama").html(html);
                }
            });

            $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>karyawan/pilih_dept",
                data:"id=" + nik,
                success: function(html)
                { 
                   $("#tampil_dept").html(html);
                }
            });
        }
    </script>
</head>
<body class="hold-transition bg-img" style="background-image: url(<?php echo base_url(); ?>assets/login/images/bg.jpg)" data-overlay="3">    
    <div class="wrapper">
      <div class="container">
        <div class="row mt-20">         
            
          <div class="col-lg-4 col-xs-12 mb-2">
            <div class="card">
            <div class="card-body">
                <div class="header-left">
                    <!-- <form action=""></form> -->                    
                    <h4 class="bg-purple-ym m-0 p-4 text-center font-weight-bold">Already have an account<div id="show_data_pcs"></div></span></h4>                    
                    <br>
                    <div class="form-group">
                    <a href="<?php echo base_url() ?>admin"><button type="submit" class="btn btn-danger button3">SIGN IN <i class="fa fa-arrow-right"></i></button></a>
                  </div>
                    
                </div>
                
              </div>
            </div>
          </div>
          <div class="col-lg-8 col-xs-12">
            <div class="card">
              <div class="card-body">
                <h2 class="bg-purple-ym p-2 text-center font-weight-bold">Create Stop Line Report</h2>

                <div>
                  <?php echo $this->session->flashdata('msg'); ?>
                </div> 
                  
                <form data-parsley-validate method="POST" action="<?php base_url();?>transaksi/simpan" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="" class="mb-1 font-weight-bold font-size-16">Line Report Date<span class="required">*</span></label>
                    <input id="birthday" name="tanggal_now" class="date-picker form-control font-size-16" type="text" onfocus="this.type='date'" onclick="this.type='date'"  required>
                           <script>
                              function timeFunctionLong(input) {
                                setTimeout(function() {
                                  input.type = 'text';
                                }, 60000);
                              }
                            </script>
                  </div>

                  <div class="form-group">
                    <label for="" class="mb-1 font-weight-bold font-size-16">Estimate Line Stop Date Begin<span class="required">*</span></label>
                    <input id="birthday" name="tanggal_begin" class="date-picker form-control font-size-16" type="text" onfocus="this.type='date'" onclick="this.type='date'"  required>
                           <script>
                              function timeFunctionLong(input) {
                                setTimeout(function() {
                                  input.type = 'text';
                                }, 60000);
                              }
                            </script>
                  </div>

                  <div class="form-group">
                    <label for="" class="mb-1 font-weight-bold font-size-16">Estimate Line Stop Date After<span class="required">*</span></label>
                    <input id="birthday" name="tanggal_after" class="date-picker form-control font-size-16" type="text" onfocus="this.type='date'" onclick="this.type='date'"  required>
                           <script>
                              function timeFunctionLong(input) {
                                setTimeout(function() {
                                  input.type = 'text';
                                }, 60000);
                              }
                            </script>
                  </div>

                  <div class="form-group">
                    <label for="" class="mb-1 font-weight-bold font-size-16">Nik Requestor<span class="required">*</span></label>
                    <input type="text" class="form-control font-size-16" onkeypress="loadIdentitas()" id="nik_pilih" name="nik" required>
                  </div>

                  <div class="form-group">
                    <label for="" class="mb-1 font-weight-bold font-size-16">Nama</label>
                    <div id="tampil_nama"><input type="text" class="form-control font-size-16" disabled></div>
                  </div>

                  <input type="hidden" name="jenis_form" value="1">

                  <div id="tampil_id"></div>

                  <div class="form-group">
                    <label for="" class="mb-1 font-weight-bold font-size-16">Departemen</label>
                    <div id="tampil_dept"><input type="text" class="form-control font-size-16" disabled></div>
                  </div>
                  
                  <div class="form-group">
                    <label for="" class="mb-1 font-weight-bold font-size-16">Kategori Stop Line<span class="required">*</span></label>
                    <select class="form-control font-size-16" name="kategori" onclick="loadKategori()" id="kategori_pilih" required>
                      <option value=""></option>
                    <?php foreach ($kategori->result() as $ad): ?>
                      <option value="<?php echo $ad->ID_Kategori;?>"><?php echo $ad->NamaKategori;?></option>
                    <?php endforeach ?>
                  </select>
                  </div>

                  <div class="form-group">
                    <label for="" class="mb-1 font-weight-bold font-size-16">Detail Stop Line Kategori <span class="required">*</span></label>
                    <div id="kategori">
                    <select class="form-control" name="detail_kategori" required>
                      <option value=""></option>
                    </select>
                  </div>
                  </div>

                  <div class="form-group">
                    <label for="" class="mb-1 font-weight-bold font-size-16">Deskripsi<span class="required">*</span></label>
                    <textarea class="form-control font-size-16" name="deskripsi" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="" class="mb-1 font-weight-bold font-size-16">Dokument Upload<span class="required">*</span></label>
                    <input type="file" class="form-control font-size-16" name="image" required>
                  </div>
                  <br> 
                  <div class="form-group text-right">
                    <button type="submit" class="btn bg-purple-ym">Create</button>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    

    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>assets/login/vendor_components/jquery-3.3.1/jquery-3.3.1.js"></script>

    <script>
      var input = document.getElementById("CheckKaryawan");
      input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
          loadKaryawan();
        }
      });
    </script>
    
    <!-- popper -->
    <script src="<?php echo base_url(); ?>assets/login/vendor_components/popper/dist/popper.min.js"></script>
    
    <!-- Bootstrap 4.0-->
    <script src="<?php echo base_url(); ?>assets/login/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- toast -->
    <script src="<?php echo base_url(); ?>assets/login/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js"></script>


  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

    <!-- bootstrap datepicker -->
  <script src="<?php echo base_url(); ?>assets/login/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <!-- JQuery Validate -->
    <script src="<?php echo base_url(); ?>assets/login/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js"></script>
    

    <script type="text/javascript">
    $( function() {
    $( "#period_awal" ).datepicker({dateFormat:'dd-mm-yy'});
  } );
    </script>

</body>
</html>
