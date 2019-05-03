
<div id="addKategoriModal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <?= form_open_multipart('kategori_khusus/store', ['class' => 'form-horizontal mb-lg']) ?>
            <header class="panel-heading">
                <h2 class="panel-title">Form Tambah Kategori</h2>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="id_kategori">Kategori<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <select class="form-control mb-md" name='id_kategori' id='id_kategori' class="form-control mb-md" required>
                                    <option value="" disabled selected>Pilih kategori</option>
                                    <?php foreach($kategori as $k):?>
                                        <option value="<?=$k['id']?>" ><?=$k['nama_kategori']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="kategori">Nama Kategori Khusus<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="kategori" name="kategori" class="form-control" placeholder="nama kategori khusus" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="warna_label">Warna Label<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input type="color" id="warna_label" name="warna_label" width="10" value="#ffffff" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
    
</div>

<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row align-items-center">
			<div class="col-sm-8">
                <h2 class="panel-title"><span class="va-middle">Daftar Kategori Khusus</span></h2>
			</div>
            <?php if(!isset($is_admin)): ?>
                <div class="col-sm-4 text-right">
                    <a class="modal-with-zoom-anim btn btn-success" href="#addKategoriModal"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            <?php endif; ?>
		</div>
    </header>
	<div class="panel-body">
        <?php if(count($categories) > 0): ?>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th id="kolom_no">No</th>
                        <th>Nama Kategori</th>
                        <th>Nama Kategori Khusus</th>
                        <th>Warna label</th>
                        <th>Jumlah Aset</th>
                        <?php if(!isset($is_admin)): ?>
                            <th class="kolom_aksi">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $i => $category): ?>
                        <tr>
                            <td><?= $category['id']?></td>
                            <td><?= $category['nama_kategori']?></td>
                            <td><?= $category['nama_kategori_khusus']?></td>
                            <?php if(isset($category['warna_label'])) : ?>
                                <th class="text-center" style="color:white; background-color: <?= $category['warna_label'] ?>"><?= $category['warna_label'] ?></th>
                            <?php else : ?>
                                <th class="text-center">No color</th>
                            <?php endif; ?>
                            <td><?= $category['ct']?></td>
                            <?php if(!isset($is_admin)): ?>
                                <td class="text-center" >
                                    <a  class="btn btn-sm btn-warning" href="<?= base_url('kategori_khusus/edit/' . $category['id']) ?>" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></a> 
                                    <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"></i></button>
                                </td>
                                <?= form_open('kategori_khusus/delete/' . $category['id'], ['id' => "del_$i"]); ?></form>
                            <?php endif;?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else:?>
            <div class="col center">
                <b class="text-danger">Categories list is empty.</b>
            </div>
        <?php endif; ?>
	</div>
</section>

<!-- end: page -->