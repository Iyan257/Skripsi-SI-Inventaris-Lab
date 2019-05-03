
<section class="panel">
    <?= form_open_multipart('kategori/update/'.$category['id'], ['class' => 'form-horizontal mb-lg']) ?>
        <header class="panel-heading">
            <h2 class="panel-title"><?= isset($header)? $header:'Form Edit Kategori' ?></h2>
        </header>
        <div class="panel-body">
            <div class="form-group mt-lg">
                <label class="col-sm-3 control-label" for="name">Nama Kategori <span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="text" id="kategori" name="kategori" class="form-control" placeholder="nama kategori" value="<?= $category['nama_kategori']?>" required/>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <a class="btn btn-default" href="<?= base_url('kategori')?>">Cancel</a>
                </div>
            </div>
        </footer>
    </form>
</section>