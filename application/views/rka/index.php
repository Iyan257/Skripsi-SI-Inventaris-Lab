<div class="row">
    <div class="col-md-12">
        <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="<?= (isset($_GET['query']) || isset($_GET['permintaan']))? '':'active'?>">
                    <a href="#rencana" data-toggle="tab">
                        Rencana Kerja Anggaran
                    </a>
                </li>
                <li class="<?= (isset($_GET['query']) || isset($_GET['permintaan']))? 'active':''?>">
                    <a href="#permintaan" data-toggle="tab">
                        Daftar Permintaan
                    </a>
                </li>
            </ul>
            <div class="tab-content" style="padding-bottom:0; border-bottom:0;">
                
                <div id="rencana" class="tab-pane <?= (isset($_GET['query']) || isset($_GET['permintaan']))? '':'active'?>">
                    <div class="row" style="padding:15px;">
                        <div class="col-md-8"><h3>Daftar RKA</h3></div>
                        <div class="col-sm-4 text-right">
                            </h2>	
                        </div>
                        <div class="col-md-4 text-right">
                            <a class="btn btn-success" href="<?= base_url('kalab/rka/create') ?>"><i class="fa fa-plus"></i> Buat RKA</a>
                        </div>
                    </div>

                    <?php if(count($history) > 0): ?>
                        <div class="panel-body">
                            <table class="table mb-none" id="datatable-default">
                                <thead>
                                    <tr>
                                        <th id="kolom_no">ID</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Judul</th>
                                        <th>Perkiraan Anggaran</th>
                                        <th>Total Terealisasi</th>
                                        <th class="kolom_aksi">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($history as $i => $h): ?>
                                        <tr>
                                            <td><?= $h['id']?></td>
                                            <td><?= $h['created_at']?></td>
                                            <td><?= $h['judul']?></td>
                                            <td><?= (isset($h['total_anggaran'])) ?'Rp '. number_format($h['total_anggaran']). ',00': 'Rp 0,00'?></td>
                                            <td><?= (isset($h['total_terealisasi'])) ? 'Rp '. number_format($h['total_terealisasi']). ',00': 'Rp 0,00'?></td>
                                            <td class="text-center" >
                                                <a  class="btn btn-sm btn-warning" href="<?= base_url('kalab/rka/edit/'.$h['id']) ?>" data-toggle="tooltip" data-placement="top" title="ubah"><i class="fa fa-edit"></i></a> 
                                                <button class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                            <?= form_open('kalab/rka/delete/'.$h['id'] , ['id'=>"del_$i"]); ?></form>
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

                <div id="permintaan" class="tab-pane <?= (isset($_GET['query']) || isset($_GET['permintaan']))? 'active':''?>">
                    <div class="panel-body" style="margin-top:20px;">
                        <div><b>Daftar Permintaan Administrator</b></div>
                        <hr>
                        <form action="<?= base_url('kalab/rka')?>" class="search nav-form">
                            <div class="form-group">
                                <label class="col-md-1 control-label" >By</label>
                                <span class="col-md-2"><input type="radio" name="search_by" id="radio_title" value="title" checked="checked"/> Title</span>
                                <span class="col-md-2"><input type="radio" name="search_by" id="radio_sender" value="sender" <?= (isset($_GET['search_by']) && $_GET['search_by'] == 'sender')? "checked='checked'": '' ?>/> Sender</span>
                                <span class="col-md-2"><input type="radio" name="search_by" id="radio_year" value="year" <?= (isset($_GET['search_by']) && $_GET['search_by'] == 'year')? "checked='checked'": '' ?>/> Year</span>
                            </div>
                            <div class="form-group">
                                <label class="col-md-1 control-label">Search</label>
                                <div class="col-md-6">
                                    <div class="input-group input-search">
                                        <input type="text" class="form-control" name="query" id="query" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php  if(count($request) > 0) : ?>
                        <div class="col-sm-12" style="max-height: 500px; overflow-y : auto;">
                            <hr>
                            <?php foreach($request as $i=>$r): ?>
                                <?php if($i>0):?> <hr> <?php endif; ?>
                                <div id="req_<?=$i?>" class="<?= ($r['dibaca']== 0)? 'well info': 'well well-lg'?>" style="margin-top:20px;">
                                    <div class="row">
                                        <label class="col-sm-12"><b><?= $r['judul']?></b></label>
                                        <label class="col-sm-12"><b><?= $r['created_at']?> by <?= $r['inisial']?></b></label>
                                        <label><hr></label>
                                        <div class="col-sm-12" style="border-top: 2px solid white; padding-top:5px;">
                                            <?= $r['deskripsi'] ?>
                                        </div>
                                        <div class="text-right">
                                            <?php if($r['dibaca'] == 0) : ?>
                                                <a href="<?= base_url('permintaan/mark_read').'/'. $r['id']?>" class="btn btn-md btn-warning"> <i class="fa fa-edit"> Mark as read</i></a>
                                            <?php endif; ?>
                                            <button class="btn btn-md btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_req_<?= $i ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"> Delete</i></button>
                                            <?= form_open('permintaan/delete/'.$r['id'] , ['id'=>"del_req_$i"]); ?></form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php else:?>
                            <div class="panel-body center">
                                <b class="text-danger">Request is empty.</b>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>