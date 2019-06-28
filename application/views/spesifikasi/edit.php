
<section class="panel">
    <?= form_open_multipart('spesifikasi/update/'.$specification['id'], ['class' => 'form-horizontal mb-lg']) ?>
        <header class="panel-heading">
            <h2 class="panel-title">Form Update Spesifikasi</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="type">Type</label>
                        <div class="col-sm-9">
                            <input type="text" id="type" name="type" class="form-control" placeholder="input type" value="<?= $specification['type'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="port">Jumlah Port</label>
                        <div class="col-sm-9">
                            <input type="text" id="port" name="port" class="form-control" placeholder="input jumlah port" value="<?= $specification['jumlah_port'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="processor">Processor</label>
                        <div class="col-sm-9">
                            <input type="text" id="processor" name="processor" class="form-control" placeholder="input processor" value="<?= $specification['processor'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="os1">Sistem Operasi 1</label>
                        <div class="col-sm-9">
                            <input type="text" id="os1" name="os1" class="form-control" placeholder="input os 1" value="<?= $specification['os1'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="os2">Sistem Operasi 2</label>
                        <div class="col-sm-9">
                            <input type="text" id="os2" name="os2" class="form-control" placeholder="input os 2" value="<?= $specification['os2'] ?>"/>
                        </div>
                    </div><div class="form-group">
                        <label class="col-sm-3 control-label" for="os3">Sistem Operasi 3</label>
                        <div class="col-sm-9">
                            <input type="text" id="os3" name="os3" class="form-control" placeholder="input os 3" value="<?= $specification['os3'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="memory">Memory</label>
                        <div class="col-sm-9">
                            <input type="text" id="memory" name="memory" class="form-control" placeholder="input memory" value="<?= $specification['memory'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="hard_drive">Hard Drive</label>
                        <div class="col-sm-9">
                            <input type="text" id="hard_drive" name="hard_drive" class="form-control" placeholder="input hard drive" value="<?= $specification['hard_drive'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label" for="keterangan">Keterangan </label>
                        <div class="col-sm-9">
                            <textarea id="keterangan" name="keterangan" class="form-control" placeholder="keterangan"><?= $specification['keterangan'] ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <a class="btn btn-default" href="<?= base_url('spesifikasi')?>">Cancel</a>
                </div>
            </div>
        </footer>
    </form>
</section>
