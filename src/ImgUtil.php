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
        $img = ob_get_contents();
        ob_end_clean();
        if(self::makePath($path))
        {
            $suffix = explode(".",$url)[1] ? explode(".",$url)[1] : "jpg";
            $file = $path . "/" . time() . substr(uniqid(),7,5) . "." . $suffix;
            $fd = fopen($file,"b");
            fwrite($fd,$img);
            fclose($fd);
            return $file;
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