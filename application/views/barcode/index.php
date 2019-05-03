<section class="panel">
    <header class="panel-heading">
        <h3 class = "panel-title" ><?= isset($header)? $header: 'Buat Identitas dengan ID / KODE' ?></h3>
    </header>
	<div class="panel-body">
        <div class="row" >
            <?= form_open('barcode/create_many', ['class' => 'form-horizontal mb-lg']) ?>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-3 control-label" >Dengan</label>
                        <span class="col-md-2"><input type="radio" name="metode" id="radio_id" value="id" checked="checked"/> ID</span>
                        <span class="col-md-2"><input type="radio" name="metode" id="radio_kode" value="kode"/> Kode</span>
                    </div>
                    <div class="form-group" id="div_id">
                        <label class="col-md-3 control-label" for="id_select">ID Aset</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="id_select" id="id_select" placeholder="contoh input dapat berupa 1-5, 8, 11-13">
                        </div>
                    </div>
                    <div class="form-group" id="div_kode">
                        <label class="col-md-3 control-label" for="kode_select">Kode Aset</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="kode_select" id="kode_select" placeholder="contoh input dapat berupa ABCD, DEFG, HIJK">
                        </div>
                    </div>
                </div>
                <div class="col-md-12 center"style="margin-top:20px;">
                    <button type ="submit" class="btn btn-success">Buat</button>
                    <button type ="reset" class="btn btn-danger">Batal</button>
                </div>
            </form>
        </div>
    </div>
</section>    

<section class="panel">
    <?= form_open_multipart('barcode/create_from_excel',['class'=>'form-horizontal mb-lg']) ?>
        <header class="panel-heading">
            <h2 class="panel-title">Pilih Aset dari File</h2>
        </header>
        <div class="panel-body">
            <!-- Download template Button -->
            <div class="form-group">
                <label class="col-md-4 control-label">Download file</label>
                <div class="col-md-4">
                    <a href="<?= base_url('barcode/downloadAssets') ?>"><i class="fa fa-download"></i> Download</a>
                </div>
            </div>

            <!-- File Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="filebutton">Select file</label>
                <div class="col-md-4">
                    <input type="file" name="file" id="file" class="input-large">
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label">Import data</label>
                <div class="col-md-4">
                    <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div>

        </div>
    </form>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>

<script>
    $(document).ready(function(){
       
        $('#btn-Convert-Html2Image').click(function(){
            html2canvas([document.getElementById('html-content-holder')],
            {
            onrendered: function (canvas) {
                var a = $("<a>").attr("href", canvas.toDataURL('image/png'))
                .attr("download", "output.png")
                .appendTo("body");
                a[0].click();
                a.remove();
                var imgData = canvas.toDataURL(
                    'image/png');
                console.log(imgData);
            }
            });
        });

        $('#div_kode').hide();
        $('input[type=radio][name=metode]').change(function() {
            if (this.value == 'id') {
                $('#div_kode').hide();
                $('#div_id').show();
                $('input[name=kode_select]').val("");
            }
            else{
                $('#div_kode').show();
                $('#div_id').hide();
                $('input[name=id_select]').val("");
            }
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
        line-height: 100px;
        position: relative;
		display: inline-block;
		margin: 0 15px;
        line-height: 100px;
	}

    .inner{
        vertical-align: middle;
    }
	
</style>