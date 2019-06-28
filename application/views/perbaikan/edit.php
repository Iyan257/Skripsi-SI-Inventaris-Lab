
<section class="panel">
    <?= form_open_multipart('perbaikan/update/'.$history['id'], ['class' => 'form-horizontal mb-lg']) ?>
        <header class="panel-heading">
            <h2 class="panel-title"><?= isset($header)? $header:'Form Edit' ?></h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="kondisi">Kondisi <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select name='kondisi' id='kondisi'>
                                <?php foreach($kondisi as $k): ?>
                                    <option value="<?=$k['nilai_acuan']?>" <?= ($history['kondisi'] == $k['nilai_acuan'])? 'selected':'' ?>><?=$k['nilai_acuan']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="kode">Kode</label>
                        <span class="required">*</span>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" id="kode" name="kode" class="form-control" value="<?=$history['kode']?>" required readonly="readonly"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="tanggal_masuk">Tanggal masuk <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" value="<?=$history['tanggal_masuk']?>" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="tanggal_selesai">Tanggal selesai</label>
                        <div class="col-sm-4">
                            <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" placeholder = "tanggal selesai" value="<?= ($history['tanggal_selesai'] == null)? '' : $history['tanggal_selesai']?>" />
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label" for="masalah">Masalah <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea id="masalah" name="masalah" class="form-control" required><?=$history['masalah']?></textarea>
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label" for="solusi">Solusi </label>
                        <div class="col-sm-9">
                            <textarea id="solusi" name="solusi" class="form-control" placeholder = "solusi" ><?=($history['solusi'] == null) ? '': $history['solusi']?></textarea>
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label" for="keterangan">Keterangan </label>
                        <div class="col-sm-9">
                            <textarea id="keterangan" name="keterangan" class="form-control" ><?= ($history['keterangan'] == null) ? '' : $history['keterangan'] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="userfile">Surat perbaikan</label>
                        <div class="col-sm-4">
                            <div class="col-xs-2 text-right" style="padding-top:5px;">
                                <i class="fa fa-upload"></i>
                            </div>
                            <div class="col-xs-10" style="padding-left:0;">
                                <input type="file" id="userfile" name="userfile" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:30px;">
                    <p><i> 
                        <?php if(isset($created_user)) { echo 'Created by <mark>'.$created_user->inisial.'</mark>'; }?>
                        <?php if(isset($last_updated_user)) { echo ' & Last updated by <mark>'.$last_updated_user->inisial.'</mark>'; } ?>
                    </i></p>
                    <p><i> </i></p>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <a class="btn btn-default" href="<?= base_url('perbaikan')?>">Cancel</a>
                </div>
            </div>
        </footer>
    </form>
</section>