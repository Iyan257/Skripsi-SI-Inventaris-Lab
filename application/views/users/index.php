<section class="panel">
    <header class="panel-heading">
        <div class="row align-items-center">
			<div class="col-sm-8">
                <h2 class="panel-title"><span class="va-middle">Users</span></h2>
			</div>
			<div class="col-sm-4 text-right">
                <a class="btn btn-primary" href="<?= base_url('kalab/users/create') ?>"><i class="fa fa-plus"></i> Tambah</a>
			</div>
		</div>
    </header>
	<div class="panel-body">
        <?php if(count($users) > 0): ?>
            <table class="table table-bordered table-striped mb-none">
                <thead>
                    <th>ID #</th>
                    <th>Kode</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Group/Role</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                <?php foreach ($users as $_user): ?>
						<tr>
							<td class="align-middle"><?= $_user->id ?></td>
                            <td class="align-middle"><?= $_user->inisial; ?></td>
							<td class="align-middle"><?= $_user->name; ?></td>
							<td class="align-middle"><?= $_user->username; ?></td>
                            <td class="align-middle">
                                <?=
                                    implode(', ', array_map(function ($x) use ($_user) {
                                        return $_user->groups[$x]->description;
                                    }, range(0, count($_user->groups) - 1)))
                                ?>
                            </td>
                            <td class="align-middle">
                                <?php if($_user->id != 1 && $_user->id != $user->id): ?>
                                    <div class="btn-group btn-group-sm">
                                        <a class="btn btn-warning" href="<?= base_url('kalab/users/edit/' . $_user->id) ?>" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-pencil-square-o"></i></a>
                                        <button type="button" class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#p-<?= $_user->id ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                    <?= form_open('kalab/users/delete/' . $_user->id, ['id' => "p-$_user->id"]); ?></form>
                                <?php endif; ?>
                            </td>
						</tr>
					<?php endforeach;?>
                </tbody>
            </table>
        <?php else:?>
            <div class="col center">
                <b class="text-danger">Users list is empty.</b>
            </div>
        <?php endif; ?>
	</div>
</section>