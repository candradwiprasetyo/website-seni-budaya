<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Library
{
    public function __construct()
    {
        $this->CI =& get_instance();
        if ($this->development()) {
            $dsn2 = 'mysqli://root:root@localhost/ddtc_engine';
        } else {
            $dsn2 = 'mysqli://ddtc_darussalam:internasional23@localhost/ddtc_engine';
        }
        $this->CI->db2= $this->CI->load->database($dsn2, true);
    }

    function development() {
        return true;
    }

    function get_layout() {
        require_once("Mobile_Detect.php");

        $detect = new Mobile_Detect();
        if ($detect->isTablet()) {
            $layout = 'layouts/';
        } else if ($detect->isMobile()) {
            $layout = 'layouts_mobile/';
        } else {
            $layout = 'layouts/';
        }
        return $layout;
    }

    function highlight($text, $words){
        preg_match_all('~[A-Za-z0-9_äöüÄÖÜ]+~', $words, $m);
        if (!$m)
            return $text;
        $re = '~(' . implode('|', $m[0]) . ')~i';
        return preg_replace($re, '<span style="color:#337ab7"><b>$0</b></span>', $text);
    }

    function format_date($tanggal)
    {
        $tgl=substr($tanggal,8,2);
        $bulan=substr($tanggal,5,2);
        $tahun=substr($tanggal,0,4);

        $waktu=substr($tanggal,10,9);
        if(strlen($waktu)>0){
        $twaktu=explode(":",$waktu);
        $jam=$twaktu[0];
        $menit=$twaktu[1];
        $detik=$twaktu[2];
        if ($jam>24){
            $jam=$twaktu[0]-24;
        }
        //$waktu=$jam.':'.$menit.':'.$detik;
        $waktu=$jam.':'.$menit;
        }


        $hari=date('w',mktime(0,0,0,$bulan,$tgl,$tahun));

        switch ($hari) {
        case 0: $hari="Minggu";
        break;
        case 1: $hari="Senin";
        break;
        case 2: $hari="Selasa";
        break;
        case 3: $hari="Rabu";
        break;
        case 4: $hari="Kamis";
        break;
        case 5: $hari="Jum'at";
        break;
        case 6: $hari="Sabtu";
        break;
        }
        switch ($bulan) {
        case 1: $bulan="Januari";
        break;
        case 2: $bulan="Februari";
        break;
        case 3: $bulan="Maret";
        break;
        case 4: $bulan="April";
        break;
        case 5: $bulan="Mei";
        break;
        case 6: $bulan="Juni";
        break;
        case 7: $bulan="Juli";
        break;
        case 8: $bulan="Agustus";
        break;
        case 9: $bulan="September";
        break;
        case 10: $bulan="Oktober";
        break;
        case 11: $bulan="November";
        break;
        case 12: $bulan="Desember";
        break;
        }

        if ($waktu) {
            $result = "$hari, $tgl $bulan $tahun | $waktu WIB";
        } else {
            $result = "$hari, $tgl $bulan $tahun";
        }
        
        return $result;
    }

    function format_date_engine($tanggal, $no_time=false)
    {
        $tgl=substr($tanggal,8,2);
        $bulan=substr($tanggal,5,2);
        $tahun=substr($tanggal,0,4);

        $waktu=substr($tanggal,10,9);
        if(strlen($waktu)>0){
        $twaktu=explode(":",$waktu);
        $jam=$twaktu[0];
        $menit=$twaktu[1];
        $detik=$twaktu[2];
        if ($jam>24){
            $jam=$twaktu[0]-24;
        }
        //$waktu=$jam.':'.$menit.':'.$detik;
        $waktu=$jam.':'.$menit;
        }


        $hari=date('w',mktime(0,0,0,$bulan,$tgl,$tahun));

        switch ($hari) {
        case 0: $hari="Minggu";
        break;
        case 1: $hari="Senin";
        break;
        case 2: $hari="Selasa";
        break;
        case 3: $hari="Rabu";
        break;
        case 4: $hari="Kamis";
        break;
        case 5: $hari="Jum'at";
        break;
        case 6: $hari="Sabtu";
        break;
        }
        switch ($bulan) {
        case 1: $bulan="Januari";
        break;
        case 2: $bulan="Februari";
        break;
        case 3: $bulan="Maret";
        break;
        case 4: $bulan="April";
        break;
        case 5: $bulan="Mei";
        break;
        case 6: $bulan="Juni";
        break;
        case 7: $bulan="Juli";
        break;
        case 8: $bulan="Agustus";
        break;
        case 9: $bulan="September";
        break;
        case 10: $bulan="Oktober";
        break;
        case 11: $bulan="November";
        break;
        case 12: $bulan="Desember";
        break;
        }

        if (!$no_time) {
            $result = "$tgl $bulan $tahun | $waktu WIB";
        } else {
            $result = "$tgl $bulan $tahun";
        }
        
        return $result;
    }

    

    function get_author($caption)
    {
        $break = explode(',', $caption);
        return $break[0];
    }

    function get_taicing($data)
    {
        return strip_tags($data);
    }

    function get_image($data, $type, $width=300, $height=300)
    {
        if ($type == '1') {
            $path = 'assets/images/thumb/';
        } else if ($type == '2') {
            $path = 'assets/images/view/';
        } else if ($type == '3') {
            $path = 'assets/images/ori/';
        } else if ($type == '4') {
            $path = 'assets/images/medium/';
        }

        $image = $path.$data;
        // $image_compress = $path.'compress_'.$data;
        // $settings = array('w' => $width, 'h' => $height, 'compress' => true);
        // $this->resize($image, $settings);
        // $this->compress_image($image, $image_compress, 50);

        if (file_exists($image)) {
            return base_url().$image;
        } else {
            return base_url().'assets/images/error-404.png';
        }
    }

    function resize($imagePath,$opts=null){
        $imagePath = urldecode($imagePath);
        
        // start configuration........
        $cacheFolder = 'cache/';                            //path to your cache folder, must be writeable by web server
        $remoteFolder = $cacheFolder.'remote/';             //path to the folder you wish to download remote images into
        
        //setting script defaults
        $defaults['crop']               = false;
        $defaults['scale']              = false;
        $defaults['thumbnail']          = false;
        $defaults['maxOnly']            = false;
        $defaults['canvas-color']       = 'transparent';
        $defaults['output-filename']    = false;
        $defaults['cacheFolder']        = $cacheFolder;
        $defaults['remoteFolder']       = $remoteFolder;
        $defaults['quality']            = 80;
        $defaults['cache_http_minutes'] = 1;
        $defaults['compress']           = false;            //will convert to lossy jpeg for conversion...
        $defaults['compression']        = 40;               //[1-99]higher the value, better the compression, more the time, lower the quality (lossy)
        
        $opts = array_merge($defaults, $opts);
        $path_to_convert = 'convert';                       //this could be something like /usr/bin/convert or /opt/local/share/bin/convert
        // configuration ends...
        
        //processing begins
        $cacheFolder = $opts['cacheFolder'];
        $remoteFolder = $opts['remoteFolder'];
        $purl = parse_url($imagePath);
        $finfo = pathinfo($imagePath);
        $ext = $finfo['extension'];
        // check for remote image..
        if(isset($purl['scheme']) && ($purl['scheme'] == 'http' || $purl['scheme'] == 'https')){
        // grab the image, and cache it so we have something to work with..
            list($filename) = explode('?',$finfo['basename']);
            $local_filepath = $remoteFolder.$filename;
            $download_image = true;
            if(file_exists($local_filepath)){
                if(filemtime($local_filepath) < strtotime('+'.$opts['cache_http_minutes'].' minutes')){
                    $download_image = false;
                }
            }
            if($download_image){
                file_put_contents($local_filepath,file_get_contents($imagePath));
            }
            $imagePath = $local_filepath;
        }
        if(!file_exists($imagePath)){
            $imagePath = $_SERVER['DOCUMENT_ROOT'].$imagePath;
            if(!file_exists($imagePath)){
                return 'image not found';
            }
        }
        if(isset($opts['w'])){ $w = $opts['w']; };
        if(isset($opts['h'])){ $h = $opts['h']; };
        $filename = md5_file($imagePath);
        // If the user has requested an explicit output-filename, do not use the cache directory.
        if($opts['output-filename']){
            $newPath = $opts['output-filename'];
        }else{
            if(!empty($w) and !empty($h)){
                $newPath = $cacheFolder.$filename.'_w'.$w.'_h'.$h.($opts['crop'] == true ? "_cp" : "").($opts['scale'] == true ? "_sc" : "");
            }else if(!empty($w)){
                $newPath = $cacheFolder.$filename.'_w'.$w;  
            }else if(!empty($h)){
                $newPath = $cacheFolder.$filename.'_h'.$h;
            }else{
                return false;
            }
            if($opts['compress']){
                if($opts['compression'] == $defaults['compression']){
                    $newPath .= '_comp.'.$ext;
                }else{
                    $newPath .= '_comp_'.$opts['compression'].'.'.$ext;
                }
            }else{
                $newPath .= '.'.$ext;
            }
        }
        $create = true;
        if(file_exists($newPath)){
            $create = false;
            $origFileTime = date("YmdHis",filemtime($imagePath));
            $newFileTime = date("YmdHis",filemtime($newPath));
            if($newFileTime < $origFileTime){                   # Not using $opts['expire-time'] ??
                $create = true;
            }
        }
        if($create){
            if(!empty($w) && !empty($h)){
                list($width,$height) = getimagesize($imagePath);
                $resize = $w;
                if($width > $height){
                    $ww = $w;
                    $hh = round(($height/$width) * $ww);
                    $resize = $w;
                    if($opts['crop']){
                        $resize = "x".$h;               
                    }
                }else{
                    $hh = $h;
                    $ww = round(($width/$height) * $hh);
                    $resize = "x".$h;
                    if($opts['crop']){
                        $resize = $w;
                    }
                }
                if($opts['scale']){
                    $cmd = $path_to_convert." ".escapeshellarg($imagePath)." -resize ".escapeshellarg($resize)." -quality ". escapeshellarg($opts['quality'])." " .escapeshellarg($newPath);
                }else if($opts['canvas-color'] == 'transparent' && !$opts['crop'] && !$opts['scale']){
                    $cmd = $path_to_convert." ".escapeshellarg($imagePath)." -resize ".escapeshellarg($resize)." -size ".escapeshellarg($ww ."x". $hh)." xc:". escapeshellarg($opts['canvas-color'])." +swap -gravity center -composite -quality ".escapeshellarg($opts['quality'])." ".escapeshellarg($newPath);
                }else{
                    $cmd = $path_to_convert." ".escapeshellarg($imagePath)." -resize ".escapeshellarg($resize)." -size ".escapeshellarg($w ."x". $h)." xc:". escapeshellarg($opts['canvas-color'])." +swap -gravity center -composite -quality ".escapeshellarg($opts['quality'])." ".escapeshellarg($newPath);
                }
            }else{
                $cmd = $path_to_convert." " . escapeshellarg($imagePath).
                " -thumbnail ".(!empty($h) ? 'x':'').$w." ".($opts['maxOnly'] == true ? "\>" : "")." -quality ".escapeshellarg($opts['quality'])." ".escapeshellarg($newPath);
            }
            $c = exec($cmd, $output, $return_code);
            if($return_code != 0) {
                error_log("Tried to execute : $cmd, return code: $return_code, output: " . print_r($output, true));
                return false;
            }
            if($opts['compress']){
                $size = getimagesize($newPath);
                $mime = $size['mime'];
                if($mime == 'image/png' || $mime == 3){
                    $picture = imagecreatefrompng($newPath);
                }else if($mime == 'image/jpeg' || $mime == 2){
                    $picture = imagecreatefromjpeg($newPath);
                }else if($mime == 'image/gif' || $mime == 1){
                    $picture = imagecreatefromgif($newPath);
                }else{          
                    error_log("I do not support this format for now. Mime - $mime ", 0);
                }
                if(isset($picture)){
                    $newP_arr = explode(".",$newPath);
                    $newestPath = $newP_arr[0].".jpg";
                    $qc = 100 - $opts['compression'];
                    $status = imagejpeg($picture,"$newestPath",$qc);
                    if($status){
                        unlink($newPath);
                        $newPath = $newestPath;
                    }else{
                        @unlink($newestPath);
                        error_log("I failed to compress the image in jpeg format.", 0);
                    }
                    imagedestroy($picture);
                }else{
                    error_log("Failed To extract picture data", 0);
                }
            }
        }
        // return cache file path
        return str_replace($_SERVER['DOCUMENT_ROOT'],'',$newPath);  
    }

    function check_image($image)
    {
        if (file_exists($image)) {
            return base_url().$image;
        } else {
            return base_url().'assets/images/error-404.png';
        }
    }

    function get_url_news($id, $title) {
        $search = array('\'',"quot",".","(",")","'", "\"","/", ":", ",", "!", ".", "$", "'", "+", "%", "&",'lsquo;',"rsquo;","?","rlm;",";", " ","<i>","</i>");  
        $replace = array('',"","","","","","-","-","","","","","","","","","","","","","","","-","",""); 
                         
        $seo=str_replace("\\","",(str_replace($search, $replace, strtolower($title))));     
        $seo = str_replace(" ", "-", $seo);
        $seo = str_replace("@", "", $seo);
        $seo = $seo."-".$id;
        $seo = preg_replace('/[[:^print:]]/', '', $seo);
        return $seo;
    }

    function get_url_news_mobile($id, $title) {
        $search = array('\'',"quot",".","(",")","'", "\"","/", ":", ",", "!", ".", "$", "'", "+", "%", "&",'lsquo;',"rsquo;","?","rlm;",";", " ","<i>","</i>");  
        $replace = array('',"","","","","","-","-","","","","","","","","","","","","","","","-","",""); 
                         
        $seo=str_replace("\\","",(str_replace($search, $replace, strtolower($title))));     
        $seo = str_replace(" ", "-", $seo);
        $seo = str_replace("@", "", $seo);
        $seo = $seo."-".$id;
        $seo = preg_replace('/[[:^print:]]/', '', $seo);
        // $seo = 'mobile/'.$seo;
        return $seo;
    }

    function get_url_focus($id, $title) {
        $search = array('\'',"quot",".","(",")","'", "\"","/", ":", ",", "!", ".", "$", "'", "+", "%", "&",'lsquo;',"rsquo;","?","rlm;",";", " ","<i>","</i>");  
        $replace = array('',"","","","","","-","-","","","","","","","","","","","","","","","-","",""); 
                         
        $seo=str_replace("\\","",(str_replace($search, $replace, strtolower($title))));     
        $seo = str_replace(" ", "-", $seo);
        $seo = str_replace("@", "", $seo);
        $seo = $seo."-".$id;
        $seo = preg_replace('/[[:^print:]]/', '', $seo);
        return $seo;
    }

    function get_format_meta($title) {
        $search = array('"', "'");  
        $replace = array('', ''); 
                         
        $seo=str_replace("\\","",(str_replace($search, $replace, $title)));
        return $seo;
    }

    function replace_direktur_jenderal_pajak($data) {
        // $data = str_replace("https://engine.ddtc.co.id/peraturan-pajak/read/surat-edaran-direktur-jenderal-pajak-se-15pj2018", "https://engine.ddtc.co.id/peraturan-pajak/read/surat-edaran-dirjen-pajak-se-15pj2018", $data);
        $data = str_replace("dirjen", "direktur-jenderal", $data);

        return $data;
    }

    function add_section_table($data) {
        $data = str_replace("<table", "<section class='table-responsive'><table", $data);
        $data = str_replace("</table>", "</table></section>", $data);
        return $data;
    }

    function get_news_url_replace($data) {

        // replace disclaimer
        $data = str_replace('(<a href="https://news.ddtc.co.id/page/','<a href="https://news.ddtc.co.id/page/', $data);
        $data = str_replace('(<em><a href="https://news.ddtc.co.id/page/','<em><a href="https://news.ddtc.co.id/page/', $data);
        $data = str_replace('Disclaimer</a></em>)','Disclaimer</a></em>', $data);
        $data = str_replace('Disclaimer</em></a>)','Disclaimer</em></a>', $data);
        $data = str_replace('Disclaimer</strong></em></a>)','Disclaimer</strong></em></a>', $data);
        $data = str_replace('>Disclaimer<','><', $data);

        $data = str_replace('<div','<span', $data);
        $data = str_replace('</div>','</span>', $data);
        $data = str_replace('https://ddtc.co.id/academy/','https://academy.ddtc.co.id/', $data);
        // $data = $this->replace_direktur_jenderal_pajak($data);

        $data = str_replace("&nbsp;", " ", $data);

        $data = $this->add_section_table($data);

        
        // $needle = 'news.ddtc.co.id/artikel';
        // if (count(explode($needle, $data)) > 1) {
        //     $o = explode("//", $data);
        //     $o2 = explode("/", $o[1]);

        //     $new_url = 'href="'.base_url().$o2[3].'-'.$o2[2].'">';

        //     return $new_url;

        // } else {
        //     return $data;
        // }
        return $data;
    }

    function get_engine_id($permalink, $type) {

        if ($type=='peraturan-pajak') {
            $sql = "select id as result from regulasi_pajak where permalink = '$permalink'";
        } else if ($type=='putusan-pengadilan-pajak') {
            $sql = "select id as result from putusanpengadilan where permalink = '$permalink'";
        } else if ($type=='p3b') {
            $sql = "select p3b_id as result from p3b where p3b_url = '$permalink'";
        } else if ($type=='putusan-mahkamah-agung') {
            $sql = "select ma_id as result from p3b where ma_url = '$permalink'";
        }

        // return $sql;
        
        $query = $this->CI->db2->query($sql);  
        $result = null;
        foreach ($query->result_array() as $row) $result = ($row);
        return $result['result'];
    }

    function replace_deeplink($data) {
        $post_content = $data;
        preg_match_all("/<a href='(.*?)'/s", $post_content, $matches);
        
        if (count($matches[0]) > 0) {

            for ($i=0; $i<count($matches[0]); $i++) {

                $url = $matches[1][$i];

                
                $news = explode("//", $url);
                if (isset($news[1])) {
                    $news = explode(".", $news[1]);

                    // cek news
                    if (($news[0]=='www' && $news[1]=='news') || $news[0]=='news') {
                        
                        $get_id = explode("-", $url);
                        $get_id = end($get_id);

                        if (is_numeric($get_id)) {
                            $post_content = str_replace($url, 'ddtc://berita/'.$get_id, $post_content);
                        }

                    // cek engine    
                    } else if (($news[0]=='www' && $news[1]=='engine') || $news[0]=='engine') {
                        $engine = explode("//", $url);
                        $engine = explode("/", $engine[1]);

                        if ($engine[1] == 'peraturan-pajak') {
                            $engine_menu = 'peraturan-pajak';
                        } else if ($engine[1] == 'putusan-pengadilan-pajak') {
                            $engine_menu = 'putusan-pengadilan-pajak';
                        } else if ($engine[1] == 'p3b') {
                            $engine_menu = 'p3b';
                        } else if ($engine[1] == 'putusan-mahkamah-agung') {
                            $engine_menu = 'putusan-mahkamah-agung';
                        }

                        $engine_id = $this->get_engine_id($engine[3], $engine_menu);
                        $post_content = str_replace($url, 'ddtc://'.$engine_menu.'/'.$engine_id, $post_content);
                    // cek perpajakan    
                    } else if (($news[0]=='www' && $news[1]=='perpajakan') || $news[0]=='perpajakan') {
                        $engine = explode("//", $url);
                        $engine = explode("/", $engine[1]);

                        $engine_menu = null;
                        if ($engine[1] == 'peraturan-pajak') {
                            $engine_menu = 'peraturan-pajak';
                        } else if ($engine[1] == 'putusan-pengadilan-pajak') {
                            $engine_menu = 'putusan-pengadilan-pajak';
                        } else if ($engine[1] == 'p3b') {
                            $engine_menu = 'p3b';
                        } else if ($engine[1] == 'putusan-mahkamah-agung') {
                            $engine_menu = 'putusan-mahkamah-agung';
                        }

                        if ($engine_menu) {
                            $engine_id = $this->get_engine_id($engine[3], $engine_menu);
                            $post_content = str_replace($url, 'ddtc://'.$engine_menu.'/'.$engine_id, $post_content);
                        }          
                    }

                }
            }
        }

        // $post_content = $post_content.' style="text-decoration: none; color: #337ab7;"';

        return $post_content;
    }

    function add_style_deeplink($data) {
        $result = str_replace('<a href', '<a style="color: #337ab7; text-decoration: none;" href', $data);
        return $result;
    }

    function add_style_table($data) {
        $result = $data;
        $table = explode("<table", $data);
        $style = "<style>
                    .table-bordered {
                        border: 1px solid #ddd;
                    }
                    .table {
                        width: 100%;
                        max-width: 100%;
                        margin-bottom: 20px;
                    }
                    table {
                        background-color: transparent;
                    }
                    table {
                        border-spacing: 0;
                        border-collapse: collapse;
                    }
                    .table-striped>tbody>tr:nth-of-type(odd) {
                        background-color: #f9f9f9;
                    }
                    .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
                        border: 1px solid #ddd;
                    }
                    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                        padding: 8px;
                        line-height: 1.42857143;
                        vertical-align: top;
                        border-top: 1px solid #ddd;
                    }

                </style>";

        if (count($table) > 1) {
            $result = $result.$style;
        }
        return $result;
    }

    function add_style_css($data) {

        $style = "<style>
                    .c-detail-article .c-detail-article__description img{
                        width: 100% !important;
                        height: unset !important;
                    }
                </style>";

        $result = $data.$style;
        
        return $result;
    }


    function insert_read_more($data, $no_id, $keyword) {

        $ci =& get_instance();
        $ci->db->select('ID, TITLE');
        $ci->db->from('tbl_article');
        $ci->db->where('STATUS=1 and PUBLISH_TIMESTAMP <= Now()');
        $ci->db->where("ID<>'".$no_id."'");
        $ci->db->limit(10);

        if ($keyword) {
            $topik = '';
            $key = explode(",", $keyword);
            for( $i=0; $i<=count($key)-1; $i++ ) {
                if ($i==0) {
                    $topik .= " ( KEYWORD like '%".trim($key[$i])."%' ";
                } else {
                    $topik .= " OR KEYWORD like '%".trim($key[$i])."%' ";
                }
                if ($i==count($key)-1) {
                    $topik .= " )"; 
                }

            }
            $ci->db->where($topik);
        }

        $ci->db->order_by(' PUBLISH_TIMESTAMP DESC ');
        $read_too = $ci->db->get()->result();

        $content = explode("</p>", $data);

        $newContent = '';

        if (count($content) > 1) {

            $counter_content = 0;
            $counter_read_too = 3;
            $newContent .= $content[0]."</p>";
            $newContent .= $content[1]."</p>";
            for ($i_content = 2; $i_content < count($content); $i_content++) {
                $newContent .= $content[$i_content]."</p>";
                if ($counter_read_too%3==0) {
                    if (isset($read_too[$counter_content]->TITLE)) {
                        
                        if ($i_content != count($content)-2 && $i_content != count($content)-1 && $i_content != count($content)-3) {
                            
                            $newContent .= '<br><div data-id="'.$i_content.'-'.count($content).'" style="color: #F77B04; text-decoration: none; font-weight: bold;">Baca Juga: <a href="'.'https://news.ddtc.co.id/'.$this->get_url_news($read_too[$counter_content]->ID, $read_too[$counter_content]->TITLE).'" style="color: #337ab7; text-decoration: none;">';
                            $newContent .= $read_too[$counter_content]->TITLE;
                            $newContent .= '</a></div>';
                            
                        }
                    }
                    $counter_content++;
                }
                $counter_read_too++;
            }
        } else {
            $newContent = $data;
        }

        return $newContent;
        
    }

    function get_header_category() {
        $ci =& get_instance();
        $ci->db->select('*');
        $ci->db->from('tbl_category');
        $ci->db->where('STATUS=1');
        $ci->db->order_by(' NO ASC ');
        return $ci->db->get()->result();
    }

    function get_header_subcategory($category_id='') {
        $ci =& get_instance();
        $ci->db->select('a.*, b.CATEGORY_NAME');
        $ci->db->join('tbl_category b', 'b.ID = a.CATEGORY_ID');
        $ci->db->from('tbl_subcategory a');
        $ci->db->where('a.STATUS=1');    
        $ci->db->where("a.SEO<>'advertorial'");    
        if ($category_id) {
            $ci->db->where("a.CATEGORY_ID='".$category_id."'");
        }
        $ci->db->order_by(' a.ID ASC ');
        return $ci->db->get()->result();
    }

    function get_news_header($category_id='', $subcategory_id='') {
        $ci =& get_instance();
        $ci->db->select('*');
        $ci->db->from('tbl_article');
        $ci->db->where('STATUS=1 and PUBLISH_TIMESTAMP <= Now()');
        $ci->db->where("SUBCATEGORY <> 46"); // selain advertorial
        $ci->db->where("PREVIEW IS NULL");
        if ($category_id) {
            $ci->db->where("CATEGORY='".$category_id."'");
        }
        if ($subcategory_id) {
            $ci->db->where("SUBCATEGORY='".$subcategory_id."'");
        }
        //$ci->db->where(" `PUBLISH_TIMESTAMP` < '2017-10-1'");
        $ci->db->order_by(' PUBLISH_TIMESTAMP DESC ');
        $ci->db->limit(4);
      
        return $ci->db->get()->result();
    }

    function get_count_news($start=0, $end='', $type='', $category='', $subcategory='', $id='', $editorpick='', $keyword='', $date='') {
        
        $ci =& get_instance();
        $ci->db->select(' count(1) as TOTAL');
        $ci->db->from('tbl_article');
        $ci->db->where('STATUS=1 and PUBLISH_TIMESTAMP <= Now()');
        $ci->db->where("PREVIEW IS NULL");
        $ci->db->where("SUBCATEGORY <> 46"); // selain advertorial
        if ($category) {
            $ci->db->where("CATEGORY='".$category."'");
        }
        if ($subcategory) {
            $ci->db->where("SUBCATEGORY='".$subcategory."'");
        }
        if ($keyword) {
            $ci->db->where("KEYWORD like '%".$keyword."%'");
        }
        if ($date) {
            $ci->db->where("date(PUBLISH_TIMESTAMP)='".$date."'");
        }
        //$ci->db->where(" `PUBLISH_TIMESTAMP` < '2017-10-1'");
        $ci->db->order_by(' PUBLISH_TIMESTAMP DESC ');
        //$ci->db->limit(12);
        //$ci->output->enable_profiler(TRUE);
        return $ci->db->get()->result();
    }

    function get_count_quiz($start=0, $end='', $date='') {
        
        $ci =& get_instance();
        $ci->db->select(' count(1) as TOTAL');
        $ci->db->from('tbl_quiz');
        $ci->db->where('STATUS=1');
        if ($date) {
            $ci->db->where("start_date <= '".$date."' and end_date >= '".$date."'");
        }
        $ci->db->order_by(' ID DESC ');
        //$ci->output->enable_profiler(TRUE);
        return $ci->db->get()->result();
    }

    function get_meta($data, $type) {
        switch ($type) {
            case 1:
                if ($data) {
                    return $this->get_format_meta($data);
                } else {
                    return 'DDTCNews - Berita Pajak Terbaru, Peraturan dan Analisis Pajak';
                }
            break;

            case 2:
                // meta image
                if ($data) {
                    return $data;
                } else {
                    return base_url().'assets/images/meta_images.jpg?v=2';
                }
            break;

            case 3:
                // meta keyword
                if ($data) {
                    return $this->get_format_meta($data);
                } else {
                    return "Berita pajak, analisis & peraturan pajak terbaru, berisi pajak daerah, pajak internasional, konsultasi, agenda & informasi kegiatan komunitas pajak.";
                }
            break;

            case 4:
                // meta description
                if ($data) {
                    return $this->get_format_meta($data);
                } else {
                    return "berita pajak, berita pajak hari ini, berita pajak terbaru, analisis pajak, konsultan pajak, konsultasi pajak, pajak internasional, tax amnesty, pengampunan pajak, beps, pemeriksaan pajak, transfer pricing, pertukaran informasi pajak, humor pajak, anekdot pajak, pajak daerah, pajak kendaraan, pajak mobil, pajak online, pajak restoran, pbb, pajak properti, dirjen pajak, kasus pajak, perhitungan pajak, peraturan pajak, pajak tanah, pajak digital";
                }
            break;
        }
    }

    function get_doc_url($type, $seo) {
        $url = $result="https://perpajakan.ddtc.co.id/".$type.'/read/'.$seo;
        return $url;
    }

    function filter_only($text){
        $string=null;
        $string = preg_replace('/[^a-zA-Z0-9 -@,_.:{}!]+/', '', $text);

        return $string;
    }

    function get_reporter($id) {
        $ci =& get_instance();
        $sql = "select REPORTER as result from tbl_article where ID = '$id'";    
        $query = $ci->db->query($sql);       
        $result = null;
        foreach ($query->result_array() as $row) $result = ($row);
        $reporter = $result['result'];

        $reporter_name = '';
        if ($reporter) {
            $sql = "select FULLNAME as result from tbl_writer where EMAIL = '$reporter'";    
            $query = $ci->db->query($sql);       
            $result = null;
            foreach ($query->result_array() as $row) $result = ($row);
            $reporter_name = $result['result'];
        }
        return $reporter_name;
    }

    function get_reporter_from_name($name) {
        $ci =& get_instance();
        $sql = "select EMAIL as result from tbl_writer where FULLNAME = '$name'";    
        $query = $ci->db->query($sql);       
        $result = null;
        foreach ($query->result_array() as $row) $result = ($row);
        $reporter = $result['result'];

        return $reporter;
    }

    function get_reporter_url($email) {
        $ci =& get_instance();
        $sql = "select FULLNAME as result from tbl_writer where EMAIL = '$email'";    
        $query = $ci->db->query($sql);
        $result = null;
        foreach ($query->result_array() as $row) $result = ($row);
        $reporter = $result['result'];

        $reporter = strtolower(str_replace(" ", "-", $reporter));
        $reporter = strtolower(str_replace(",", "_", $reporter));

        return $reporter;
    }

    function create_thumbnail_preserve_ratio($source, $destination, $thumbWidth)
    {
        //$extension = get_image_extension($source);
        $extension = pathinfo($source, PATHINFO_EXTENSION);
        $size = getimagesize($source);
        $imageWidth  = $size[0];
        $imageHeight = $size[1];
        $newWidth  = 250;
        $newheight = 170;
        
        
        
        if ($imageWidth > $thumbWidth || $imageHeight > $thumbWidth)
        {
            // Calculate the ratio
            $xscale = ($imageWidth/$thumbWidth);
            $yscale = ($imageHeight/$thumbWidth);
            $newWidth  = ($yscale > $xscale) ? round($imageWidth * (1/$yscale)) : round($imageWidth * (1/$xscale));
            $newHeight = ($yscale > $xscale) ? round($imageHeight * (1/$yscale)) : round($imageHeight * (1/$xscale));
            
            
            $newImage = imagecreatetruecolor($newWidth, $newHeight);

        switch ($extension)
        {
            case 'jpeg':
            case 'jpg':
                $imageCreateFrom = 'imagecreatefromjpeg';
                $store = 'imagejpeg';
                break;

            case 'png':
                $imageCreateFrom = 'imagecreatefrompng';
                $store = 'imagepng';
                break;

            case 'gif':
                $imageCreateFrom = 'imagecreatefromgif';
                $store = 'imagegif';
                break;

            default:
                return false;
        }

        $container = $imageCreateFrom($source);
        imagecopyresampled($newImage, $container, 0, 0, 0, 0, $newWidth, $newHeight, $imageWidth, $imageHeight);
        return $store($newImage, $destination);
        }else{
            //error_log("ukuran gambar kekecilan", 3, "/var/tmp/jurnas-debug.log");
        }

        
    }

    function check_status_publish($id) {
        $ci =& get_instance();
        $sql = "select STATUS_PUBLISH as result from tbl_article where ID = '$id'";    
        $query = $ci->db->query($sql);       
        $result = null;
        foreach ($query->result_array() as $row) $result = ($row);
        $result = $result['result'];
        //$ci->output->enable_profiler(TRUE);
        return $result;
    }

    function edit_status_publish($id)
    {
        $ci =& get_instance();
        $data = array(
            "STATUS_PUBLISH" => '1',
        );
        $ci->db->where('ID', $id);
        $ci->db->update('tbl_article', $data);
    }

    function get_menu_icon($icon, $color='grey')
    {
        if ($color == 'grey' ) {
            $image = $icon.'.png';
        } else if ($color == 'black') {
            $image = $icon.'_black.png';
        } else if ($color == 'blue') {
            $image = $icon.'_blue.png';
        } else if ($color == 'white') {
            $image = $icon.'_white.png';
        }

        $url = base_url().'assets/images/icons/'.$image;

        if (file_exists('assets/images/icons/'.$image)) {
            return $url;
        } else {
            return base_url().'assets/images/focus-icon.png';
        }   
    }

    function get_all_new_comments() {
        $ci =& get_instance();
        $sql = "SELECT `tbl_article`.`ID`,`tbl_article`.`TITLE`,`tbl_category`.`CATEGORY_NAME`,`tbl_subcategory`.`SUBCATEGORY_NAME`,count(tbl_comments.ID) as TOTAL_KOMENTAR FROM `tbl_article` JOIN `tbl_category` ON `tbl_category`.`ID`=`tbl_article`.`CATEGORY` JOIN `tbl_subcategory` ON `tbl_subcategory`.`ID`=`tbl_article`.`SUBCATEGORY` JOIN `tbl_comments` ON `tbl_comments`.`ARTICLE_ID`=`tbl_article`.`ID` WHERE `tbl_comments`.`ANSWERED`='0' and COMMENT_TYPE='1' GROUP BY `tbl_comments`.`ARTICLE_ID` ORDER BY `tbl_article`.`ID` DESC";    
        $query = $ci->db->query($sql);       
        $result = null;
        foreach ($query->result_array() as $row) $result = ($row);
        $result = $result['result'];
        //$ci->output->enable_profiler(TRUE);
        return $result;
    }

    function get_comment_article() {
        $ci =& get_instance();
        $sql = "select ID, TITLE from tbl_article where QUIZ_COMMENT = '1'";    
        $query = $ci->db->query($sql);       
        $result = null;
        foreach ($query->result_array() as $row) $result = ($row);
        //$ci->output->enable_profiler(TRUE);
        return $result;
    }

    function replace_deeplink_engine($url, $content, $type) {

        $post_content = $content;

        for ($i=0; $i<count($url); $i++) {
            $post_content = str_ireplace($url[$i]['number'], "<a href='ddtc://".$type."/".$url[$i]['id']."'>".$url[$i]['number']."</a>", $post_content);
        }

        return $post_content;
    }

    function compress_image($source_url, $destination_url, $quality=50) {

        $info = getimagesize($source_url);

        if ($info['mime'] == 'image/jpeg')
              $image = imagecreatefromjpeg($source_url);

        elseif ($info['mime'] == 'image/gif')
              $image = imagecreatefromgif($source_url);

        elseif ($info['mime'] == 'image/png')
              $image = imagecreatefrompng($source_url);

        imagejpeg($image, $destination_url, $quality);
        return $destination_url;
    }

    function add_width_img($data) {
        $data = str_replace("<img", "<img style='width: 100%; height: unset;'", $data);
        return $data;
    }

    function change_root_img($data) {
        $data = str_replace("../../../", "https://news.ddtc.co.id/", $data);
        return $data;
    }

    function get_full_url() {
        $base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
        $url = $base_url . $_SERVER["REQUEST_URI"];
        return $url;
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'tahun',
            'm' => 'bulan',
            'w' => 'minggu',
            'd' => 'hari',
            'h' => 'jam',
            'i' => 'menit',
            's' => 'detik',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
    }

}
