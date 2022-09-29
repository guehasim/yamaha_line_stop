<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Form Import Data Karyawan</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li class="dropdown">
								
							</li>
						</ul>
						<div class="clearfix"></div>
						<div>
			              <?php echo $this->session->flashdata('msg'); ?>
			            </div> 
					</div>
					<div class="x_content">
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo base_url(); ?>Import/importFile" enctype="multipart/form-data">

							<div class="col-md-6 col-sm-12">
									<label class="col-form-label label-align" for="first-name">Pilih File <span class="required">*</span>
									</label>
									<div>
										<input type="file" name="uploadFile" class="form-control" required>
									</div>
									<label class="col-form-label label-align" for="first-name">Format Excel Klik <a href="<?php echo base_url() ?>assets/import/format_import_karyawan.xlsx" style="color:#020af2">Download </a></label>
								</div>
							<div class="col-md-6 col-sm-12">
									<label class="col-form-label label-align" for="first-name">&nbsp;
									</label>									
									<div class="item form-group">
										<!-- <div class="col-md-6 col-sm-6 offset-md-3"> -->
											<input type="submit" name="submit" class="btn btn-success" value="Upload">
											<a href="<?php echo base_url() ?>karyawan"><button class="btn btn-primary" type="button">Kembali</button></a>
										<!-- </div> -->
									</div>
							</div>
						</form>

						<div class="col-md-6 col-sm-12">
							<table class="table table-bordered">
								<thead>
									<th>NIK</th>
									<th>Nama</th>
									<th>Dept</th>
									<th>Username</th>
									<th>Password</th>
									<th>Status</th>
								</thead>
								<tbody>
									<?php foreach ($user->result() as $ad): ?>
									<tr>
										<td><?php echo $ad->NikUser_Temp;?></td>
										<td><?php echo $ad->NamaUser_Temp;?></td>
										<td><?php echo $ad->DeptUser_Temp;?></td>
										<td><?php echo $ad->Username_Temp;?></td>
										<td><?php echo "*****";?></td>
										<?php if ($ad->NikUser == ''): ?>											
											<td style="color:#fc0303;"><?php echo "No Upload";?></td>
										<?php else: ?>
											<td style="color:#03fc13;"><?php echo "Upload Sukses";?></td>
										<?php endif ?>
									</tr>
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