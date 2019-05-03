<?php 
    header("Content-type: text/css; charset: UTF-8");
    //$background_color = '#'.$_GET['color'];
?>
    @media print{
        body * {
            visibility: hidden;
        }
        #print_div, #print_div *, .pagebreak, .pagebreak * {
            visibility: visible;
            -webkit-print-color-adjust: exact; 
        }
        #print_div{
            position: absolute;
            left: 20px;
            top: 0;
        }
        #print_div .row {
            page-break-before: always;
        }
        .ruangan_barcode, .ruangan_barcode:before, .ruangan_barcode:after {
            margin:0;
            <!--background-color: <?//php echo $background_color;?> !important; -->
            color: white !important; 
            -webkit-print-color-adjust: exact; 
        }
        
        .ruangan_barcode .ruangan_text{
            color: #fff !important;
        }
        
        <?php
            $arr = explode("|", $_GET['info']);
            foreach($arr as $a){
                $temp = explode("=",$a);
                echo ' .'.$temp[0].'{background-color: #'.$temp[1].' !important; -webkit-print-color-adjust: exact;} ';
            }
        ?>
        <!--.LAB1{
            background-color: #ff3d00 !important;
            -webkit-print-color-adjust: exact;
        }
        .LAB2{
            background-color: #0277bd !important;
            -webkit-print-color-adjust: exact;
        } 
        .LAB3{
            background-color: #00701a !important;
            -webkit-print-color-adjust: exact;
        }
        .LAB4{
            background-color: #ff6f00 !important;
            -webkit-print-color-adjust: exact;
        }
        .LAB9{
            background-color: #4527a0 !important;
            -webkit-print-color-adjust: exact;
        }
        .Gudang {
            background-color: #4527a0 !important;
            -webkit-print-color-adjust: exact;
        }-->

        

        .identitas {
            margin-left:5px;
        }
    }