<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.css')?>" />
        <style>
            table {
                border-collapse: collapse;
                margin: 0 auto;
                width: 100%;
            }

            table, th, td {
                border: 1px solid black;
                text-align: center;
            }

            th{
                height: 50px;
            }
        </style>
    </head>
    <body>
        <div class="row" style="border: 1px solid grey;">
            <div class="col-xs-2" style="overflow:hidden;">
                <img src="assets/images/logoInformatika.jpg" style="margin-top:5; width:140; height:40;">
            </div>
            <div class="col-xs-9 text-center" >
                <h3>SISTEM INFORMASI INVENTARIS BARANG LAB. KOMPUTASI TIF UNPAR</h3>
                <h4><b>Jalan Ciumbuleuit No. 94, Bandung</b></h4>
            </div>
        </div>
        <div class="row" style="margin-top:20px;">    
            <div class="col-xs-12 text-center">
                <b><?= $title?></b>
            </div>
        </div>
        <div class="row" style="margin-top:20px;">
            <div class="col-xs-12 text-center">
                <?php if(count($assets) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Kategori khusus</th>
                                <th>Tanggal penerimaan</th>
                                <th>Ruangan</th>
                                <th>Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($assets as $i => $asset): ?>
                                <tr>
                                    <td><?= $i+1 ?></td>
                                    <td><?= $asset['kode']?></td>
                                    <td><?= $asset['nama_aset']?></td>
                                    <td><?= $asset['nama_kategori']?></td>
                                    <td><?= $asset['nama_kategori_khusus']?></td>
                                    <td><?= $asset['tanggal_penerimaan']?></td>
                                    <td><?= $asset['nama']?></td>
                                    <td><?= $asset['kondisi']?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else:?>
                    <div class="col center">
                        <b class="text-danger">Assets list is empty.</b>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>

