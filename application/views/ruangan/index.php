
<div id="addRuanganModal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <?= form_open_multipart('ruangan/store', ['class' => 'form-horizontal mb-lg']) ?>
            <header class="panel-heading">
                <h2 class="panel-title">Form Tambah Ruangan</h2>
            </header>
            <div class="panel-body">
                <div class="form-group mt-lg">
                    <label class="col-sm-3 control-label" for="name">Nama <span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="name" name="name" class="form-control" placeholder="nama laboratorium" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="room">Ruangan <span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="room" name="room" class="form-control" placeholder="lokasi ruangan" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="userfile">Gambar</label>
                    <div class="col-sm-8">
                        <div class="col-xs-2 text-right" style="padding-top:5px;">
                            <i class="fa fa-upload"></i>
                        </div>
                        <div class="col-xs-10" style="padding-left:0;">
                            <input type="file" id="userfile" name="userfile" class="form-control"/>
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
                <h2 class="panel-title"><span class="va-middle">Daftar Ruangan</span></h2>
			</div>

            <?php if(!isset($is_admin)): ?>
                <div class="col-sm-4 text-right">
                    <a class="modal-with-zoom-anim btn btn-success" href="#addRuanganModal"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            <?php endif;?>
		</div>
    </header>
	<div class="panel-body">
        <?php if(count($rooms) > 0): ?>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th id="kolom_no">No</th>
                        <th>Nama</th>
                        <th>Ruangan</th>
                        <th>Gambar</th>
                        <?php if(!isset($is_admin)): ?>
                            <th class="kolom_aksi">Aksi</th>
                        <?php endif;?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rooms as $i => $room): ?>
                        <tr>
                            <td><?= $room['id']?></td>
                            <td><?= $room['nama']?></td>
                            <td><?= $room['ruangan']?></td>
                            <td>
                                <?php if($room['gambar'] != null): ?>
                                    <img class="img-fluid" src="<?=base_url('assets/images/ruangan/' . $room['gambar']) ?>" alt="<?= $room['gambar'] ?>" style="max-width:150px; max-height:100px;">
                                <?php else: ?>
                                    Tidak ada gambar
                                <?php endif;?>
                            </td>
                            <?php if(!isset($is_admin)): ?>
                                <td class="text-center" >
                                    <a  class="btn btn-sm btn-warning" href="<?= base_url('ruangan/edit/' . $room['id']) ?>" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></a> 
                                    <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"></i></button>
                                </td>
                                <?= form_open('ruangan/delete/' . $room['id'], ['id' => "del_$i"]); ?></form>
                            <?php endif;?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else:?>
            <div class="col center">
                <b class="text-danger">Rooms list is empty.</b>
            </div>
        <?php endif; ?>
	</div>
</section>

<!-- end: page -->