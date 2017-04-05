<?php

namespace DevUtil;

class ImgUtil{

    public static function imgDownload($path,$url)
    {
        if(trim($path) == "" || trim($url) == "")
        {
            return "";
        }
        ob_start();
        readfile($url);
        $img = ob_get_contents();
        ob_end_clean();
        if(self::makePath($path))
        {
            $arrSuffix = explode(".",$url);
            $suffix = end($arrSuffix);
            $suffix = strlen($suffix) <= 4 ? $suffix : "jpg";
            $file =  time() . substr(uniqid(),7,5) . "." . $suffix;
            $path_to_file = $path . "/" . $file;
            $fd = fopen($path_to_file,"a");
            fwrite($fd,$img);
            fclose($fd);
            return array(
                "name"  =>  $file,
                "path"  =>  $path_to_file
            );
        }else{
            return false;
        }

    }

    public static function makePath($path)
    {
        if(is_dir($path))
        {
            return true;
        }else {
            @mkdir($path);
            return true;
        }
        return false;
    }



}




?>