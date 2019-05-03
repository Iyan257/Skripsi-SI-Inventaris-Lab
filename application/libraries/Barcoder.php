<?php

/**
 * Simple barcode library.
 */
use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

class Barcoder
{

    /**
     * CodeIgniter instance.
     *
     * @var mixed
     */
    private $CI;

    /**
     * Barcode's config.
     *
     * @var array
     */
    private $config;

    private $info;

    /**
     * Barcode constructor.
     */
    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->config('barcoder', true);
        $this->config = $this->CI->config->config['barcoder'];
        $this->info = $this->config['posisi'];
    }

    public function getBarcode($kode=''){
		$br_1128 = new BarcodeGenerator();
		$br_1128->setText($kode);
		$br_1128->setType(BarcodeGenerator::Code128);
		$br_1128->setScale(2);
		$br_1128->setThickness(25);
		$br_1128->setLabel("");
		$code = base64_decode($br_1128->generate());
        header("Content-type: image/png");
		echo $code;	
	}

	public function getQRCode($text=''){
		$br_qr = new QrCode();
		$br_qr->setText($text);
		$br_qr->setSize(75);
		$br_qr->setPadding(5);
		$br_qr->setErrorCorrection('high');
		$br_qr->setLabel("");
		$br_qr->setImageType(QrCode::IMAGE_TYPE_PNG);
		$code = base64_decode($br_qr->generate());
	
		header("Content-type: image/png");
		echo $code;		
    }
    
    public function getBarcodeBase64($kode=''){
        $br_1128 = new BarcodeGenerator();
		$br_1128->setText($kode);
		$br_1128->setType(BarcodeGenerator::Code128);
		$br_1128->setScale(2);
		$br_1128->setThickness(25);
		$br_1128->setLabel("");
		$code = base64_decode($br_1128->generate());
        $code = base64_encode($code);
        return $code;
    }
    
    public function getQRCodeBase64($text=''){
		$br_qr = new QrCode();
		$br_qr->setText($text);
		$br_qr->setSize(75);
		$br_qr->setPadding(5);
		$br_qr->setErrorCorrection('high');
		$br_qr->setLabel("");
		$br_qr->setImageType(QrCode::IMAGE_TYPE_PNG);
		$code = base64_decode($br_qr->generate());
        $code = base64_encode($code);
        return $code;		
    }

    public function getInfo($lab = null){
        if($lab === null){
            return $this->info;
        }
        if(!isset($this->info[$lab])){
            return $this->info['default'];
        }else{
            return $this->info[$lab];
        }
    }
}
