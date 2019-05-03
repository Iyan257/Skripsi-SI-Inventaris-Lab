<!-- start: page -->
<div class="row">
    <div class="col-xl-3 col-lg-6">
        <section class="panel">
            <header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
					<a href="#" class="fa fa-times"></a>
				</div>

				<h2 class="panel-title">
					<span class="label label-primary label-sm text-normal va-middle mr-sm"><?= sizeof($history)?></span>
					<span class="va-middle">Aset yang rusak</span>
				</h2>
			</header>
            <div class="panel-body">
                <?php if(count($history) > 0): ?>
					<div class="col center" style="max-height: 250px; overflow-y : auto;">
						<table class="table table-bordered table-striped mb-none">
							<thead>
								<tr>
									<th>Kode</th>
									<th>Tanggal Masuk</th>
									<th>Masalah</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($history as $i => $h): ?>
									<tr>
										<td><?= $h['kode']?></td>
										<td><?= $h['tanggal_masuk']  ?></td>
										<td><?= $h['masalah'] ?></td>
										<td><span class="label label-danger"><?= $h['kondisi']?></span></td>
										<td><a href="<?= base_url('perbaikan/' . $h['id']) ?>">View</a></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
                <?php else:?>
                    <div class="col center">
                        <b class="text-danger">Tidak ada aset yang rusak.</b>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
    <div class="col-xl-3 col-lg-6">
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
					<a href="#" class="fa fa-times"></a>
				</div>

				<h2 class="panel-title">
					<span class="label label-primary label-sm text-normal va-middle mr-sm"><?= count($notifications)?></span>
					<span class="va-middle">Notifikasi</span>
				</h2>
			</header>
			<div class="panel-body">
				<?php if(count($notifications) > 0): ?>
				<div class="content" style="max-height: 400px; overflow-y : auto;">
					<ul class="simple-user-list">
						<?php foreach($notifications as $notif): ?>
							<li>
								<span class="title"><b><?= $notif['judul'] ?></b></span>
								<span class="message truncate"><?=$notif['deskripsi']?></span>
								<?php if($notif['tipe']=='penyusutan'):?>
									<a href="<?= base_url('kalab/aset').'?penyusutan=ya'?>">
										VIEW
									</a>
								<?php elseif($notif['tipe']=='pembelian'):?>
									<?php if(in_array("kalab",$groups)):?>
										<a href="<?= base_url('kalab/rka').'#permintaan'?>">
											VIEW
										</a>
									<?php elseif(in_array("input_admin", $groups)) : ?>
										<a href="<?= base_url('admin/aset').'?pembelian=ya'?>">
											VIEW
										</a>
									<?php endif; ?>
								<?php endif; ?>
								
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php else:?>
                    <div class="col center">
                        <b class="text-danger">Tidak ada notifikasi baru.</b>
                    </div>
                <?php endif; ?>
			</div>
			
		</section>
	</div>
</div>


<!-- end: page -->