 <?php if ($baru == 1): ?>

  <div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Form Input Detail Kategori</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo base_url(); ?>kategori/simpanDetail">

                <input type="text" name="kategori" value="<?php echo $kategori;?>" hidden>

              <div class="item form-group form-check">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Detail Kategori <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="namadetail" id="first-name" class="form-control" autofocus required>
                </div>
              </div>             

              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button type="submit" class="btn btn-success">Simpan</button>
                  <a href="<?php echo base_url() ?>kategori/detail_kategori?us=<?php echo $kategori;?>"><button class="btn btn-primary" type="button">Kembali</button></a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  
 <?php else: ?>

 <div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Form Update Kategori</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo base_url(); ?>kategori/updatedetail">

              <?php foreach ($detail->result() as $ad): ?>

              <input type="text" name="id" value="<?php echo $ad->ID_DetailKategori;?>" hidden> 
              <input type="text" name="kategori" value="<?php echo $ad->ID_Kategori;?>" hidden>             
              

              <div class="item form-group form-check">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kategori <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" name="detail" value="<?php echo $ad->NamaDetailKategori ?>" id="first-name" class="form-control" required>
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="item form-group">
                <div class="col-md-6 col-sm-6 offset-md-3">
                  <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?php echo base_url() ?>kategori/detail_kategori?us=<?php echo $ad->ID_Kategori; ?>"><button class="btn btn-primary" type="button">Kembali</button></a>
                  <?php endforeach ?>                  
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  
 <?php endif ?>

      
      <!-- /page content -->