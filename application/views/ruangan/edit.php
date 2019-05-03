
<section class="panel">
    <?= form_open_multipart('ruangan/update/'.$room['id'], ['class' => 'form-horizontal mb-lg']) ?>
        <header class="panel-heading">
            <h2 class="panel-title"><?= isset($header)? $header:'Form Edit Ruangan' ?></h2>
        </header>
        <div class="panel-body">
            <div class="form-group mt-lg">
                <label class="col-sm-3 control-label" for="name">Nama</label>
                <div class="col-sm-9">
                    <input type="text" id="name" name="name" class="form-control" placeholder="nama laboratorium" value="<?= $room['nama']?>" required/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="room">Ruangan</label>
                <div class="col-sm-9">
                    <input type="text" id="room" name="room" class="form-control" placeholder="lokasi ruangan" value="<?= $room['ruangan']?>" required/>
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
                    <a class="btn btn-default" href="<?= base_url('ruangan')?>">Cancel</a>
                </div>
            </div>
        </footer>
    </form>
</section>