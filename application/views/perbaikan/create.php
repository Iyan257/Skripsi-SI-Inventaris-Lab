
<section class="panel">
    <?= form_open_multipart('perbaikan/store', ['class' => 'form-horizontal mb-lg']) ?>
        <header class="panel-heading">
            <h2 class="panel-title">Form Tambah Perbaikan</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="kondisi">Kondisi</label>
                        <div class="col-sm-9">
                            <select name='kondisi' id='kondisi'>
                                <option value="sedang diperbaiki" >sedang diperbaiki</option>
                                <option value="dioper ke BTI" >dioper ke BTI</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="kode">Kode
                        <span class="required">*</span>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" id="kode" name="kode" class="form-control" placeholder="kode aset" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="tanggal_masuk">Tanggal masuk <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" placeholder="tanggal masuk" required/>
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label" for="masalah">Masalah <span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea id="masalah" name="masalah" class="form-control" placeholder="masalah" required></textarea>
                        </div>
                    </div>
                    <div class="form-group mt-lg">
                        <label class="col-sm-3 control-label" for="keterangan">Keterangan </label>
                        <div class="col-sm-9">
                            <textarea id="keterangan" name="keterangan" class="form-control" placeholder="keterangan"></textarea>
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