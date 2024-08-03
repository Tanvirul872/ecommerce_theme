<?php


namespace BinaryIT\Invoice;

use TCPDF_FONTS;

require_once(dirname(__FILE__) . '/vendor/autoload.php');


class PDF extends \TCPDF
{

    protected $last_page_flag = false;

    public function Close()
    {
        $this->last_page_flag = true;
        parent::Close();
    }



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
        
        $last_description_title_it = get_post_meta($product_id, 'last_description_title_it', true);
        
        
       
            

        $is_en_available     = $_POST['is_en_available'] ?? '';
        $product_id         = $_POST['product_id'] ?? '';
        if ($is_en_available == 'en') {


            $last_description_title_en = get_post_meta($product_id, 'last_description_title_en', true);
            $total_br_en = '';

            for ($i = 0; $i < $last_description_title_en; $i++) {
                $total_br_en .= '<br>';
            }
            
            
            
            $sro_last_description_en = get_post_meta($product_id, 'sro_last_description_en', true);
            
           

            $last_footer = '<table>
            <tr>
            <td style="width: 5%"></td>
            <td style="width: 90%">
                <span style="font-family: poppins; font-size: 9px; color: #323232; "><br/><strong>' . $total_br_en . '</strong></span><br/><span style="line-height: 20px; "></span><span style="font-family: poppins; font-size: 8px; color: #323232; text-align: justify; ">' . $sro_last_description_en . '<br/></span>
            </td>
            <td style="width: 5%"></td>
        </tr>


        <tr>
            <td style="width:5%;"></td>
            <td style="width: 25%; "><span style="color:#CD151D; font-size:10px; font-family: poppinssemib; ">SARO SRL EN<br></span> 
                <span style="color:#5a5a5a; font-size:10px; font-family: poppinssemib;">Sede legale <br></span>  
                <span style="color:#5a5a5a; font-size:9px; font-family: poppinslight;">Viale San Gimignano, 35 <br></span>
                <span style="color:#5a5a5a; font-size:9px; font-family: poppinslight;">20146 Milano (MI)</span>
            </td>
            <td style="width: 25%; ">
                <span style="color:#5a5a5a; font-size:10px; font-family: poppinssemib;"><br>Sede operativa<br></span> 
                <span style="color:#5a5a5a;font-size:10px; font-size:9px; font-family: poppinslight;">Via G. Di Vittorio, 5<br></span> 
                <span style="color:#5a5a5a;font-size:10px; font-size:9px; font-family: poppinslight;">20020 Arconate (MI)</span>   
            </td>
            <td style="width: 40%; ">
                <span style="color:#5a5a5a;font-size:9px; font-family: poppinslight;"><br><br>T.0331 453794 - F.0331 574495</span><br><span style="color:#5a5a5a;font-size:9px; font-family: poppinslight;">info@sa.ro.it - <b><span style="font-family: poppinsb;">www.sa.ro.it</span></b> </span> 
                <br>
            </td>
            <td style="width:5%;"></td>
        </tr>
        <tr>
            <td style="width:5%;"></td> 
            <td style="width:90%;">
                <div style="width:100%;background-color:#CD151D;line-height:3px;"></div>
            </td>
            <td style="width:5%;"></td>
        </tr>
    </table>';
        } else {

            $sro_last_description_it = get_post_meta($product_id, 'sro_last_description_it', true);
            $last_description_title_it = get_post_meta($product_id, 'last_description_title_it', true);
            $total_br_it = '';

            for ($i = 0; $i < $last_description_title_it; $i++) {
                $total_br_it .= '<br>';
            }
            
            
            $last_footer = '<table >

        <tr>
            <td style="width: 5%"></td>
            <td style="width: 90%">
                <span style="font-family: poppins; font-size: 9px; color: #323232; "><br/><strong>' . $total_br_it . '</strong></span><br/><span style="line-height: 20px; "></span><span style="font-family: poppins; font-size: 8px; color: #323232; text-align: justify; ">' . $sro_last_description_it . '<br/></span>
            </td>
            <td style="width: 5%"></td>
        </tr>

        <tr>
            <td style="width:5%;"></td>
            <td style="width: 25%; "><span style="color:#CD151D; font-size:10px; font-family: poppinssemib; ">SARO SRL <br></span> 
                <span style="color:#5a5a5a; font-size:10px; font-family: poppinssemib;">Sede legale <br></span>  
                <span style="color:#5a5a5a; font-size:9px; font-family: poppinslight;">Viale San Gimignano, 35 <br></span>
                <span style="color:#5a5a5a; font-size:9px; font-family: poppinslight;">20146 Milano (MI)</span>
            </td>
            <td style="width: 25%; ">
                <span style="color:#5a5a5a; font-size:10px; font-family: poppinssemib;"><br>Sede operativa<br></span> 
                <span style="color:#5a5a5a;font-size:10px; font-size:9px; font-family: poppinslight;">Via G. Di Vittorio, 5<br></span> 
                <span style="color:#5a5a5a;font-size:10px; font-size:9px; font-family: poppinslight;">20020 Arconate (MI)</span>   
            </td>
            <td style="width: 40%; ">
                <span style="color:#5a5a5a;font-size:9px; font-family: poppinslight;"><br><br>T.0331 453794 - F.0331 574495</span><br><span style="color:#5a5a5a;font-size:9px; font-family: poppinslight;">info@sa.ro.it - <b><span style="font-family: poppinsb;">www.sa.ro.it</span></b> </span> 
                <br>
            </td>
            <td style="width:5%;"></td>
        </tr>
        <tr>
            <td style="width:5%;"></td> 
            <td style="width:90%;">
                <div style="width:100%;background-color:#CD151D;line-height:3px;"></div>
            </td>
            <td style="width:5%;"></td>
        </tr>
    </table>';
        }



        if ($this->last_page_flag) {
            $this->writeHTML($last_footer);
        } else {
            if (!isset($this->footerHTML)) {
                return parent::Footer();
            }
            $this->writeHTML($this->footerHTML);
        }
    }



    // public function Footer()
    // {
    //     if (!isset($this->footerHTML)) {
    //         return parent::Footer();
    //     }
    //     $this->writeHTML($this->footerHTML);
    // }

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
