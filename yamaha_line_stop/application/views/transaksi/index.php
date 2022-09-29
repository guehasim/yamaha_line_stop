       <?php error_reporting(0); ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h2>Stop Line</h2>
              </div>

            </div>

            <div class="clearfix"></div>
            <div>
              <?php echo $this->session->flashdata('msg'); ?>
            </div> 

            <div class="row">              
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo base_url() ?>transaksi/newTransaksi"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Stop Line</button></a>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">

                      <form method="post" action="<?php echo base_url(); ?>transaksi/laporan">
                        <div class="col-sm-2 col-sm-2">
                          <?php
                            if(isset($_POST['period_awal'])){
                              if ($_POST['period_awal'] == NULL) {
                                $oke_awal = "";
                              }else{
                                $oke_awal = $_POST['period_awal'];
                              }
                            }else{
                              $oke_awal = "";
                            }
                              
                          ?>
                          <input id="birthday" name="period_awal" value="<?php echo $oke_awal;?>" class="date-picker form-control" type="text" onfocus="this.type='date'" onclick="this.type='date'" placeholder="Tanggal Awal" required>
                          </div>

                          <div class="col-sm-2 col-sm-2">
                          <?php
                            if(isset($_POST['period_akhir'])){
                              if ($_POST['period_akhir'] == NULL) {
                                $oke_akhir = "";
                              }else{
                                $oke_akhir = $_POST['period_akhir'];
                              }
                            }else{
                              $oke_akhir = "";
                            }
                              
                          ?>
                          <input id="birthday" name="period_akhir" value="<?php echo $oke_akhir;?>" class="date-picker form-control" type="text" onfocus="this.type='date'" onclick="this.type='date'" placeholder="Tanggal Akhir" required>
                           <script>
                              function timeFunctionLong(input) {
                                setTimeout(function() {
                                  input.type = 'text';
                                }, 60000);
                              }
                            </script>
                          </div>

                          <?php
                          
                            if ($_POST['status_transaksi'] == '0') {
                              $pilih_s = "";
                              $open_s  = "selected";
                              $close_s = "";
                            } else if($_POST['status_transaksi'] == '1') {
                              $pilih_s = "";
                              $open_s  = "";
                              $close_s = "selected";
                            } else if($_POST['status_transaksi'] == ''){
                              $pilih_s = "selected";
                              $open_s  = "";
                              $close_s = "";
                            }
                           ?>

                          <div class="col-md-2 col-sm-2 ">
                            <select class="form-control" name="status_transaksi" >
                              <option value="" <?php echo $pilih_s; ?>>-- Pilih Status --</option>
                              <option value="0" style="background-color:#fc0303; color:#FFFFFF;" <?php echo $open_s;?>>Belum Action</option>
                              <option value="1" style="background-color:#18fc03; color:#000000;" <?php echo $close_s;?>>Sudah Action</option>
                            </select>
                          </div>
                          <div class="col-md-6 col-sm-6">
                            <div class="d-inline-flex align-items-center btn btn-info py-0">
                              <i class="fa fa-search"></i>
                              <input type="submit" name="submitdata" class="btn btn-info" value="Search" style="padding-bottom: 2px;" />
                            </div>

                            <div class="d-inline-flex align-items-center btn btn-warning py-0">
                              <i class="fa fa-arrow-circle-left" style="color:#FFFFFF;"></i>
                              <input type="submit" name="submitdata" class="btn btn-warning btn-xs" style="color:#FFFFFF;padding-bottom: 2px;" value="Reset"/>
                            </div>

                            <div class="d-inline-flex align-items-center btn btn-dark py-0">
                              <i class="fa fa-print"></i>
                              <input type="submit" name="submitdata" class="btn btn-dark btn-xs button-solid" formtarget="_blank" value="Print" style="padding-bottom: 2px;" />
                            </div>

                            <div class="d-inline-flex align-items-center btn btn-success py-0">
                              <i class="fa fa-print"></i>
                              <input type="submit" name="submitdata" class="btn btn-success btn-xs" value="Excel" style="padding-bottom: 2px;" />
                            </div>
                          </div>
                          <div>
                          </div>
                        </form>   
                      <div class="col-sm-12">
                              
                      <div class="card-box table-responsive">
                      <table id="datatable-keytable" class="table table-striped table-bordered dataTable no-footer" cellspacing="0" width="100%">
                        <thead>
                          <tr>                            
                            <th >No.</th>
                            <th >Kategory Stop Line</th>
                            <th >Detail Kategory</th>
                            <th >Periode</th>
                            <th >Name</th>
                            <th >Dept</th>
                            <th >Description</th>
                            <th >Doc.After</th>
                            <th >Action</th>
                            <th >Doc.Before</th>
                            <th ></th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php $no = 1; foreach ($transaksi->result() as $ad): ?>
                          <tr>
                            <td><?php echo $no++;?></td>
                            <td><?php echo $ad->NamaKategori;?></td>
                            <td><?php echo $ad->NamaDetailKategori;?></td>
                            <td><?php echo date('d M y',strtotime($ad->TglNow));?></td>
                            <td><?php echo $ad->NamaUser;?></td>
                            <td><?php echo $ad->DeptUser;?></td>
                            <td><?php echo $ad->Deskripsi;?></td>
                            <td>
                              <?php $id = $ad->DocBegin;?>
                              <?php if ($id != null): ?>
                                <a href="<?php echo base_url() ?>assets/upload/files/<?php echo $ad->DocBegin;?>" target="_blank"><span class="badge badge-info"><i class="fa fa-download"></i> Download </span></a>
                              <?php else: ?>
                                <?php echo "-"; ?>
                              <?php endif ?>
                            </td>
                            <td>
                              <?php $id = $ad->Action;?>
                              <?php if ($id != null): ?>
                                <?php echo $ad->Action;?>
                              <?php else: ?>
                                <?php echo "-"; ?>
                              <?php endif ?>
                            </td>
                            <td>
                              <?php $id = $ad->DocAfter;?>
                              <?php if ($id != null): ?>
                                <a href="<?php echo base_url() ?>assets/upload/files/<?php echo $ad->DocAfter;?>" target="_blank"><span class="badge badge-warning"><i class="fa fa-download"></i> Download </span></a>
                              <?php else: ?>
                                <?php echo "-"; ?>
                              <?php endif ?>
                            </td>
                            <td>
                              <a href="<?php echo base_url() ?>transaksi/get_update?us=<?php echo $ad->ID_Transaksi; ?>"><span class="badge badge-info"><i class="fa fa-pencil"></i> Edit </span></a><br>

                              <?php if ($ad->Action == ''): ?>
                                <a href="<?php echo base_url() ?>transaksi/get_action?us=<?php echo $ad->ID_Transaksi; ?>"><span class="badge badge-warning"><i class="fa fa-thumbs-o-up"></i> Action </span></a><br>
                              <?php else: ?>
                                
                              <?php endif ?>                            
                              
                              <a><span class="badge badge-danger" data-toggle="modal" data-target="#hapus-info-<?php echo $ad->ID_Transaksi;?>"><i class="fa fa-trash-o"></i> Delete </span></a>
                            </td>
                          </tr>

                          <!-- modal delete -->
                          <div class="modal fade" id="hapus-info-<?php echo $ad->ID_Transaksi;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content edit-dialog-modal">
                                <form class="form-validate form-horizontal " id="register_form" action="<?php echo base_url(); ?>transaksi/delete" method="post">    
                                  <?php
                                    $this->load->helper("form");
                                  ?>
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Hapus Data Transaksi</h4>                                  
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $ad->ID_Transaksi;?>">
                                    Apakah anda benar mau menghapus kategori <b style="color:#000000;">"<?php echo $ad->NamaKategori;?>"</b> ini?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                                  </div>
                                </form>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <!-- end modal delete-->
                          
                      <?php endforeach ?>
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
        </div>
        <!-- /page content -->

<script type="text/javascript">
  $('#datatable-short').datatable({
    "columnDefs": [ {
      "targets": 'no-sort',
      "orderable": false,
    }]
  });
</script>

        