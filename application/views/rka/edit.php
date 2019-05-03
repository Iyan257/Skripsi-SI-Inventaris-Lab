<div id="addRKAModal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <?= form_open('kalab/rka/edit/'.$id, ['id'=>'create_form'])?>
            <header class="panel-heading">
                <h2 class="panel-title">Form Tambah Item</h2>
            </header>
            <div class="panel-body">
                <input type="hidden" name="judul" id="judul_item" />
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="latar_belakang">Latar belakang</label>
                    <div class="col-sm-9">
                        <textarea id="latar_belakang" name="latar_belakang" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="kegiatan">Kegiatan <span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="kegiatan" name="kegiatan" class="form-control" placeholder="nama kegiatan" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="nama_barang">Nama barang<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control" placeholder="nama barang" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="banyak">Banyaknya<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="number" id="banyak" name="banyak" class="form-control" min="1" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="satuan">Satuan<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <select name='satuan' id='satuan' class="form-control" required>
                            <option disabled selected>Pilih satuan</option>
                            <option value="buah">buah   (1)</option>
                            <option value="lusin">lusin (12)</option>
                            <option value="kodi">kodi   (20)</option>
                            <option value="gross">gross (144)</option>
                            <option value="rim">rim     (500)</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="perkiraan_biaya">Perkiraan biaya per satuan<span class="required">*</span></label>
                    <span class="col-sm-1">Rp</span>
                    <div class="col-sm-7">
                        <input type="number" id="perkiraan_biaya" name="perkiraan_biaya" class="form-control" min="0" required/>
                    </div>
                    <span class="col-sm-1">,00</span>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="btnSubmit" class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-default modal-dismiss">Cancel</button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

<div id="updateStatusModal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <?= form_open('kalab/rka/edit/'.$id, ['id'=>'edit_form'])?>
            <header class="panel-heading">
                <h2 class="panel-title">Barang yang Direalisasi</h2>
            </header>
            <div class="panel-body">
                <input type="hidden" name="update_status_disetujui"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >Apakah sama dengan rencana ?</label>
                    <div class="col-sm-9">
                        <span class="col-sm-6"><input type="radio" name="same_option" id="same_radio" value="same" checked="checked"/> Sama</span>
                        <span class="col-sm-6"><input type="radio" name="same_option" id="change_radio" value="change"/> Berubah</span>
                    </div>
                </div>
                <div id="div_disetujui_berubah">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="banyak_disetujui">Banyaknya<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" id="banyak_disetujui" name="banyak_disetujui" class="form-control" min="1"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="satuan_disetujui">Satuan<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select name='satuan_disetujui' id='satuan_disetujui' class="form-control">
                                <option disabled selected>Pilih satuan</option>
                                <option value="buah">buah   (1)</option>
                                <option value="lusin">lusin (12)</option>
                                <option value="kodi">kodi   (20)</option>
                                <option value="gross">gross (144)</option>
                                <option value="rim">rim     (500)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="btnSubmit" class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-default modal-dismiss" onclick="location.reload()">Cancel</button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

<div id="updateHargaModal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <?= form_open('kalab/rka/edit/'.$id, ['id'=>'edit_form'])?>
            <header class="panel-heading">
                <h2 class="panel-title">Harga Barang yang Terealisasi</h2>
            </header>
            <div class="panel-body">
                <input type="hidden" name="update_harga_disetujui"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="harga_satuan">Harga per satuan<span class="required">*</span></label>
                    <span class="col-sm-1">Rp</span>
                    <div class="col-sm-7">
                        <input type="number" id="harga_satuan" name="harga_satuan" class="form-control" min="0" required/>
                    </div>
                    <span class="col-sm-1">,00</span>
                </div>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button id="btnSubmit" class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-default modal-dismiss" onclick="location.reload()">Cancel</button>
                    </div>
                </div>
            </footer>
        </form>
    </section>
</div>

<div class="row">
    <header class="panel-heading">
        <h3 class = "panel-title" ><?= isset($header)? $header:'Edit Mutasi' ?></h3>
    </header>
    <div class="panel-body">
        <?= form_open('kalab/rka/update/'.$id, ['id'=>'update_form'])?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="tanggal_dibuat">Tanggal Dibuat <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <input type="date" id="tanggal_dibuat" name="tanggal_dibuat" class="form-control" value="<?= isset($rka['created_at'])? substr($rka['created_at'],0,10):'' ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="judul">Judul <span class="required">*</span></label>
                    <div class="col-sm-8">
                    <input type="text" id="judul" name="judul" class="form-control" value="<?=isset($judul)? $judul: isset($rka['judul'])? $rka['judul']:''?>"  required/>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <div class="col-md-4">
                    <a class="modal-with-zoom-anim btn btn-success" href="#addRKAModal"><i class="fa fa-plus"></i> Tambah</a>
                    <a id="updateStatusBtn" class="modal-with-zoom-anim btn btn-success" href="#updateStatusModal" style="display:none;"><i class="fa fa-plus"></i> Update</a>
                    <a id="updateHargaBtn" class="modal-with-zoom-anim btn btn-success" href="#updateHargaModal" style="display:none;"><i class="fa fa-plus"></i> Update</a>
                </div>
            </div>
        </div>
            <input type="hidden" name="total_biaya" value="0" />
            <input type="hidden" name="total_terealisasi" value="0" />
        </form>
        <hr>
        <div class="row"  style="overflow: auto;">
            <div class="col-sm-12">
                <?php if(count($items) > 0): ?>
                    <table class="table table-bordered table-striped mb-none" id="table">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center">Kegiatan / Uraian</th>
                                <th rowspan="2" class="text-center">Nama Barang</th>
                                <th colspan="4" class="text-center">Rencana</th>
                                <th colspan="4" class="text-center">Terealisasi</th>
                                <th rowspan="2"  class="text-center"style="min-width:250px;">Latar Belakang</th>
                                <th rowspan="2"class="kolom_aksi text-center" style="min-width:200px;">Status</th>
                                <th rowspan="2" class="kolom_aksi text-center">Aksi</th>
                            </tr>
                            <tr>
                                <th>Banyaknya</th>
                                <th>Satuan</th>
                                <th rowspan="2" class="text-center">Harga Satuan</th>
                                <th rowspan="2" class="text-center">Perkiraan Biaya</th>
                                <th>Banyaknya</th>
                                <th>Satuan</th>
                                <th rowspan="2" class="text-center">Harga Satuan</th>
                                <th rowspan="2" class="text-center">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody id="tbody"> 
                            <?php if(isset($items) && count($items) > 0):?>
                            <?php foreach($items as $i => $item): ?>
                                <tr>
                                    <td><?= $item['kegiatan'] ?></td>
                                    <td><?= $item['nama_barang'] ?></td>
                                    <td><?= $item['banyak'] ?></td>
                                    <td><?= $item['satuan'] ?></td>
                                                                        
                                    <?php 
                                        $m = $item['banyak_disetujui'];

                                        $n = $item['banyak'];
                                    ?>
                                    <?php if($item['perkiraan_biaya']!= 0): ?>
                                        <td><?= 'Rp '. number_format($item['perkiraan_biaya'] / $n) . ',00'?></td>
                                        <td><?= 'Rp '. number_format($item['perkiraan_biaya']) . ',00'?></td>
                                    <?php else: ?>
                                        <td><?= 'Rp '. '0' . ',00'?></td>
                                        <td><?= 'Rp '. '0' . ',00'?></td>
                                    <?php endif; ?>

                                    <td><?= isset($item['banyak_disetujui'])? $item['banyak_disetujui']:'' ?></td>
                                    <td><?= isset($item['satuan_disetujui'])? $item['satuan_disetujui']:'' ?></td>

                                    <?php if($item['total_terealisasi']!= 0): ?>
                                        <td><?= 'Rp '. number_format($item['total_terealisasi'] / $m) . ',00'?></td>
                                        <td><?= 'Rp '. number_format($item['total_terealisasi']) . ',00'?></td>
                                    <?php else: ?>
                                        <td><?= 'Rp '. '0' . ',00'?></td>
                                        <td><?= 'Rp '. '0' . ',00'?></td>
                                    <?php endif; ?>

                                    <td><?= $item['latar_belakang'] ?></td>
                                    <?= form_open('kalab/rka/edit/'.$id, ['id' => "update_$i"]); ?>
                                        <td style="width:200px;">
                                            <select name='status' id='status' class="form-control" onchange="if($('option:selected',this).val()=='disetujui'){$('input[name = update_status_disetujui]').val('<?= $item['id'] ?>');$('#updateStatusBtn').click();} else if($('option:selected',this).val()=='disetujui_terealisasi'){if(confirm('Apakah jumlah aset yang direncanakan / disetujui sudah sesuai dengan yang direalisasi ?')){$('input[name = update_harga_disetujui]').val('<?= $item['id'] ?>');$('#updateHargaBtn').click();} else{location.reload();}} else{$('#update_<?= $i ?>').submit()}" required>
                                                <option value="diproses" <?= (isset($item['status']) && $item['status']=='diproses')? 'selected' : '' ?> <?php $arr = ['disetujui', 'disetujui_terealisasi', 'ditolak']; if(in_array($item['status'], $arr )){ echo 'disabled';}?>>[0] Diproses</option>
                                                <option value="disetujui" <?= (isset($item['status']) && $item['status']=='disetujui')? 'selected' : '' ?> <?php $arr = ['disetujui_terealisasi', 'ditolak']; if(in_array($item['status'], $arr )){ echo 'disabled';}?>>[1] Disetujui dan/atau berubah</option>
                                                <option value="disetujui_terealisasi" <?= (isset($item['status']) && $item['status']=='disetujui_terealisasi')? 'selected' : '' ?> <?php $arr = ["ditolak"]; if(in_array($item['status'], $arr )){ echo 'disabled';}?>>[2] Disetujui sudah terealisasi</option>
                                                <option value="ditolak" <?= (isset($item['status']) && $item['status']=='ditolak')? 'selected' : '' ?>  <?php $arr = ["disetujui_terealisasi"]; if(in_array($item['status'], $arr )){ echo 'disabled';}?>>[3] Ditolak</option>
                                            </select>
                                        </td>
                                        <input type="hidden" name="update_status" value="<?= $item['id'] ?>"/>
                                    </form>
                                    </td>
                                    <td class="text-center" style="width:100px;">
                                        <button class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                    <?= form_open('kalab/rka/edit/'.$id, ['id' => "del_$i"]); ?>
                                        <input type="hidden" name="delete" value="<?=$item['id']?>" />
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <tr>
                                <th colspan="5" class="text-right">Total</th>
                                <td colspan="1" class="text-left">Rp <?= isset($total_biaya)? number_format($total_biaya) : '0'?>,00</td>
                                <th colspan="3" class="text-right">Total</th>
                                <td colspan="4" class="text-left">Rp <?= isset($total_terealisasi)? number_format($total_terealisasi) : '0'?>,00</td>
                            </tr>
                        </tbody>
                    </table>
                <?php else:?>
                    <div class="col center">
                        <b class="text-danger">Items list is empty.</b>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <hr>
    </div>
    <footer class="panel-footer">
        <div class="row">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary" onclick="$('#update_form').submit()">Save</button>
                <a class="btn btn-default" href="<?= base_url('kalab/rka/index')?>">Cancel</a>
            </div>
        </div>
    </footer>
    </form>              
</div>

<script>
    var total = <?php echo json_encode($total_biaya)?>;
    var total_terealisasi = <?php echo json_encode($total_terealisasi)?>;

    $(document).ready(function (){
        $('input[name = total_biaya]').val(total);
        $('input[name = total_terealisasi]').val(total_terealisasi);
        $('#judul').change(function(){
            $('#judul_item').val($('#judul').val());
        });

        $("#div_disetujui_berubah").hide();
        $('input[type=radio][name=same_option]').change(function() {
            if (this.value == 'same') {
                $("#div_disetujui_berubah").hide();
                $("input [name=banyak_disetujui]").val("");
                $("input [name=satuan_disetujui]").val("");
            }
            else if (this.value == 'change') {
                $("#div_disetujui_berubah").show();
            }
        });
    });

</script>