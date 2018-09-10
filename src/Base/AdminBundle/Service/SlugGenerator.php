<?php

namespace Base\AdminBundle\Service;

use Cocur\Slugify\Slugify;

/**
 * Class SlugGenerator
 * @package Base\AdminBundle\Service
 */
class SlugGenerator
{
    /**
     * @param string $text
     * @return string
     */
    public function generate(string $text)
    {
        $slug = new Slugify();
        return $slug->slugify($text);
    }
}