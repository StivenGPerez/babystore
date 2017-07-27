<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('utf8_fopen_read')){
    //metodo para cargar archivos en formato utf-8
    function utf8_fopen_read($fileName) { 
        $fc = iconv('windows-1250', 'utf-8', file_get_contents($fileName)); 
        $handle=fopen("php://memory", "rw"); 
        fwrite($handle, $fc); 
        fseek($handle, 0); 
        return $handle; 
    } 
}
