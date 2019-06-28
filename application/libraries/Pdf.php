<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
//require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends Dompdf{
    public $filename;
    public function __construct(){
        parent::__construct();
    }
    
    protected function ci()
    {
        return get_instance();
    }
    
    public function load_view($view, $data = array()){
        $html = $this->ci()->load->view($view, $data, TRUE);
        $this->load_html($html);
        // Render the PDF
        $this->render();
        // Output the generated PDF to Browser
        $this->stream($this->filename, array("Attachment" => false));
        
        /*$this->SetTitle($data['title']);
        $this->SetAutoPageBreak(true);
        $this->AddPage('L');
        $html = $this->ci()->load->view($view, $data, TRUE);
        $this->writeHTML($html, true, false, true, false, '');
        $this->Output('kerusakan.pdf', 'I');
        */
    }
}