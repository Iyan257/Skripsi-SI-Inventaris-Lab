<section class="panel">
    <header class="panel-heading">
        <div class="row align-items-center">
			<div class="col-sm-8">
                <h2 class="panel-title"><span class="va-middle"><?= $header ?></span></h2>
			</div>
		</div>
    </header>
    <div class="panel-body">
        <?= form_open('permintaan/store') ?>
            <div class="col-sm-12">
                <div><b>Kebutuhan barang untuk tahun mendatang</b></div>
                <hr>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">Rencana untuk tahun</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="number" name="rencana_tahun" value="<?= date('Y')+1 ?>" max="<?= date('Y')+1 ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">Judul</label>
                    <div class="col-sm-9">
                        <input type="text" name="judul" class="form-control" placeholder="Input the title" name="name" required value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 col-form-label">Isi</label>
                    <div class="col-md-9">
                        <textarea name="deskripsi" class="summernote" data-plugin-summernote data-plugin-options='{ "height": 180, "codemirror": { "theme": "ambiance" } }'>Start typing...</textarea>
                    </div>
                </div>
                <div class="form-group text-right mb-0">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Send</button>
                </div>
            </div>
        </form>
        
    </div>
    <?php  if(count($request) > 0) : ?>
        <div class="panel-body" style="margin-top:20px;">
            <div class="col-sm-12">
                <div><b>Riwayat permintaan</b></div>
                <hr>
                <?php foreach($request as $i=>$r): ?>
                    <?php if($i>0):?> <hr> <?php endif; ?>
                    <div class="well well-lg" style="margin-top:20px;">
                        <div class="row">
                            <label class="col-sm-12"><b><?= $r['judul']?></b></label>
                            <label class="col-sm-12"><b><?= $r['created_at']?> by <?= $r['inisial']?></b></label>
                            <label><hr></label>
                            <div class="col-sm-12" style="border-top: 2px solid white; padding-top:5px;">
                                <?= $r['deskripsi'] ?>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-md btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_req_<?= $i ?>').submit()}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash-o"> Delete</i></button>
                                <?= form_open('permintaan/delete/'.$r['id'] , ['id'=>"del_req_$i"]); ?></form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else:?>
        <div class="panel-body center">
            <b class="text-danger">Request is empty.</b>
        </div>
    <?php endif; ?>
</section>





