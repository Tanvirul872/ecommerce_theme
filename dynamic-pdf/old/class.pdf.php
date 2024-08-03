<?php

namespace BinaryIT\Invoice;

use TCPDF_FONTS;

require_once(dirname(__FILE__) . '/vendor/autoload.php');


class PDF extends \TCPDF
{
    private $headerHTML = null;
    private $footerHTML = null;

    function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor(PDF_AUTHOR);
        $this->SetTitle('Product details');
        $this->SetSubject('Billing Invoice');
        $this->SetKeywords('PDF, Billing, Company');
        // set default header data
        $this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $this->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $this->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.


        // $this->SetFont('poppinslight', '', 11, '', true);
        $this->SetFont('candara', '', 11, '', true);
        $this->SetFont('montserratb', '', 11, '', true);
        $this->SetFont('poppinsb', '', '11', '', false);
        $this->SetFont('poppins', '', '11', '', false);
        $this->SetFont('poppinssemib', '', '11', '', false);
        $this->SetFont('poppinslight', '', '11', '', false);

       

        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {

            require_once(dirname(__FILE__) . '/lang/eng.php');

            $this->setLanguageArray($l);
        }
    }


    public function Header()
    {
        if (!isset($this->headerHTML)) {
            return parent::Header();
        }
        $this->writeHTML($this->headerHTML);
    }

    public function Footer()
    {
        if (!isset($this->footerHTML)) {
            return parent::Footer();
        }
        $this->writeHTML($this->footerHTML);
    }

    public function headerHTML($html = null, $print = true)
    {
        $this->headerHTML = $html;
        $this->setPrintHeader($print);
    }

    public function footerHTML($html = null, $print = true)
    {
        $this->footerHTML = $html;
        $this->setPrintFooter($print);
    }

    public function covertFont($font_path)
    {


        return TCPDF_FONTS::addTTFfont($font_path);
    }
}
