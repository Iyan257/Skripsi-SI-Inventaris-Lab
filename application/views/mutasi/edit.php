<div class="row">
    <?= form_open('mutasi/update/'.$id)?>
    <header class="panel-heading">
        <h3 class = "panel-title" ><?= isset($header)? $header:'Edit Mutasi' ?></h3>
    </header>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="tanggal_mutasi">Tanggal Mutasi <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <input type="date" id="tanggal_mutasi" name="tanggal_mutasi" class="form-control" value="<?= (isset($history['tanggal_mutasi']))? date('Y-m-d', strtotime($history['tanggal_mutasi'])) : '' ?>" placeholder="tanggal mutasi" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="ruangan_asal">Ruangan Asal <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <select name='ruangan_asal' id='ruangan_asal' class="form-control">
                            <?php foreach($ruangan as $r):?>
                                <?php if($r['id'] == $history['id_ruangan_asal']): ?>
                                    <option value="<?=$r['id']?>"> <?=$r['nama']?> </option>
                                <?php endif; ?>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="ruangan_tujuan">Ruangan Tujuan <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <select name='ruangan_tujuan' id='ruangan_tujuan' class="form-control" required>
                            <option value="" disabled selected>Pilih ruangan</option>
                            <?php foreach($ruangan as $r):?>
                                <option value="<?=$r['id']?>" <?= ($r['id'] == $history['id_ruangan_tujuan'])? 'selected': ''  ?> ><?=$r['nama']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="margin-top:20px;">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="keterangan">Keterangan <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <textarea id="keterangan" name="keterangan" class="form-control" row="5" required><?= (isset($history['keterangan']))? $history['keterangan']: 'input keterangan' ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <?php if(count($assets) > 0): ?>
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Tanggal penerimaan</th>
                                <th>Ruangan</th>
                                <th>Kondisi</th>
                                <th>Masa pemakaian</th>
                                <th>Nilai aset</th>
                                <th class="kolom_aksi">Pilih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($assets as $i => $asset): ?>
                                <tr>
                                    <td><?= $asset['kode']?></td>
                                    <td><?= $asset['nama_aset']?></td>
                                    <td><?= $asset['nama_kategori']?></td>
                                    <td><?= $asset['tanggal_penerimaan']?></td>
                                    <td><?= $asset['nama']?></td>
                                    <td><?= $asset['kondisi']?></td>
                                    <td><?= $asset['masa_pakai'].' tahun'?></td>
							        <td><?= 'Rp '. number_format($asset['nilai_aset'])?></td>
                                    <td>
                                        <input type="checkbox" class="checkbox" name="selection[]" value="<?= $asset['id']?>" checked>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <label><input type="checkbox" id="select_all">Select All</label>
                    </div>
                <?php else:?>
                    <div class="col center">
                        <b class="text-danger">Assets list is empty.</b>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-12">
                <p><i> 
                    <?php if(isset($created_user)) { echo 'Created by <mark>'.$created_user->inisial.'</mark>'; }?>
                    <?php if(isset($last_updated_user)) { echo ' & Last updated by <mark>'.$last_updated_user->inisial.'</mark>'; } ?>
                </i></p>
                <p><i> </i></p>
            </div>
        </div>
        <hr>
    </div>
    <footer class="panel-footer">
        <div class="row">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary">Next</button>
                <a class="btn btn-default" href="<?= base_url('mutasi')?>">Cancel</a>
            </div>
        </div>
    </footer>
    </form>                   
</div>

<script>
    //toggle select all checkbox
    $("#select_all").prop('checked', true);

    $("#select_all").change(function(){   
        $(".checkbox").prop('checked', $(this).prop("checked")); 
    });

    $('.checkbox').change(function(){ 
        if(false == $(this).prop("checked")){ 
            $("#select_all").prop('checked', false); 
        }
        if ($('.checkbox:checked').length == $('.checkbox').length ){
            $("#select_all").prop('checked', true);
        }
    });

</script>