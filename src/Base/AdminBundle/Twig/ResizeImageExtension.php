<?php

namespace Base\AdminBundle\Twig;

/**
 * Class ResizeImageExtension
 * @package Base\AdminBundle\Twig
 */

class ResizeImageExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('resizeImage', [$this, 'resizeImage']),
        ];
    }

    public function resizeImage($src, $w=0, $h=0, $zc=1)
    {
        if($w!=0 && $h!=0){
            return '/imgresize.php?w='.$w.'&h='.$h.'&src='.$src.'&zc='.$zc;
        }elseif($w!=0){
            return '/imgresize.php?w='.$w.'&src='.$src.'&zc='.$zc;
        }elseif($h!=0){
            return '/imgresize.php?h='.$h.'&src='.$src.'&zc='.$zc;
        }
    }
}