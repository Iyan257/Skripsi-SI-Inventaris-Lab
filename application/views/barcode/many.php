<!doctype html>
<!--<html lang="en" class="fixed sidebar-left-collapsed">-->
<html lang="en" class="fixed">
<head>
	<title>Inventaris Lab TIF &middot; Admin <?= isset($subtitle)? "&middot; $subtitle" : '' ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.css')?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/stylesheets/barcode-print.php?info=').$info_barcode ?>" />
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js')?>"></script>

    <style>
        body {
            margin-left:20px;
        }
        .identitas {
            max-width: 260px;
            min-width: 260px;
            height: auto;
            border: 1px solid black;
            margin-top: 12px;
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
            padding:0;
        }

        .inner{
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-3"><h2>Create Barcode</h2></div>
        <div class="col-md-2"><h2><button id="btn_print" class="btn btn-success text-left">Print</button>
        <a class="btn btn-primary" href="<?= base_url('barcode')?>">Back</a>
        </h2></div>
    </div>
    <div class="row" id="print_div" style="padding-left:40px;">
        <div class="row">
        <?php foreach($info as $j => $i): ?>
            <?php if($j % 24 == 0 && $j != 0) : ?>
                </div>
                <div class="row">
            <?php endif; ?>
            <?php $this->load->view('barcode/label_general', $i); ?>
        <?php endforeach; ?>
        </div>
    </div>

    <script>
    var finish_loaded = false;

    $(window).load(function() {
        finish_loaded = true;
        alert('done');

        $('#btn_print').click(function(){
            window.print();
        });
    });
    $(document).bind("keyup keydown", function(e){
        if(e.ctrlKey && e.keyCode == 80){
            if(finish_loaded){
                return finish_loaded;
            }else{
                alert('please wait until all barcode sucessfully generated.');
            }
        }
    });
    </script>
</body>
