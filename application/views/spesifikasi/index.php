<section class="panel">
    <header class="panel-heading">
        <div class="row align-items-center">
			<div class="col-sm-8">
                <h2 class="panel-title"><span class="va-middle">Daftar Spesifikasi</span></h2>
			</div>

            <?php if(!isset($is_admin)): ?>
                <div class="col-sm-4 text-right">
                    <a class="btn btn-success" href="<?= base_url('spesifikasi/create')?>"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            <?php endif;?>
		</div>
    </header>
	<div class="panel-body">
        <?php if(count($specification) > 0): ?>
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
                        <th class="kolom_aksi" style="min-width:125px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($specification as $i => $spec): ?>
                        <tr>
                            <td><?= (isset($spec['id']) && $spec['id']!=null)? $spec['id']: '-'?></td>
                            <td><?= (isset($spec['type']) && $spec['type']!=null)? $spec['type']: '-'?></td>
                            <td><?= (isset($spec['jumlah_port']) && $spec['jumlah_port']!=null)? $spec['jumlah_port']: '-'?></td>
                            <td><?= (isset($spec['processor']) && $spec['processor']!=null)? $spec['processor']: '-'?></td>
                            <?php 
                                $os=[]; 
                                if($spec['os1']!=null) array_push($os, $spec['os1']); 
                                if($spec['os2']!=null) array_push($os, $spec['os2']); 
                                if($spec['os3']!=null) array_push($os, $spec['os3']); 
                            ?>
                            
                            <td><?= (!empty($os))?
                                implode(', ', array_map(function ($x) use ($os) {
                                    return $os[$x];
                                }, range(0, count($os) - 1))) :'-';
                            ?></td> 
                            <td><?= (isset($spec['memory']) && $spec['memory']!=null)? $spec['memory']: '-'?></td>
                            <td><?= (isset($spec['hard_drive']) && $spec['hard_drive']!=null)? $spec['hard_drive']: '-'?></td>
                            <td><?= (isset($spec['keterangan']) && $spec['keterangan']!=null)? $spec['keterangan']: '-'?></td>
                            <td class="text-center" >
                                <a  class="btn btn-sm btn-warning" href="<?= base_url('spesifikasi/edit/' . $spec['id']) ?>" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></a> 
                                <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"></i></button>
                            </td>
                            <?= form_open('spesifikasi/delete/' . $spec['id'], ['id' => "del_$i"]); ?></form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else:?>
            <div class="col center">
                <b class="text-danger">Specification list is empty.</b>
            </div>
        <?php endif; ?>
	</div>
</section>