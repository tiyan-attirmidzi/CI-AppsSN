<?php
/**
 * By Shaharia Azam
 * shaharia.azam@gmail.com
 * http://www.shahariaazam.com
 */
class Reb{
 
    /**
     * set the header configuration
     * @param $filename the xls file name
     */
   
    function setHeader($filename){
        
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
    }
    /**
     * write the xls begin of file
     */
    function BOF() {
        echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
        return;
    }
 
    /**
     * write the xls end of file
     */
    function EOF() {
        echo pack("ss", 0x0A, 0x00);
        return;
    }

    
}

?>
