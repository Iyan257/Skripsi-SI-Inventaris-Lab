<div id="uploadModal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel">
		<?php if(in_array("kalab", $groups)) : ?>
			<?= form_open_multipart('kalab/aset/upload',['class'=>'form-horizontal mb-lg']) ?>
		<?php elseif(in_array("input_admin", $groups)) : ?>
			<?= form_open_multipart('admin/aset/upload',['class'=>'form-horizontal mb-lg']) ?>
		<?php endif; ?>
		
			<header class="panel-heading">
				<h2 class="panel-title">Form Upload Barang</h2>
			</header>
			<div class="panel-body">
				<!-- Download template Button -->
				<div class="form-group">
					<label class="col-md-4 control-label">Download template</label>
					<div class="col-md-4">
						<a href="<?= base_url('kalab/aset/downloadTemp') ?>"><i class="fa fa-download"></i> Download</a>
					</div>
				</div>

				<!-- File Button -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="filebutton">Select File</label>
					<div class="col-md-4">
						<input type="file" name="file" id="file" class="input-large">
					</div>
				</div>

				<!-- Button -->
				<div class="form-group">
					<label class="col-md-4 control-label">Import data</label>
					<div class="col-md-4">
						<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>

			</div>
		</form>
	</section>
</div>
<div id="updateModal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel">
		<?php if(in_array("kalab", $groups)) : ?>
			<?= form_open_multipart('kalab/aset/upload_update',['class'=>'form-horizontal mb-lg']) ?>
		<?php elseif(in_array("input_admin", $groups)) : ?>
			<?= form_open_multipart('admin/aset/upload_update',['class'=>'form-horizontal mb-lg']) ?>
		<?php endif; ?>
		
			<header class="panel-heading">
				<h2 class="panel-title">Form Update Asset</h2>
			</header>
			<div class="panel-body">
				<!-- File Button -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="filebutton">Select File</label>
					<div class="col-md-4">
						<input type="file" name="file" id="file" class="input-large">
					</div>
				</div>

				<!-- Button -->
				<div class="form-group">
					<label class="col-md-4 control-label">Import data</label>
					<div class="col-md-4">
						<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
						<button class="btn btn-default modal-dismiss">Cancel</button>
					</div>
				</div>

			</div>
		</form>
	</section>
</div>

<div id="searchBySpecModal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
	<section class="panel">
		<?php if(in_array("kalab", $groups)) : ?>
			<?= form_open_multipart('kalab/aset/',['method'=>'GET']) ?>
		<?php elseif(in_array("input_admin", $groups)) : ?>
			<?= form_open_multipart('admin/aset/',['method'=>'GET']) ?>
		<?php else: ?>
			<?= form_open('aset',['method'=>'GET']); ?>
		<?php endif; ?>
			<header class="panel-heading">
				<h2 class="panel-title">Pencarian berdasarkan spesifikasi</h2>
			</header>
			<div class="panel-body">
				<!-- File Button -->
				<div class="row">
					<div class="col-md-3" style="padding-left:10px;">
						<div class="form-group">
							<label class="control-label" for="type"><strong>Type</strong></label>
							<select name='type' id='type' class="form-control mb-md" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;">
								<option value="" selected>Pilih type</option>
								<?php if(count($spesifikasi['type']) > 0): ?>
									<?php foreach($spesifikasi['type'] as $k):?>
										<option value="<?=$k?>"><?=$k?></option>
									<?php endforeach;?>
								<?php endif; ?>
							</select>
						</div>
					</div>
					<div class="col-md-3 col-md-offset-1">
						<div class="form-group">
							<label class="control-label" for="processor"><strong>Processor</strong></label>
							<select name='processor' id='processor' class="form-control mb-md" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;">
								<option value="" selected>Pilih processor</option>
								<?php if(count($spesifikasi['processor']) > 0): ?>
									<?php foreach($spesifikasi['processor'] as $k):?>
										<option value="<?=$k?>"><?=$k?></option>
									<?php endforeach;?>
								<?php endif; ?>
							</select>
						</div>
					</div>
					<div class="multiselect col-md-3 col-md-offset-1">
						<div class="form-group">
							<label class="control-label" for="os"><strong>OS</strong></label>
							<div id="os" class="selectBox" onclick="showCheckboxes()">
								<select onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;">
									<option value="" selected>Pilih os</option>
								</select>
								<div class="overSelect"></div>
							</div>
							<div id="checkboxes">
								<?php if(count($spesifikasi['os']) > 0): ?>
									<?php foreach($spesifikasi['os'] as $i=>$k):?>
										<label for="<?=$i?>">
											<input type="checkbox" name="os[]" id="<?=$i?>" value="<?=$k?>"> <?=' '.$k?>
										</label>
									<?php endforeach;?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label" for="memory"><strong>Memory / RAM</strong></label>
							<select name='memory' id='memory' class="form-control mb-md" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;">
								<option value="" selected>Pilih memory</option>
								<?php if(count($spesifikasi['memory']) > 0): ?>
									<?php foreach($spesifikasi['memory'] as $k):?>
										<option value="<?=$k?>"><?=$k?></option>
									<?php endforeach;?>
								<?php endif; ?>
							</select>
						</div>
					</div>
					<div class="col-md-3 col-md-offset-1">
						<div class="form-group">
							<label class="control-label" for="hard_drive"><strong>Hard drive / HDD</strong></label>
							<select name='hard_drive' id='hard_drive' class="form-control mb-md" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;">
								<option value="" selected>Pilih HDD</option>
								<?php if(count($spesifikasi['hard_drive']) > 0): ?>
									<?php foreach($spesifikasi['hard_drive'] as $k):?>
										<option value="<?=$k?>"><?=$k?></option>
									<?php endforeach;?>
								<?php endif; ?>
							</select>
						</div>
					</div>
					<div class="col-md-3 col-md-offset-1">
						<div class="form-group">
							<label class="control-label" for="jumlah_port"><strong>Jumlah Port (Switch)</strong></label>
							<select name='jumlah_port' id='jumlah_port' class="form-control mb-md" onmousedown="if(this.options.length>4){this.size=4;}"  onchange='this.size=0;' onblur="this.size=0;">
								<option value="" selected>Pilih port</option>
								<?php if(count($spesifikasi['jumlah_port']) > 0): ?>
									<?php foreach($spesifikasi['jumlah_port'] as $k):?>
										<?php if($k != null): ?>
										<option value="<?=$k?>"><?=$k?></option>
										<?php endif; ?>
									<?php endforeach;?>
								<?php endif; ?>
							</select>
						</div>
					</div>
				</div>

				<!-- Button -->
				<div class="form-group">
					<div class="col-md-4 col-md-offset-4">
						<button type="submit" id="submit" name="spesifikasi" class="btn btn-primary button-loading">Cari</button>
						<button class="btn btn-default modal-dismiss" type="reset">Cancel</button>
					</div>
				</div>

			</div>
		</form>
	</section>
</div>

<?php if(isset($_GET['pembelian'])==false) : ?>
<section class="panel">
	<header class="panel-heading">
		<div class="row">
			<div class="col-sm-7 ">
				<h4 class = "panel-title" >Pencarian Aset / Barang</h4>
			</div>
			<div class="col-sm-5 text-right">
				<a class="modal-with-zoom-anim btn btn-info" href="#searchBySpecModal"><i class="fa fa-search"></i> Cari Spesifikasi</a>
			</div>
		</div>
	</header>
	<div class="panel-body">
		<!-- Modal Form -->

		<div class="row" style="margin-top:20px">
			<?php if(in_array("kalab", $groups)) : ?>
				<?= form_open('kalab/aset',['method'=>'GET']); ?>
			<?php elseif(in_array("input_admin", $groups)) : ?>
				<?= form_open('admin/aset',['method'=>'GET']); ?>
			<?php elseif(in_array("admin", $groups)) : ?> 
				<?= form_open('aset',['method'=>'GET']); ?>
			<?php endif; ?>
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label" for="kode">Kode</label>
						<input type="text" id="kode" name="kode" class="form-control" placeholder="kode"/>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label" for="kategori">Kategori</label>
						<select name='kategori' id='kategori' class="form-control mb-md">
							<option value="" disabled selected>Pilih kategori</option>
							<?php foreach($kategori as $k):?>
								<option value="<?=$k['id']?>"><?=$k['nama_kategori']?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label" for="ruangan">Ruangan</label>
						<select name='ruangan' id='ruangan' class="form-control mb-md">
							<option value="" disabled selected>Pilih ruangan</option>
							<?php foreach($ruangan as $r):?>
								<option value="<?=$r['id']?>"><?=$r['nama']?></option>
							<?php endforeach;?>
						</select>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label" for="thn_pembelian">Tahun Pembelian</label>
						<input type="text" id="thn_pembelian" name="thn_pembelian" class="form-control" placeholder="tahun"/>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label" for="kondisi">Kondisi</label>
						<select class="form-control mb-md"  id="kondisi" name="kondisi" placeholder="Pilih kondisi">
							<option value="" disabled selected>Pilih kondisi</option>
							<?php foreach($kondisi as $k): ?>
								<option><?=$k['nilai_acuan']?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-sm-2 center" >
					<div class="row">
						<div class="col-md-8" style="padding-top:5px;">
							<button class="btn btn-primary" type="submit">Cari</button>
						</div>
						<div class="col-md-8" style="padding-top:5px;">
							<button class="btn btn-default" type="reset">Reset </button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- start: page -->
<section class="panel">
	<header class="panel-heading">
		<div class="row align-items-center">
			<div class="col-sm-7">
				<h2 class="panel-title">Daftar Aset / Barang</h2>
			</div>
			<?php if(isset($_GET['pembelian'])) : ?>
				<div class="col-sm-5 text-right">
					<?php if(in_array("kalab", $groups)) :?>
						<a class="btn btn-primary" href="<?=base_url('kalab/aset/download_pembelian')?>"><i class="fa fa-file"></i> Download</a>	
						<a class="modal-with-zoom-anim btn btn-info" href="#updateModal"><i class="fa fa-file"></i> Update</a>
					<?php else: ?>
						<a class="btn btn-primary" href="<?=base_url('admin/aset/download_pembelian')?>"><i class="fa fa-file"></i> Download</a>	
						<a class="modal-with-zoom-anim btn btn-info" href="#updateModal"><i class="fa fa-file"></i> Update</a>
					<?php endif; ?>
				</div>
			<?php else: ?>
				<?php if(in_array("kalab", $groups)) :?>
					<div class="col-sm-5 text-right">
						<a class="btn btn-success" href="<?=base_url('kalab/aset/create')?>"><i class="fa fa-plus"></i> Tambah</a>	
					
						<a class="modal-with-zoom-anim btn btn-info" href="#uploadModal"><i class="fa fa-file"></i> Upload</a>
					
						<a class="btn btn-primary" href="<?=base_url('kalab/aset/download')?>"><i class="fa fa-file"></i> Download</a>	
					</div>

				<?php elseif(in_array("input_admin", $groups)) :?>
					<div class="col-sm-5 text-right">
						<a class="btn btn-success" href="<?=base_url('admin/aset/create')?>"><i class="fa fa-plus"></i> Tambah</a>	
					
						<a class="modal-with-zoom-anim btn btn-info" href="#uploadModal"><i class="fa fa-file"></i> Upload</a>
					
						<a class="btn btn-primary" href="<?=base_url('admin/aset/download')?>"><i class="fa fa-file"></i> Download</a>	
					</div>

				<?php elseif(in_array("admin", $groups)) : ?>

					<div class="col-sm-5 text-right">
						<a class="btn btn-secondary" href="<?=base_url('aset/download')?>"><i class="fa fa-file"></i> Download</a>	
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</header>
	<div class="panel-body">
		<?php if(isset($assets) && count($assets) > 0): ?>
			<table class="table table-bordered table-striped mb-none" id="datatable-default">
				<thead>
					<tr>
						<th id="kolom_no" style="display:none">ID</th>
						<th>Kode</th>
						<th>Nama</th>
						<th>Kategori</th>
						<th>Kategori Khusus</th>
						<th>Tanggal penerimaan</th>
						<th>Ruangan</th>
						<th>Kondisi</th>
						<?php if(in_array("kalab", $groups)): ?>
							<th>Masa pemakaian</th>
							<th>Nilai aset</th>
						<?php endif; ?>
						<th class="kolom_aksi" style="min-width:125px;">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($assets as $i => $asset): ?>
						<tr>
							<td style="display:none"><?=$asset['id'] ?></td>
							<td><?= isset($asset['kode'])? $asset['kode']: '-'?></td>
							<td><?= isset($asset['nama_aset'])? $asset['nama_aset'] : '-'?></td>
							<td><?= isset($asset['nama_kategori'])? $asset['nama_kategori'] : ''?></td>
							<td><?= isset($asset['nama_kategori_khusus'])? $asset['nama_kategori_khusus'] : '-'?></td>
							<td><?= isset($asset['tanggal_penerimaan'])? $asset['tanggal_penerimaan'] : '-'?></td>
							<td><?= isset($asset['nama'])? $asset['nama'] : '-'?></td>
							<td><?= isset($asset['kondisi'])? $asset['kondisi'] : '-'?></td>
							<?php if(in_array("kalab", $groups)) :?>
								<td><?= isset($asset['masa_pakai'])? $asset['masa_pakai'].' tahun' : '-'?></td>
								<td><?= isset($asset['nilai_aset'])? 'Rp '. number_format($asset['nilai_aset']) : '-'?></td>
								<td class="text-center" style="width:150px;">
									<a  class="btn btn-sm btn-info" href="<?= base_url('kalab/aset/' . $asset['id']) ?>" data-toggle="tooltip" data-placement="top" title="detil"><i class="fa fa-search"></i></a> 
									<a  class="btn btn-sm btn-warning" href="<?= base_url('kalab/aset/edit/' . $asset['id']) ?>" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></a> 
									<button class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"></i></button>
								</td>
								<?= form_open('kalab/aset/delete/' . $asset['id'], ['id' => "del_$i"]); ?></form>

							<?php elseif(in_array("input_admin", $groups)) : ?>
								<td class="text-center" style="width:150px;">
									<a  class="btn btn-sm btn-info" href="<?= base_url('admin/aset/' . $asset['id']) ?>" data-toggle="tooltip" data-placement="top" title="detil"><i class="fa fa-search"></i></a> 
									<a  class="btn btn-sm btn-warning" href="<?= base_url('admin/aset/edit/' . $asset['id']) ?>" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></a> 
									<button class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"></i></button>
								</td>
								<?= form_open('admin/aset/delete/' . $asset['id'], ['id' => "del_$i"]); ?></form>

							<?php elseif(in_array("admin", $groups)) : ?>
								<td class="text-center" style="width:150px;">
									<a  class="btn btn-sm btn-info" href="<?= base_url('aset/' . $asset['id']) ?>" data-toggle="tooltip" data-placement="top" title="detil"><i class="fa fa-search"></i></a> 
								</td>
							<?php endif; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php else:?>
            <div class="col center">
                <b class="text-danger">Assets list is empty.</b>
            </div>
        <?php endif; ?>
	</div>
</section>
<!-- end: page -->

<script>
	var expanded = false;

	function showCheckboxes() {
		var checkboxes = document.getElementById("checkboxes");
		if (!expanded) {
			checkboxes.style.display = "block";
			expanded = true;
		} else {
			checkboxes.style.display = "none";
			$('input[name="os[]"]').prop('checked', false);
			expanded = false;
		}
	}
</script>

<style>
.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
  max-height:90px;
  overflow:auto;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
</style>