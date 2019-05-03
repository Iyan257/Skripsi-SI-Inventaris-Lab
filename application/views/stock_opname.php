<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row align-items-center">
			<div class="col-sm-8">
                <h2 class="panel-title"><span class="va-middle">Stock opname</span></h2>
			</div>
		</div>
    </header>
	<div class="panel-body">
        <div class="row">
            <div class="col-sm-5">
                Download Hasil Stock Opname terakhir
            </div>
            <div class="col-sm-7">
                <a id="btn_download" class="btn btn-primary" href="<?= base_url('laporan/stock_opname?option=download')?>"><i class="fa fa-download"></i> Download</a>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-5">
                <label>Mulai stock opname</label>
            </div>
            <div class="col-sm-7">
                <?php if(isset($status_so) && $status_so=="1"): ?>
                    <button type="submit" id="btn_mulai" class="btn btn-success" <?=(isset($status_so) && $status_so=="1")? 'disabled' : '' ?>><i class="fa fa-plus"></i> Mulai</button>
                    <label style="color:green">Ket : layanan stock opname sudah dimulai</label>
                <?php else: ?>
                    <?= form_open('laporan/stock_opname?option=mulai') ?>
                        <button type="submit" id="btn_mulai" class="btn btn-success" ><i class="fa fa-plus"></i> Mulai</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-7 col-sm-offset-5">
                <?php if(isset($status_so) && $status_so=="1"): ?>
                    <?= form_open('laporan/stock_opname?option=selesai') ?>
                        <button type ="submit" id="btn_selesai" class="btn btn-primary"><i class="fa fa-times"></i> Selesai dan Download</button>
                    </form>
                <?php else: ?>
                    <a id="btn_selesai" class="btn btn-primary" href="<?= base_url('laporan/stock_opname?option=selesai')?>" disabled><i class="fa fa-times"></i> Selesai dan Download</a>
                <?php endif; ?>
            </div>
        </div>
	</div>
</section>

<script>
    $(document).ready(function() {
        $('#btn_mulai').click(function() {
            return confirm('Data riwayat stock opname sebelumnya akan dihapus, apakah Anda yakin ?');
        });
        $('#btn_selesai').click(function() {
            return confirm('Apakah Anda yakin ingin mengakhiri layanan stock opname ?');
        });
    });
</script>
<!-- end: page -->