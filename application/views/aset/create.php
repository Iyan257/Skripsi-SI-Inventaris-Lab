<section class="panel">
    <?php if(in_array("kalab", $groups)) : ?>
	    <?= form_open_multipart('kalab/aset/store', ['class' => 'form-horizontal mb-lg']) ?>
    <?php elseif(in_array("input_admin", $groups)) : ?>
        <?= form_open_multipart('admin/aset/store', ['class' => 'form-horizontal mb-lg']) ?>
    <?php endif; ?>
        <header class="panel-heading">
            <h2 class="panel-title">Form Tambah Aset</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="kode">Kode
                            <span class="required">*</span>
                        </label>
                        <div class="col-sm-7">
                            <input type="text" id="kode" name="kode" class="form-control" placeholder="kode aset" maxlength="4" required/>
                        </div>
                        <button type="button" class="col-sm-2 btn btn-primary" name="btn_random" id="btn_random">Random</button>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="nama">Nama
                            <span class="required">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="nama aset" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="merek">Merek
                            <span class="required">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" id="merek" name="merek" class="form-control" placeholder="nama merek" required/>
                        </div>
                    </div>
                    <div class="form-group" id="posisi">
                        <label class="col-sm-3 control-label" for="nomor_kursi">Nomor kursi</label>
                        <div class="col-sm-9">
                            <input type="number" id="nomor_kursi" name="nomor_kursi" class="form-control" placeholder="nomor kursi" min='1'/>
                        </div>
                    </div>
                    <div class="form-group" id="identitas_nomor">
                        <label class="col-sm-3 control-label" for="nomor_identitas">Nomor identitas</label>
                        <div class="col-sm-9">
                            <input type="number" id="nomor_identitas" name="nomor_identitas" class="form-control" placeholder="nomor identitas" value="<?= (isset($total_computer)? $total_computer+1:'') ?>" min='1'/>
                        </div>
                        <?php if(isset($total_computer)): ?>
                            <label class="col-sm-9 col-sm-offset-3" style="color:green">Ket : total komputer dengan id saat ini adalah <?= $total_computer ?></label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="kondisi">Kondisi
                            <span class="required">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select name='kondisi' id='kondisi' required>
                                <option value="baik">baik</option>
                                <option value="rusak">rusak</option>
                                <option value="sedang diperbaiki">sedang diperbaiki</option>
                                <option value="dioper ke BTI" >dioper ke BTI</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="ruangan">Ruangan
                            <span class="required">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select name='ruangan' id='ruangan' required>
                                <?php foreach($ruangan as $r):?>
                                <option value="<?=$r['id']?>"><?=$r['nama']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="kategori">Kategori aset
                            <span class="required">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select name='kategori' id='kategori' required>
                                <option value="" disabled selected>Pilih kategori</option>
                                <?php foreach($kategori as $k):?>
                                <option value="<?=$k['id']?>">
                                    <?=$k['nama_kategori']?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="kategori_khusus">Kategori khusus
                            <span class="required">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select name='kategori_khusus' id='kategori_khusus' required>
                                <option value="" disabled selected>Pilih kategori</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="spesifikasi">
                <hr>
                <div class="col-md-12">
                    <b>Spesifikasi</b>
                </div>
                <div class="col-md-12" style="margin-top:20px; margin-bottom:20px;">
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>
                                <th id="kolom_no">No</th>
                                <th>Type</th>
                                <th>Jumlah Port</th>
                                <th>Processor</th>
                                <th>OS</th>
                                <th>Memory</th>
                                <th>Hard Drive</th>
                                <th>Keterangan</th>
                                <th class="kolom_aksi">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($specification as $i => $spec): ?>
                            <tr>
                                <td>
                                    <?= (isset($spec['id']) && $spec['id']!=null)? $spec['id']: '-'?>
                                </td>
                                <td>
                                    <?= (isset($spec['type']) && $spec['type']!=null)? $spec['type']: '-'?>
                                </td>
                                <td>
                                    <?= (isset($spec['jumlah_port']) && $spec['jumlah_port']!=null)? $spec['jumlah_port']: '-'?>
                                </td>
                                <td>
                                    <?= (isset($spec['processor']) && $spec['processor']!=null)? $spec['processor']: '-'?>
                                </td>
                                <td>
                                    <?= (isset($spec['os']) && $spec['os']!=null)? $spec['os']: '-'?>
                                </td>
                                <td>
                                    <?= (isset($spec['memory']) && $spec['memory']!=null)? $spec['memory']: '-'?>
                                </td>
                                <td>
                                    <?= (isset($spec['hard_drive']) && $spec['hard_drive']!=null)? $spec['hard_drive']: '-'?>
                                </td>
                                <td>
                                    <?= (isset($spec['keterangan']) && $spec['keterangan']!=null)? $spec['keterangan']: '-'?>
                                </td>
                                <td>
                                    <input type="radio" class="radio" name="id_spesifikasi" id="id_spesifikasi" value="<?= $spec['id']?>"
                                    />
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="tanggal_penerimaan">Tanggal penerimaan
                            <span class="required">*</span>
                        </label>
                        <div class="col-sm-9">
                            <input type="date" id="tanggal_penerimaan" name="tanggal_penerimaan" class="form-control" placeholder="tanggal penerimaan"
                            required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="checkbox_penyusutan" name="checkbox_penyusutan" />
                                <label for="checkbox_penyusutan">Aset ini disusutkan ?</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="umur_aset">
                        <label class="col-sm-3 control-label" for="umur_ekonomis">Umur ekonomis</label>
                        <div class="col-sm-9">
                            <input type="number" id="umur_ekonomis" name="umur_ekonomis" class="form-control" placeholder="dalam tahun" min='0'/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <?php if(in_array("kalab", $groups)) : ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="nilai_aset">Nilai aset</label>
                        <div class="col-sm-9">
                            <input type="number" id="nilai_aset" name="nilai_aset" class="form-control" placeholder="Harga aset" min='0' />
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="userfile">Gambar</label>
                        <div class="col-sm-9">
                            <div class="col-xs-2 text-right" style="padding-top:5px;">
                                <i class="fa fa-upload"></i>
                            </div>
                            <div class="col-xs-10" style="padding-left:0;">
                                <input type="file" id="userfile" name="userfile" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="col-sm-3 control-label text-left" for="keterangan">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea type="textarea" id="keterangan" name="keterangan" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <?php if(in_array("kalab", $groups)): ?>
                        <a class="btn btn-default" href="<?= base_url('kalab/aset')?>">Cancel</a>
                    <?php elseif(in_array("input_admin", $groups)): ?>
                        <a class="btn btn-default" href="<?= base_url('admin/aset')?>">Cancel</a>
                    <?php endif; ?>
                </div>
            </div>
        </footer>
	</form>
</section>

<script>
	$(document).ready(function() {
		var arr_kat_khusus = <?php echo json_encode($kategori_khusus) ?> ;
        var total_computer = <?php echo json_encode($total_computer); ?> ;

		// menghubungkan antara kategori khusus dan kategori umum
		$("#kategori").change(function() {
			var selected_id_kategori = $('#kategori').find(":selected").val();
			$('#kategori_khusus')
				.find('option')
				.remove()
				.end()
				.append('<option value="" disabled selected>Pilih kategori</option>');

			$.each(arr_kat_khusus, function(i, elem) {
				if (elem['id_kategori'] == selected_id_kategori) {
					$('#kategori_khusus')
						.append('<option value="' + elem['id'] + '">' + elem['nama_kategori_khusus'] + '</option>');
				}
			});
		});

        // spesifikasi untuk komputer / switch / router
        // jika kategori yang dipilih adalah komputer / switch atau router, maka input spesifikasi
		$("#spesifikasi").hide();
        $("#identitas_nomor").hide();
		$("#kategori_khusus").change(function() {
			var selected = $("#kategori_khusus option:selected").text();
			if (selected == "Komputer" || selected == "Switch" || selected == "Router") {
				$("#spesifikasi").show();
			} else {
				$('#id_spesifikasi').val("");
				$("#spesifikasi").hide();
			}
            if(selected=="Komputer"){
                //untuk nomor identitas
                $("#identitas_nomor").show();
                $('#nomor_identitas').val(total_computer+1);
            }else{
                $("#identitas_nomor").hide();
                $('#nomor_identitas').val("");
            }
		});

        //jika aset disusutkan maka akan ada input umur aset
		$("#umur_aset").hide();
        $("#checkbox_penyusutan").click(function() {
            if ($(this).prop("checked") == true) {
                $("#umur_aset").show();
            } else {
                $('#umur_ekonomis').val("");
                $("#umur_aset").hide();
            }
        });
        
        // nomor kursi akan muncul jika aset berada di ruangan lab 1 / 2 / 3 / 4
		$("#posisi").hide();
		$("#ruangan").change(function() {
			var selected = $("#ruangan option:selected").text();
			if (selected == "Laboratorium 1" || selected == "Laboratorium 2" || selected == "Laboratorium 3" || selected ==
				"Laboratorium 4") {
				$("#posisi").show();
			} else {
				$('#nomor_kursi').val("");
				$("#posisi").hide();
			}
		});
	});
</script>