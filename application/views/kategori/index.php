
<div id="addKategoriModal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <?= form_open_multipart('kategori/store', ['class' => 'form-horizontal mb-lg']) ?>
            <header class="panel-heading">
                <h2 class="panel-title">Form Tambah Kategori</h2>
            </header>
            <div class="panel-body">
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label" for="kategori">Nama Kategori <span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="kategori" name="kategori" class="form-control" placeholder="nama kategori" required/>
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
                <h2 class="panel-title"><span class="va-middle">Daftar Kategori Aset</span></h2>
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
                            <?php if(!isset($is_admin)): ?>
                                <td class="text-center" >
                                    <a  class="btn btn-sm btn-warning" href="<?= base_url('kategori/edit/' . $category['id']) ?>" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></a> 
                                    <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"></i></button>
                                </td>
                                <?= form_open('kategori/delete/' . $category['id'], ['id' => "del_$i"]); ?></form>
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