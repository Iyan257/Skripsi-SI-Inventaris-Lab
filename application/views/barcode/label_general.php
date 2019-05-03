<div class="col-xs-4 identitas" id="identitas_general">
    <div class="row" id="html-content-holder">
        <?php if($kategori === "Komputer"): ?>
            <div class="col-xs-6 left">
                <p class="ruangan_barcode text-center <?= isset($info_barcode['lab'])? preg_replace('/\s+/', '', $info_barcode['lab']) : 'LAB' ?>" style="background-color: <?= isset($info_barcode['color'])? $info_barcode['color']: '#FF4500' ?>; color: #fff; margin:0;">
                    <b class="ruangan_text" style="font-size:smaller;"><?= 'KOM-'.$merek.'-'.substr($tahun_pembelian, 2) ?></b>
                </p>
                <p class="text-center" style="padding-top:25px; padding-bottom:13px; font-size: 1.5rem;">
                    <span class="nomor_barcode "><?= isset($nomor_identitas)? $nomor_identitas.' / ' : '' ?> </span>
                    <b class="kode_barcode" style="border-bottom: 5px solid <?= (isset($warna_label)? $warna_label : '#25BF72') ?>;"><?= isset($kode)? $kode:'' ?></b>
                </p>
                <div class="text-center"><img class="logo" src="<?= (isset($type) && $type == 'pdf')? getenv("DOCUMENT_ROOT").'assets/images/logoInformatika.jpg' : base_url('assets/images/logoInformatika.jpg')?>"/></div>
            </div>

        <?php elseif($kategori === "Monitor"): ?>
            <div class="col-xs-6 left">
                <p class="ruangan_barcode text-center <?= isset($info_barcode['lab'])? preg_replace('/\s+/', '', $info_barcode['lab']) : 'LAB' ?>" style="background-color: <?= isset($info_barcode['color'])? $info_barcode['color']: '#FF4500' ?>; color: #fff; margin:0;">
                    <b class="ruangan_text"><?= isset($info_barcode['lab'])? $info_barcode['lab']: 'LAB' ?></b>
                </p>
                <p class="text-center" style="padding-top:25px; padding-bottom:13px; font-size: 1.5rem;">
                    <span class="nomor_barcode "><?= isset($nomor_kursi)? $nomor_kursi.' / ' : '' ?> </span>
                    <b class="kode_barcode" style="border-bottom: 5px solid <?= (isset($warna_label)? $warna_label : '#1E90FF') ?>;"><?= isset($kode)? $kode:'' ?></b>
                </p>
                <div class="text-center"><img class="logo" src="<?= (isset($type) && $type == 'pdf')? getenv("DOCUMENT_ROOT").'assets/images/logoInformatika.jpg' : base_url('assets/images/logoInformatika.jpg')?>"/></div>
            </div>

        <?php else: ?>
            <div class="col-xs-6 left">
                <p class="ruangan_barcode text-center <?= isset($info_barcode['lab'])? preg_replace('/\s+/', '', $info_barcode['lab']) : 'LAB' ?>" style="background-color: <?= isset($info_barcode['color'])? $info_barcode['color']: '#FF4500' ?>; color: #fff; margin:0;">
                    <b class="ruangan_text"><?= isset($info_barcode['lab'])? $info_barcode['lab']: 'LAB' ?></b>
                </p>
                <p class="text-center" style="padding-top:25px; padding-bottom:13px; font-size: 1.5rem;">
                    <b class="kode_barcode text-center" <?= (isset($warna_label)? "style='border-bottom: 5px solid $warna_label'" : '') ?>><?= isset($kode)? $kode:'' ?></b>
                </p>
                <div class="text-center"><img class="logo" src="<?= (isset($type) && $type == 'pdf')? getenv("DOCUMENT_ROOT").'assets/images/logoInformatika.jpg' : base_url('assets/images/logoInformatika.jpg')?>"/></div>
            </div>
        <?php endif; ?>

        <div class="col-xs-6 text-center right";>
            <div class="row">
                <?php if(isset($type) && $type == 'pdf'): ?>
                    <div class="col-xs-12">
                        <img class="barcode" src="<?= isset($barcode)? $barcode : base_url('barcode/imgbarcode64/'.$kode)?>"/>
                        <img class="qrcode" src="<?= isset($qrcode)? $qrcode : base_url('barcode/imgqrcode64/'.$kode)?>" />
                    </div>
                <?php else: ?>
                    <div class="col-xs-12">                    
                        <img class="barcode" src="<?= isset($kode)? base_url('barcode/imgbarcode/'.$kode) : ''?>"/>
                        <img class="qrcode" src="<?= isset($kode)? base_url('barcode/imgqrcode/'.$kode) : ''?>" />
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

        
