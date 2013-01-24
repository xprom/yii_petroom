<?php
class Link
{
    protected static $_content;

    protected static function _getContent($url)
    {
        return file_get_contents($url);
    }

    protected static function _parseImg($content,$url)
    {
        $url = trim($url,'/');
        if(strpos($url,'http://')===false)
            $url = 'http://'.$url;

        $result = array();
        $image_match = array();
        preg_match_all('/src="(.*)"/Usi',$content,$image_match);

        foreach($image_match[1] as $key => &$value)
        {
            if(strpos($value,'http://')===false)
            {
                $value = $url.'/'.$value;
            }

            try
            {
                list($width, $height, $type, $attr) = @getimagesize($value);
                if($width<64 || $height<64)
                    continue;
            }
            catch(Exception $e)
            {
                continue;
            }

            if(strpos(strtolower($value),'.gif')!==false)
                $result[] = $value;
            if(strpos(strtolower($value),'.jpeg')!==false)
                $result[] = $value;
            if(strpos(strtolower($value),'.jpg')!==false)
                $result[] = $value;
            if(strpos(strtolower($value),'.tif')!==false)
                $result[] = $value;
            if(strpos(strtolower($value),'.png')!==false)
                $result[] = $value;
            if(strpos(strtolower($value),'.bmp')!==false)
                $result[] = $value;

            if(count($result)==7)
                break;
        }


        /**
         * парсим элемент типа
         * <link rel="image_src" href="http://habrahabr.ru/i/habralogo.jpg" />
         */
        $image_match = array();
        preg_match_all('/<link(.*)rel="image_src"(.*)>/Usi',$content,$image_match);

        if(!empty($image_match[0][0]))
        {
            preg_match_all('/href="(.*)"/Usi',$image_match[0][0],$image_match);
        }

        if(!empty($image_match[1][0]))
        {
            if(strpos($image_match[1][0],'http://')===false)
            {
                $image_match[1][0] = trim($url,'/').trim($image_match[1][0],'/');
            }

            $result[] = $image_match[1][0];
        }

        return array_reverse($result);
    }

    protected static function _convertCharset($text,$sourceCharset)
    {
        if($sourceCharset=='UTF-8')
        {
            return $text;
        }
        else
        {
            return iconv($sourceCharset,'UTF-8',$text);
        }
    }

    public static function getLinkContent($url)
    {
        if(strpos($url,'://')===false)
            $url = 'http://'.$url;

        self::$_content = self::_getContent($url);

        /**
         * detect charset
         */
        preg_match('~charset=([-a-z0-9_]+)~i',self::$_content,$charset);

        $title_match = array();
        preg_match('/<title>(.*)<\/title>/',self::$_content,$title_match);
        $title = $title_match[1];

        $tags = get_meta_tags($url);


        return array(
            'title'=> self::_convertCharset($title,$charset[1]),
            'description'=> self::_convertCharset($tags['description'],$charset[1]),
            'image_arr'=>self::_parseImg(self::$_content,$url),
            'url'=>$url
        );
    }


}