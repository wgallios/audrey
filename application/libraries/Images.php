<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images
{
    // constructor
    public function Images()
    {

    }

    public function block($img, $size = 50, $path = null)
    {
        $ci =& get_instance();

        // loads functions library just in case
        $ci->load->library('functions');

        if (empty($path)) $path = $_SERVER["DOCUMENT_ROOT"] . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;

        // first checks if image exists
        $exists = file_exists($path . $img);

        if ($exists === false) throw new Exception("{$path}{$img} does not exist!");

        $is = getimagesize($path . $img);

        if ($is === false) throw new exception("Unable to get image size for ({$path}{$img})!");

        $ext = $ci->functions->getFileExt($img);

        list ($width, $height, $type, $attr) = $is;

            if ($width == $height)
            {
                $nw = $nh = $size;
            }
            elseif ($width > $height)
            {
                $scale = $size / $height;
                $nw = $width * $scale;
                $nh = $size;
                $leftBuffer = (($nw - $size) / 2);
            }
            else
            {
                $nw = $size;
                $scale = $size / $width;
                $nh = $height * $scale;
                $topBuffer = (($nh - $size) / 2);
            }

        $leftBuffer = $leftBuffer * -1;
        $topBuffer = $topBuffer * -1;

        if ($ext == "jpg") $srcImg = imagecreatefromjpeg($path . $img);
        if ($ext == "gif") $srcImg = imagecreatefromgif($path  . $img);
        if ($ext == "png") $srcImg = imagecreatefrompng($path  . $img);

        $destImg = imagecreatetruecolor($size, $size); // new image

        imagecopyresized($destImg, $srcImg, $leftBuffer, $topBuffer, 0, 0, $nw, $nh, $width, $height);


        #echo "NW: {$nw} | NH: {$nh} | Scale: {$scale} | ";
        #echo "topBuffer: {$topBuffer}";
        #echo "leftBuffer: {$leftBuffer}";
        header('Content-Type: image/jpg');
        imagejpeg($destImg);

        imagedestroy($destImg);
        imagedestroy($srcImg);
    }

}
