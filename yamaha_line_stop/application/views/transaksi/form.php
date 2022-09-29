 <?php if ($baru == 1): ?>

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
<!-- =========================================SIMPAN DATA================================================ -->
 	<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Create Stop Line Report</h2>
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
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo base_url(); ?>transaksi/simpan" enctype="multipart/form-data">							

							<div class="row">						

								<?php foreach ($karyawan->result() as $ad): ?>

								<?php $cek_status = $this->session->userdata('ses_StatusUser');?>

									<div class="col-md-12 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Line Report Date <span class="required">*</span>
										</label>
										<div>
											 <input id="birthday" name="tanggal_now" class="date-picker form-control font-size-16 col-md-2" type="text" onfocus="this.type='date'" onclick="this.type='date'" required>
					                           <script>
					                              function timeFunctionLong(input) {
					                                setTimeout(function() {
					                                  input.type = 'text';
					                                }, 60000);
					                              }
					                            </script>
										</div>
									</div>
									<div class="col-md-5 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Estimate Line Stop Date Begin <span class="required">*</span>
										</label>
										<div>
											 <input id="birthday" name="tanggal_begin" class="date-picker form-control font-size-16" type="text" onfocus="this.type='date'" onclick="this.type='date'" required>
					                           <script>
					                              function timeFunctionLong(input) {
					                                setTimeout(function() {
					                                  input.type = 'text';
					                                }, 60000);
					                              }
					                            </script>
										</div>
									</div>

									<div class="col-md-5 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Estimate Line Stop Date After <span class="required">*</span>
										</label>
										<div>
											 <input id="birthday" name="tanggal_after" class="date-picker form-control font-size-16" type="text" onfocus="this.type='date'" onclick="this.type='date'" required>
					                           <script>
					                              function timeFunctionLong(input) {
					                                setTimeout(function() {
					                                  input.type = 'text';
					                                }, 60000);
					                              }
					                            </script>
										</div>
									</div>

								<?php if ($cek_status == 0): ?>
									<div class="col-md-4 col-sm-12">
										<label class="col-form-label label-align" for="first-name">NIK <span class="required">*</span>
										</label>
										<div><input type="text" onkeypress="loadIdentitas()" id="nik_pilih" name="nik" class="form-control" required></div>
									</div>
									<div id="tampil_id"></div>
									<div class="col-md-4 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Nama
										</label>
										<div id="tampil_nama"><input type="text" class="form-control" disabled></div>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Dept
										</label>
										<div id="tampil_dept"><input type="text" class="form-control" disabled></div>
									</div>
								<?php else: ?>
									<div class="col-md-4 col-sm-12">
										<label class="col-form-label label-align" for="first-name">NIK <span class="required">*</span>
										</label>
										<div>
											<input type="text" value="<?php echo $ad->NikUser;?>" id="first-name" class="form-control" disabled>
										</div>
									</div>
									<input type="hidden" name="karyawan" value="<?php echo $this->session->userdata('ses_IdUser'); ?>">
									<div class="col-md-4 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Nama
										</label>
										<div>
											<input type="text" value="<?php echo $ad->NamaUser;?>" id="first-name" class="form-control" disabled>
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Dept
										</label>
										<div>
											<input type="text" value="<?php echo $ad->DeptUser;?>" id="first-name" class="form-control" disabled>
										</div>
									</div>
								<?php endif ?>

								<?php endforeach ?>
								<div class="col-md-6 col-sm-12">
									<label class="col-form-label label-align" for="first-name">Kategori <span class="required">*</span>
									</label>
									<select class="form-control" name="kategori" onclick="loadKategori()" id="kategori_pilih" required>
											<option value=""></option>
										<?php foreach ($kategori->result() as $ad): ?>
											<option value="<?php echo $ad->ID_Kategori;?>"><?php echo $ad->NamaKategori;?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="col-md-6 col-sm-12">
									<label class="col-form-label label-align" for="first-name">Detail Kategori <span class="required">*</span>
									</label>
									<div id="kategori">
										<select class="form-control" name="detail_kategori" required>
											<option value=""></option>
										</select>
									</div>
									
								</div>
								<div class="col-md-12 col-sm-12">
									<label class="col-form-label label-align" for="first-name">Deskripsi <span class="required">*</span>
									</label>
									<div>
										<textarea class="form-control" name="deskripsi" required></textarea>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<label class="col-form-label label-align" for="first-name">Dokument Upload <span class="required">*</span>
									</label>
									<div>
										<input type="file" name="image" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<label class="col-form-label label-align" for="first-name">&nbsp;
									</label>									
									<div class="item form-group">
										<!-- <div class="col-md-6 col-sm-6 offset-md-3"> -->
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="<?php echo base_url() ?>transaksi"><button class="btn btn-primary" type="button">Kembali</button></a>
										<!-- </div> -->
									</div>
								</div>
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 	
<!-- ==================================UPDATE DATA======================================================= -->

 <?php else: ?>

 <script type="text/javascript">
        function loadKategori2()
        {
            var tiket = $("#kategori_pilih2").val();
            $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>kategori/pilih_kategori",
                data:"id=" + tiket,
                success: function(html)
                { 
                   $("#kategori2").html(html);
                }
            }); 
        }

        function loadIdentitas2() 
        {
        	var nik = $("#nik_pilih2").val();

        	$.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>karyawan/pilih_id",
                data:"id=" + nik,
                success: function(html)
                { 
                   $("#tampil_id2").html(html);
                }
            });

            $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>karyawan/pilih_nama",
                data:"id=" + nik,
                success: function(html)
                { 
                   $("#tampil_nama2").html(html);
                }
            });

            $.ajax({
                type:'GET',
                url:"<?php echo base_url(); ?>karyawan/pilih_dept",
                data:"id=" + nik,
                success: function(html)
                { 
                   $("#tampil_dept2").html(html);
                }
            });
        }
    </script>

 <div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Form Update Live Ticket</h2>
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
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo base_url(); ?>transaksi/update" enctype="multipart/form-data">

							<?php foreach ($transaksi->result() as $ad): ?>							
							
							<div class="col-md-12 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Line Report Date <span class="required">*</span>
										</label>
										<div>
											 <input id="birthday" name="tanggal_now" value="<?php echo date('d-m-Y',strtotime($ad->TglNow)) ?>" class="date-picker form-control font-size-16 col-md-2" type="text" onfocus="this.type='date'" onclick="this.type='date'" required>
					                           <script>
					                              function timeFunctionLong(input) {
					                                setTimeout(function() {
					                                  input.type = 'text';
					                                }, 60000);
					                              }
					                            </script>
										</div>
									</div>
									<div class="col-md-5 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Estimate Line Stop Date Begin <span class="required">*</span>
										</label>
										<div>
											 <input id="birthday" name="tanggal_begin" value="<?php echo date('d-m-Y',strtotime($ad->TglBegin)) ?>" class="date-picker form-control font-size-16" type="text" onfocus="this.type='date'" onclick="this.type='date'" required>
					                           <script>
					                              function timeFunctionLong(input) {
					                                setTimeout(function() {
					                                  input.type = 'text';
					                                }, 60000);
					                              }
					                            </script>
										</div>
									</div>

									<div class="col-md-5 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Estimate Line Stop Date After <span class="required">*</span>
										</label>
										<div>
											 <input id="birthday" name="tanggal_after" value="<?php echo date('d-m-Y',strtotime($ad->TglAfter)) ?>" class="date-picker form-control font-size-16" type="text" onfocus="this.type='date'" onclick="this.type='date'" required>
					                           <script>
					                              function timeFunctionLong(input) {
					                                setTimeout(function() {
					                                  input.type = 'text';
					                                }, 60000);
					                              }
					                            </script>
										</div>
									</div>
							<div class="col-md-4 col-sm-12">
								<label class="col-form-label label-align" for="first-name">NIK <span class="required">*</span>
								</label>
								<div>
									<input type="text" onkeypress="loadIdentitas2()" id="nik_pilih2" value="<?php echo $ad->NikUser;?>" name="nik" class="form-control">
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<label class="col-form-label label-align" for="first-name">Nama
								</label>
								<div id="tampil_nama2">
									<input type="text" value="<?php echo $ad->NamaUser;?>" id="first-name" class="form-control" disabled>
								</div>
							</div>
							<div class="col-md-4 col-sm-12">
								<label class="col-form-label label-align" for="first-name">Dept
								</label>
								<div id="tampil_dept2">
									<input type="text" value="<?php echo $ad->DeptUser;?>" id="first-name" class="form-control" disabled>
								</div>
							</div>
							<div id="tampil_id2"><input type="hidden" name="karyawan" value="<?php echo $ad->ID_User;?>" class="form-control"></div>

							<input type="hidden" name="id_transaksi" value="<?php echo $ad->ID_Transaksi;?>" >

							<div class="col-md-6 col-sm-12">
								<label class="col-form-label label-align" for="first-name">Kategori <span class="required">*</span>
								</label>
								<select class="form-control" name="kategori" onclick="loadKategori2()" id="kategori_pilih2" required>
									<?php foreach ($kategori->result() as $as): ?>
										<?php if ($ad->ID_Kategori == $as->ID_kategori): ?>
											<?php $tampil = "selected"; ?>
										<?php else: ?>
											<?php $tampil = ""; ?>
										<?php endif ?>
										<option value="<?php echo $as->ID_Kategori;?>" <?php echo $tampil;?>><?php echo $as->NamaKategori;?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-md-6 col-sm-12">
								<label class="col-form-label label-align" for="first-name">Detail Kategori <span class="required">*</span>
								</label>
								<div id="kategori2">
									<select class="form-control" name="detail_kategori" required>
										<option value="<?php echo $ad->ID_DetailKategori ?>"><?php echo $ad->NamaDetailKategori;?></option>
									</select>
								</div>
								
							</div>
							
							<div class="col-md-12 col-sm-12">
								<label class="col-form-label label-align" for="first-name">Deskripsi <span class="required">*</span>
								</label>
								<div>
									<textarea class="form-control" name="deskripsi" required><?php echo $ad->Deskripsi;?></textarea>
								</div>
							</div>
							<div class="col-md-12 col-sm-12">
								<label class="col-form-label label-align" for="first-name">Document Upload <span class="required">*</span>
								</label>
								<div>
									<?php if ($ad->DocBegin != NULL): ?>
		                              <a href="<?php echo base_url() ?>assets/upload/files/<?php echo $ad->DocBegin;?>"><span class="badge badge-primary" style="font-size: 15px;"><i class="fa fa-download"></i> Download</span></a>
		                            <?php else: ?>
		                              <?php echo "-"; ?>
		                            <?php endif ?>
								</div>
								<br>
								<div>
									<input type="file" name="image" class="form-control">
								</div>
							</div>


							<?php endforeach ?>

							<div class="col-md-6 col-sm-12">
									<label class="col-form-label label-align" for="first-name">&nbsp;
									</label>									
									<div class="item form-group">
										<!-- <div class="col-md-6 col-sm-6 offset-md-3"> -->
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="<?php echo base_url() ?>transaksi"><button class="btn btn-primary" type="button">Kembali</button></a>
										<!-- </div> -->
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