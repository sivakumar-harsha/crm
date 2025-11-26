<?php
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {

    public $dompdf;

    public function __construct()
    {
        // Load Composer autoload
        require_once APPPATH . '../vendor/autoload.php';

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Courier');

        $this->dompdf = new Dompdf($options);
    }

    public function loadHtml($html)
    {
        return $this->dompdf->loadHtml($html);
    }

    public function render()
    {
        return $this->dompdf->render();
    }

    public function output()
    {
        return $this->dompdf->output();
    }

    public function stream($filename, $options = [])
    {
        return $this->dompdf->stream($filename, $options);
    }
}
