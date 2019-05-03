<div class="row">
    <div class="col-md-12">
        <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#history" id="riwayat" data-toggle="tab">
                        Riwayat Mutasi
                    </a>
                </li>
                <li>
                    <a href="#form" id="mutasi" data-toggle="tab">
                        Buat Mutasi
                    </a>
                </li>
            </ul>
            <div class="tab-content" style="padding-bottom:0; border-bottom:0;">
                <div id="form" class="tab-pane">
                    <?= form_open('mutasi/create')?>
                    <div class="col-md-8" style="margin:15px;"><h3>Form Mutasi</h3></div>

                    <div class="panel-body">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="ruangan_asal">Ruangan Asal <span class="required">*</span></label>
                                <select name='ruangan_asal' id='ruangan_asal' class="form-control mb-md" required>
                                    <option value="" disabled selected>Pilih ruangan</option>
                                    <?php foreach($ruangan as $r):?>
                                        <option value="<?=$r['id']?>"> <?=$r['nama']?> </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="ruangan_tujuan">Ruangan Tujuan <span class="required">*</span></label>
                                <select name='ruangan_tujuan' id='ruangan_tujuan' class="form-control mb-md" required>
                                    <option value="" disabled selected>Pilih ruangan</option>
                                    <?php foreach($ruangan as $r):?>
                                        <option value="<?=$r['id']?>"><?=$r['nama']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="control-label" for="keterangan">Keterangan <span class="required">*</span></label>
                                <textarea id="keterangan" name="keterangan" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                    </footer>
                    </form>                   
                </div>
                <div id="history" class="tab-pane active">
                    <div class="row" style="padding:15px;">
                        <div class="col-md-8"><h3>Daftar Mutasi</h3></div>
                        <div class="col-sm-4 text-right">
                            </h2>	
                        </div>
                        <div class="col-md-4 text-right">
                            <a class="btn btn-success" id="btn_addMutasi"><i class="fa fa-plus"></i> Buat Mutasi</a>
                        </div>
                    </div>

                    <?php if(count($history) > 0): ?>
                        <div class="panel-body">
                            <table class="table mb-none" id="datatable-default">
                                <thead>
                                    <tr>
                                        <th id="kolom_no">No</th>
                                        <th>Tanggal Mutasi</th>
                                        <th>Ruangan Asal</th>
                                        <th>Ruangan Tujuan</th>
                                        <th style="width: 20%;" >Keterangan</th>
                                        <th class="kolom_aksi" style="width:15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($history as $i => $h): ?>
                                        <tr>
                                            <td><?= $h['id']?></td>
                                            <td><?= $h['tanggal_mutasi']?></td>
                                            <td><?= $h['ruangan_asal']?></td>
                                            <td><?= $h['ruangan_tujuan']?></td>
                                            <td><?= $h['keterangan']?></td>
                                            <td class="text-center" >
                                                <a  class="btn btn-sm btn-warning" href="<?= base_url('mutasi/edit/' . $h['id']) ?>" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></a> 
                                                <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                            <?= form_open('mutasi/delete/' . $h['id'], ['id' => "del_$i"]); ?></form>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else:?>
                        <div class="panel-body center">
                            <b class="text-danger">History list is empty.</b>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $('#btn_addMutasi').click(function(){
        $('a#mutasi').click();
    });
</script>