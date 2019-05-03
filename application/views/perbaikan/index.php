
<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row align-items-center">
			<div class="col-sm-8">
                <h2 class="panel-title"><span class="va-middle">Daftar Riwayat Perbaikan</span></h2>
			</div>
			<div class="col-sm-4 text-right">
                <a class="btn btn-success" href="<?= base_url('perbaikan/create')?>"><i class="fa fa-plus"></i> Tambah</a>
			</div>
		</div>
    </header>
	<div class="panel-body">
        <?php if(count($history) > 0): ?>
            <table class="table mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th id="kolom_no" style="display:none">ID</th>
                        <th>Kode</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Selesai</th>
                        <th>Masalah</th>
                        <th>Solusi</th>
                        <th style="width: 20%;">Keterangan</th>
                        <th style="width: 15%;">Surat</th>
                        <th class="kolom_aksi" style="width:15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($history as $i => $h): ?>
                        <tr>
                            <td style="display:none"><?=$h['id']?></td>
                            <td><?= $h['kode']?></td>
                            <td><?= isset($h['tanggal_masuk']) ? $h['tanggal_masuk'] : '-' ?></td>
                            <td><?= isset($h['tanggal_selesai']) ? $h['tanggal_selesai']: '-' ?></td>
                            <td><?= isset($h['masalah']) ? $h['masalah']: '-' ?></td>
                            <td><?= isset($h['solusi']) ? $h['solusi']: '-' ?></td>
                            <td><?= isset($h['keterangan']) ? $h['keterangan']: '-' ?></td>

                            <?php if(isset($h['lampiran'])) : ?>
                                <td><a href="<?= base_url('perbaikan/downloadSurat/' . $h['id']) ?>"><i class="fa fa-download"></i> download</a></td>
                            <?php else: ?>
                                <td>tidak ada</td>
                            <?php endif; ?>

                            <td class="text-center" >
                                <a  class="btn btn-sm btn-warning" href="<?= base_url('perbaikan/edit/' . $h['id']) ?>"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="ubah"></i></a> 
                                <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"></i></button>
                            </td>
                            <?= form_open('perbaikan/delete/' . $h['id'], ['id' => "del_$i"]); ?></form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else:?>
            <div class="col center">
                <b class="text-danger">Repairment history is empty.</b>
            </div>
        <?php endif; ?>
	</div>
</section>

<!-- end: page -->