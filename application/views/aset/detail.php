<div class="row">
    <div class="col-md-12">
        <div class="tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#informasi" id="info" data-toggle="tab">
                        Informasi Aset
                    </a>
                </li>
                <li>
                    <a href="#riwayat" id="history" data-toggle="tab">
                        Riwayat Perbaikan
                    </a>
                </li>
            </ul>
            <div class="tab-content" style="padding-bottom:0; border-bottom:0;">
                <div id="informasi" class="tab-pane active">
                    <header class="panel-heading">
                        <h3 class = "panel-title" ><?= isset($header)? $header:'Aset' ?></h3>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="kode">Kode Barang</label>
                                    <div class="col-sm-7">
                                        <input type="text" id="kode" name="kode" class="form-control" value="<?= $asset['kode']?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="merek">Merek</label>
                                    <div class="col-sm-7">
                                        <input type="text" id="merek" name="merek" class="form-control" value="<?= $asset['merek']?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="ruangan">Ruangan</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="ruangan" name="ruangan" class="form-control" value="<?= $asset['nama']?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="kondisi">Kondisi</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="kondisi" name="kondisi" class="form-control" value="<?= $asset['kondisi']?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <?php if(isset($asset['kode']) && isset($asset['merek']) && isset($asset['tanggal_penerimaan']) && isset($asset['nama'])) : ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Identitas</label>
                                    <div class="col-sm-9">
                                        <?php 
                                            $data = [
                                                'kode' => $asset['kode'],
                                                'merek' => $asset['merek'],
                                                'tahun_pembelian' => substr($asset['tanggal_penerimaan'],0,4),
                                                'kategori' => $asset['nama_kategori_khusus'],
                                                'nomor_kursi' => $asset['nomor_kursi'],
                                                'nomor_identitas' => $asset['nomor_identitas'],
                                                'info_barcode' => $this->barcoder->getInfo($asset['nama']),
                                            ];
                                        $this->load->view('barcode/label_general', $data); ?>
                                    </div>
                                    
                                    <div class="col-md-9 col-md-offset-3 text-left"style="margin-top:20px;">
                                        <button id="btn-Convert-Html2Image" class="btn btn-primary"><i class="fa fa-download"></i> Download barcode</button>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12" style="margin-bottom:20px">
                                    <?php if($asset['gambar'] != null): ?>
                                        <img src="<?php echo base_url('assets/images/aset/'.$asset['gambar'])?>" style="max-width:100%; max-height:150px;" alt="<?= $asset['gambar']?>" />
                                    <?php else: ?>
                                        Tidak ada gambar
                                    <?php endif;?>
                                </div>
                                <?php if($asset['nomor_kursi'] != null): ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="nomor_kursi">Nomor kursi</label>
                                        <div class="col-sm-9">
                                            <input type="number" id="nomor_kursi" name="nomor_kursi" class="form-control" value="<?= isset($asset['nomor_kursi'])? $asset['nomor_kursi'] : ''?>" readonly="readonly"/>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($asset['nomor_identitas'] != null): ?>
                                    <div class="form-group" id="identitas_nomor">
                                        <label class="col-sm-3 control-label" for="nomor_identitas">Nomor identitas</label>
                                        <div class="col-sm-9">
                                            <input type="number" id="nomor_identitas" name="nomor_identitas" class="form-control" placeholder="nomor identitas" value="<?= (isset($asset['nomor_identitas']))? $asset['nomor_identitas']:'' ?>" min='1'/>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="keterangan">Keterangan</label>
                                    <div class="col-sm-11">
                                        <textarea type="textarea" id="keterangan" name="keterangan" class="form-control"><?= isset($asset['keterangan'])? $asset['keterangan'] :'-' ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($specification) && $specification !== null):?>
                        <div class="row">
                            <hr>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="type">Type</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="type" name="type" class="form-control" value="<?= $specification['type'] ?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="port">Jumlah Port</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="port" name="port" class="form-control" value="<?= $specification['jumlah_port'] ?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="processor">Processor</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="processor" name="processor" class="form-control" value="<?= $specification['processor'] ?>" readonly="readonly"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="os">Sistem Operasi</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="os" name="os" class="form-control" value="<?= $specification['os'] ?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="memory">Memory</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="memory" name="memory" class="form-control" value="<?= $specification['memory'] ?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="hard_drive">Hard Drive</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="hard_drive" name="hard_drive" class="form-control" value="<?= $specification['hard_drive'] ?>" readonly="readonly"/>
                                    </div>
                                </div>
                                <div class="form-group mt-lg">
                                    <label class="col-sm-3 control-label" for="keterangan">Keterangan </label>
                                    <div class="col-sm-9">
                                        <textarea id="keterangan" name="keterangan" class="form-control" ><?= $specification['keterangan'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>

                        <?php if(in_array("kalab", $groups) || in_array("input_admin", $groups)) :?>
                        <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="tanggal_penerimaan">Tanggal penerimaan</label>
                                        <div class="col-sm-9">
                                            <input type="date" id="tanggal_penerimaan" name="tanggal_penerimaan" class="form-control" value="<?= $asset['tanggal_penerimaan']?>" readonly="readonly"/>
                                        </div>
                                    </div>
                                    <?php if($asset['umur_ekonomis']!==null):?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="umur_ekonomis">Umur ekonomis</label>
                                        <div class="col-sm-7">
                                            <input type="number" id="umur_ekonomis" name="umur_ekonomis" class="form-control" value="<?= $asset['umur_ekonomis']?>" readonly="readonly" min='0'/>
                                        </div>
                                        <label class="col-sm-2 control-label text-left" >tahun</label>
                                    </div>
                                    <?php endif;?>
                                </div>
                                <div class="col-md-6">
                                    <?php if(in_array("kalab", $groups)) : ?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="nilai_aset">Nilai aset</label>
                                        <div class="col-sm-9">
                                            <input type="number" id="nilai_aset" name="nilai_aset" class="form-control" value="<?= $asset['nilai_aset']?>" readonly="readonly" min='0'/>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($asset['gambar'] != null): ?>
                                    <div class="form-group">
                                        <?php if(in_array("kalab", $groups)):?>
                                            <label class="col-sm-6 control-label"><a href="<?= base_url('kalab/aset/downloadImage/' . $asset['id']) ?>"><i class="fa fa-download"></i> Download gambar</a></label>
                                        <?php elseif(in_array("input_admin", $groups)): ?>
                                            <label class="col-sm-6 control-label"><a href="<?= base_url('admin/aset/downloadImage/' . $asset['id']) ?>"><i class="fa fa-download"></i> Download gambar</a></label>
                                        <?php else: ?>
                                            <label class="col-sm-6 control-label"><a href="<?= base_url('aset/downloadImage/' . $asset['id']) ?>"><i class="fa fa-download"></i> Download gambar</a></label>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(isset($asset['nomor_kursi']) && $asset['nomor_kursi']!==null):?>
                        <div class="row">
                            <hr>
                            <div class="col-md-12">
                                <b>Denah aset</b>
                            </div>
                            <div class="col-md-6">
                            <?php if($asset['ruangan'] == '0915'):?>
                                <table class="table" style="empty-cells: show;">
                                    <tbody>
                                        <tr>
                                            <td rowspan="9" style="vertical-align : middle;text-align:center; background:grey; color:white; max-width:10px;">
                                                <div class="rotate">Papan</div>
                                            </td>
                                            <td style="background:brown; color:white"><div class="rotate">Meja</div></td>
                                            <td id="pos_29">29</td><td id="pos_30">30</td><td id="pos_31">31</td><td id="pos_32">32</td><td id="pos_33">33</td><td id="pos_34">34</td><td id="pos_35">35</td>
                                        </tr>
                                        <tr><td rowspan="8"><td colspan="6"></td></tr>
                                        <tr>
                                            <td id="pos_22">22</td><td id="pos_23">23</td><td id="pos_24">24</td><td id="pos_25">25</td><td id="pos_26">26</td><td id="pos_27">27</td><td id="pos_28">28</td>
                                        </tr>
                                        <tr><td colspan="7"></td></tr>
                                        <tr>
                                            <td id="pos_15">15</td><td id="pos_16">16</td><td id="pos_17">17</td><td id="pos_18">18</td><td id="pos_19">19</td><td id="pos_20">20</td><td id="pos_21">21</td>
                                        </tr>
                                        <tr>
                                            <td id="pos_8">8</td><td id="pos_9">9</td><td id="pos_10">10</td><td id="pos_11">11</td><td id="pos_12">12</td><td id="pos_13">13</td><td id="pos_14">14</td>
                                        </tr>
                                        <tr><td colspan="7"></td></tr>
                                        <tr>
                                            <td id="pos_1">1</td><td id="pos_2">2</td><td id="pos_3">3</td><td id="pos_4">4</td><td id="pos_5">5</td><td id="pos_6">6</td><td id="pos_7">7</td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php elseif($asset['ruangan'] == '0916'):?>
                                <table class="table" style="empty-cells: show;">
                                    <tbody>
                                        <tr>
                                            <td rowspan="9" style="vertical-align : middle;text-align:center; background:grey; color:white; max-width:10px;">
                                                <div class="rotate">Papan</div>
                                            </td>
                                            <td rowspan="7">
                                            <td id="pos_29">29</td><td id="pos_30">30</td><td id="pos_31">31</td><td id="pos_32">32</td><td id="pos_33">33</td><td id="pos_34">34</td><td id="pos_35">35</td>
                                        </tr>
                                        <tr><td colspan="6"></td></tr>
                                        <tr>
                                            <td id="pos_22">22</td><td id="pos_23">23</td><td id="pos_24">24</td><td id="pos_25">25</td><td id="pos_26">26</td><td id="pos_27">27</td><td id="pos_28">28</td>
                                        </tr>
                                        <tr><td colspan="7"></td></tr>
                                        <tr>
                                            <td id="pos_15">15</td><td id="pos_16">16</td><td id="pos_17">17</td><td id="pos_18">18</td><td id="pos_19">19</td><td id="pos_20">20</td><td id="pos_21">21</td>
                                        </tr>
                                        <tr>
                                            <td id="pos_8">8</td><td id="pos_9">9</td><td id="pos_10">10</td><td id="pos_11">11</td><td id="pos_12">12</td><td id="pos_13">13</td><td id="pos_14">14</td>
                                        </tr>
                                        <tr><td colspan="7"></td></tr>
                                        <tr>
                                            <td style="background:brown; color:white"><div class="rotate">Meja</div></td>
                                            <td id="pos_1">1</td><td id="pos_2">2</td><td id="pos_3">3</td><td id="pos_4">4</td><td id="pos_5">5</td><td id="pos_6">6</td><td id="pos_7">7</td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php elseif($asset['ruangan'] == '0917'):?>
                                <table class="table" style="empty-cells: show;">
                                    <tbody>
                                        <tr>
                                            <td rowspan="9" style="vertical-align : middle;text-align:center; background:grey; color:white; max-width:10px;">
                                                <div class="rotate">Papan</div>
                                            </td>
                                            <td rowspan="8"></td>
                                            <td id="pos_40">40</td><td id="pos_41">41</td><td id="pos_42">42</td><td id="pos_43">43</td><td id="pos_44">44</td><td id="pos_45">45</td>
                                        </tr>
                                        <tr><td colspan="6"></td></tr>
                                        <tr>
                                            <td id="pos_33">33</td><td id="pos_34">34</td><td id="pos_35">35</td><td id="pos_36">36</td><td id="pos_37">37</td><td id="pos_38">38</td><td id="pos_39">39</td>
                                        </tr>
                                        <tr>
                                            <td id="pos_25">25</td><td id="pos_26">26</td><td id="pos_27">27</td><td id="pos_28">28</td><td id="pos_29">29</td><td id="pos_30">30</td><td id="pos_31">31</td><td id="pos_32">32</td>
                                        </tr>
                                        <tr><td colspan="8"></td></tr>
                                        <tr>
                                            <td id="pos_17">17</td><td id="pos_18">18</td><td id="pos_19">19</td><td id="pos_20">20</td><td id="pos_21">21</td><td id="pos_22">22</td><td id="pos_23">23</td><td id="pos_24">24</td>
                                        </tr>
                                        <tr>
                                            <td id="pos_9">9</td><td id="pos_10">10</td><td id="pos_11">11</td><td id="pos_12">12</td><td id="pos_13">13</td><td id="pos_14">14</td><td id="pos_15">15</td><td id="pos_16">16</td>
                                        </tr>
                                        <tr><td colspan="8"></td></tr>
                                        <tr>
                                            <td style="background:brown; color:white"><div class="rotate">Meja</div></td>
                                            <td id="pos_1">1</td><td id="pos_2">2</td><td id="pos_3">3</td><td id="pos_4">4</td><td id="pos_5">5</td><td id="pos_6">6</td><td id="pos_7">7</td><td id="pos_8">8</td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php elseif($asset['ruangan'] == '0918'):?>
                                <table class="table" style="empty-cells: show;">
                                    <tbody>
                                        <tr>
                                            <td rowspan="9" style="vertical-align : middle;text-align:center; background:grey; color:white; max-width:10px;">
                                                <div class="rotate">Papan</div>
                                            </td>
                                            <td rowspan="8"></td>
                                            <td id="pos_35">35</td><td id="pos_36">36</td><td id="pos_37">37</td><td id="pos_38">38</td><td id="pos_39">39</td><td id="pos_40">40</td>
                                        </tr>
                                        <tr><td colspan="6"></td></tr>
                                        <tr>
                                            <td id="pos_29">29</td><td id="pos_30">30</td><td id="pos_31">31</td><td id="pos_32">32</td><td id="pos_33">33</td><td id="pos_34">34</td>
                                        </tr>
                                        <tr>
                                            <td id="pos_22">22</td><td id="pos_23">23</td><td id="pos_24">24</td><td id="pos_25">25</td><td id="pos_26">26</td><td id="pos_27">27</td><td id="pos_28">28</td>
                                        </tr>
                                        <tr><td colspan="7"></td></tr>
                                        <tr>
                                            <td id="pos_15">15</td><td id="pos_16">16</td><td id="pos_17">17</td><td id="pos_18">18</td><td id="pos_19">19</td><td id="pos_20">20</td><td id="pos_21">21</td>
                                        </tr>
                                        <tr>
                                            <td id="pos_8">8</td><td id="pos_9">9</td><td id="pos_10">10</td><td id="pos_11">11</td><td id="pos_12">12</td><td id="pos_13">13</td><td id="pos_14">14</td>
                                        </tr>
                                        <tr><td colspan="7"></td></tr>
                                        <tr>
                                            <td style="background:brown; color:white"><div class="rotate">Meja</div></td>
                                            <td id="pos_1">1</td><td id="pos_2">2</td><td id="pos_3">3</td><td id="pos_4">4</td><td id="pos_5">5</td><td id="pos_6">6</td><td id="pos_7">7</td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <?php if(in_array("kalab", $groups)) :?>
                                    <a class="btn btn-primary" href="<?= base_url('kalab/aset')?>">Back</a>
                                <?php elseif(in_array("input_admin", $groups)) :?>
                                    <a class="btn btn-primary" href="<?= base_url('admin/aset')?>">Back</a>
                                <?php else: ?>
                                    <a class="btn btn-primary" href="<?= base_url('aset')?>">Back</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </footer>         
                </div>
                <div id="riwayat" class="tab-pane">
                    <header class="panel-heading">
                        <h3 class = "panel-title" >Riwayat Perbaikan</h3>
                    </header>
                    <div class="panel-body">
                        <?php if(count($history) > 0): ?>
                            <table class="table mb-none" id="datatable-default">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Masalah</th>
                                        <th>Solusi</th>
                                        <th>Keterangan</th>
                                        <th>Surat</th>
                                        <th class="kolom_aksi" style="width:15%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($history as $i => $h): ?>
                                        <tr>
                                            <td><?= $h['kode']?></td>
                                            <td><?= isset($h['tanggal_masuk']) ? $h['tanggal_masuk'] : '-' ?></td>
                                            <td><?= isset($h['tanggal_selesai']) ? $h['tanggal_selesai']: '-' ?></td>
                                            <td><?= isset($h['masalah']) ? $h['masalah']: '-' ?></td>
                                            <td><?= isset($h['solusi']) ? $h['solusi']: '-' ?></td>
                                            <td><?= isset($h['keterangan']) ? $h['keterangan']: '-' ?></td>

                                            <?php if(isset($h['lampiran'])) : ?>
                                                <td><a href="<?= base_url('perbaikan/downloadSurat/' . $h['id']) ?>"><i class="fa fa-download"></i> download</a></td>
                                            <?php else: ?>
                                                <td>tidak ada</td>
                                            <?php endif; ?>

                                            <td class="text-center" style="min-width:100px;">
                                                <a  class="btn btn-sm btn-info" href="<?= base_url('perbaikan/edit/' . $h['id']) ?>"><i class="fa fa-edit"></i></a> 
                                                <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                            <?= form_open('perbaikan/delete/' . $h['id'], ['id' => "del_$i"]); ?></form>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else:?>
                            <div class="col center">
                                <b class="text-danger">Repairment history is empty.</b>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>

<script>
    $(document).ready(function(){
        //denah aset
        var nomor = '#pos_'+ $('#nomor_kursi').val();
        $(nomor).css('background-color', 'yellow');

        $('#btn-Convert-Html2Image').click(function(){
            html2canvas([document.getElementById('identitas_general')],
            {
            scale:2, 
            onrendered: function (canvas) {
                var a = $("<a>").attr("href", canvas.toDataURL('image/png'))
                .attr("download", "output.png")
                .appendTo("body");
                a[0].click();
                a.remove();
            }
            });
        });
    });
</script>

<style>
   .identitas {
        max-width: 260px;
        min-width: 260px;
        height: auto;
        border: 1px solid black;
        margin-top: 10px;
        background-color: white;
    }
    .left{
        padding:0;
    }
    .right{
        overflow:auto;
    }
    .barcode{
        height:28px;
    }
    .logo{
        height:20px; 
        width:100px;
    }

    .outer {
		width: 40px;
		height: 110px;
		position: relative;
		display: inline-block;
		margin: 0 15px;
        line-height: 100px;
	}
    .inner {
		width: 110px;
		font-size: 13px;
		font-color: #878787;
		position: absolute;
		top: 50%;
		left: 50%;
		border-bottom: 5px solid #1E90FF;
	}

    .rotate {
        -moz-transform: translateX(-50%) translateY(-50%) rotate(-90deg);
        -webkit-transform: translateX(-50%) translateY(-50%) rotate(-90deg);
        transform:  translateX(-50%) translateY(-50%) rotate(-90deg);
    }

</style>