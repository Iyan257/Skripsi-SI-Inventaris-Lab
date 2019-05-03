<div id="addRKAModal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <?= form_open('kalab/rka/create', ['id'=>'create_form'])?>
            <header class="panel-heading">
                <h2 class="panel-title">Form Tambah Rencana</h2>
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
                            <option value="buah">buah</option>
                            <option value="lusin">lusin</option>
                            <option value="gross">gross</option>
                            <option value="kodi">kodi</option>
                            <option value="rim">rim</option>
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

<div class="row">
    <header class="panel-heading">
        <h3 class = "panel-title" > Form Tambah RKA</h3>
    </header>
    <div class="panel-body">
        <?= form_open('kalab/rka/store', ['id'=>'store_form'])?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="tanggal_dibuat">Tanggal Dibuat <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <input type="date" id="tanggal_dibuat" name="tanggal_dibuat" class="form-control" value="<?=date('Y-m-d')?>" disabled="true"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="judul">Judul <span class="required">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" id="judul" name="judul" class="form-control" value="<?=isset($judul)? $judul:''?>" placeholder="judul"  required/>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-right">
                <!--<div class="col-md-2">
                    <button class="btn btn-success" type="button" id="btnTambah"><i class="fa fa-plus"></i> Tambah Item</button>
                </div>-->
                <div class="col-md-4">
                    <a class="modal-with-zoom-anim btn btn-success" href="#addRKAModal"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            </div>
        </div>
            <input type="hidden" name="total_biaya" value="0" />
        </form> 
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <?php if(count($items) > 0): ?>
                    <table class="table table-bordered table-striped mb-none" id="table">
                        <thead>
                            <tr>
                                <th>Kegiatan / Uraian</th>
                                <th>Nama Barang</th>
                                <th>Banyaknya</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Perkiraan Biaya</th>
                                <th>Latar Belakang</th>
                                <th class="kolom_aksi">Aksi</th>
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
                                    <?php $n = $item['banyak'];
                                        if($item['satuan'] == "lusin"){$n *= 12;}
                                        else if($item['satuan'] == "gross"){$n *= 144;}
                                        else if($item['satuan'] == "kodi"){$n *= 20;}
                                        else if($item['satuan'] == "rim"){$n *= 500;}
                                        else {$n *= 1;}
                                    ?>
                                    <td><?= 'Rp '. number_format($item['perkiraan_biaya'] / $n) . ',00'?></td>
                                    <td><?= 'Rp '. number_format($item['perkiraan_biaya']) . ',00'?></td>
                                    <td><?= $item['latar_belakang'] ?></td>
                                    <td class="text-center" style="width:150px;">
                                        <button class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure you want to delete?')){$('#del_<?= $i ?>').submit()}"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                    <?= form_open('kalab/rka/create', ['id' => "del_$i"]); ?>
                                        <input type="hidden" name="delete" value="<?=$item['id']?>" />
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <tr>
                                <th colspan="5" class="text-right">Total</th>
                                <td colspan="3" class="text-left">Rp <?= isset($total_biaya)? number_format($total_biaya) : '0'?>,00</td>
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
    </div>
    <footer class="panel-footer">
        <div class="row">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary" onclick="$('#store_form').submit()">Save</button>
                <a class="btn btn-default" href="<?= base_url('kalab/rka/index')?>">Cancel</a>
            </div>
        </div>
    </footer>
                      
</div>

<script>
    //toggle select all checkbox
    var total = <?php echo json_encode($total_biaya); ?> ;

    $(document).ready(function (){
        $('input[name = total_biaya]').val(total);
        $('#judul').change(function(){
            $('#judul_item').val($('#judul').val());
        });

    });
</script>