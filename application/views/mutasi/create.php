

<header class="panel-heading">
    <h6 class = "panel-title" >Pencarian Aset / Barang di '<?= $ruangan['nama']?>'</h6>
</header>
<div class="panel-body">
    <div class="row" style="margin-top:20px">
        <?= form_open('mutasi/create',['method'=>'GET']) ?>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="kode">Kode</label>
                    <input type="text" id="kode" name="kode" class="form-control" placeholder="kode"/>
                </div>
            </div>
            <div class="col-sm-3">
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
                    <label class="control-label" for="thn_pembelian">Tahun Pembelian</label>
                    <input type="text" id="thn_pembelian" name="thn_pembelian" class="form-control" placeholder="tahun"/>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="control-label" for="kondisi">Kondisi</label>
                    <select class="form-control mb-md"  id="kondisi" name="kondisi" placeholder="Pilih kondisi">
                        <option value="" disabled selected>Pilih kondisi</option>
                        <option>baik</option>
                        <option>sedang diperbaiki</option>
                        <option>rusak</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-2 center">
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

<?= form_open('mutasi/store') ?>
    <header class="panel-heading">
        <div class="row align-items-center">
            <div class="col-sm-8">
                <h2 class="panel-title">Daftar Aset / Barang</h2>
            </div>
            <div class="col-sm-4 text-right">
                <a class="btn btn-primary" href="<?= base_url('mutasi/create')?>"><i class="fa fa-search"></i> Tampilkan semua aset</a>
            </div>
        </div>
    </header>
    <div class="panel-body">
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
                                <input type="checkbox" class="checkbox" name="selection[]" value="<?= $asset['id']?>">
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
    <footer class="panel-footer">
        <div class="row">
            <div class="col-md-12 text-right">
                <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
                <a class="btn btn-default" href="<?= base_url('mutasi')?>">Cancel</a>
            </div>
        </div>
    </footer>
</form>

<script>
    //toggle select all checkbox
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

    $('#btn_addMutasi').click(function(){
        $('a#mutasi').click();
    });

</script>