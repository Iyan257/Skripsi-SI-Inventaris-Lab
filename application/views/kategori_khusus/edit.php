
<section class="panel">
    <?= form_open_multipart('kategori_khusus/update/'.$category['id'], ['class' => 'form-horizontal mb-lg']) ?>
        <header class="panel-heading">
            <h2 class="panel-title"><?= isset($header)? $header:'Form Edit Kategori Khusus' ?></h2>
        </header>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="id_kategori">Kategori</label>
                <div class="col-sm-8">
                    <select name='id_kategori' id='id_kategori' class="form-control mb-md" required>
                        <option value="" disabled selected>Pilih kategori</option>
                        <?php foreach($kategori as $k):?>
                            <option value="<?=$k['id']?>" <?= ($k['id'] == $category['id_kategori'])? 'selected': ''  ?> ><?=$k['nama_kategori']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group mt-lg">
                <label class="col-sm-4 control-label" for="name">Nama Kategori Khusus<span class="required">*</span></label>
                <div class="col-sm-8">
                    <input type="text" id="kategori" name="kategori" class="form-control" placeholder="nama kategori khusus" value="<?= $category['nama_kategori_khusus']?>" required/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="warna_label">Warna Label<span class="required">*</span></label>
                <div class="col-sm-8">
                    <input type="color" id="warna_label" name="warna_label" width="10" value="<?= isset($category['warna_label'])? $category['warna_label'] : '#ffffff'?>" required/>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <a class="btn btn-default" href="<?= base_url('kategori_khusus')?>">Cancel</a>
                </div>
            </div>
        </footer>
    </form>
</section>