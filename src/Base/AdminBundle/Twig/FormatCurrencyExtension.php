<?php

namespace Base\AdminBundle\Twig;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Intl\NumberFormatter\NumberFormatter;

/**
 * Class FormatCurrencyExtension
 * @package Base\AdminBundle\Twig
 */

class FormatCurrencyExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('formatCurrency', [$this, 'formatCurrency']),
        ];
    }

    public function formatCurrency($price)
    {
        if (is_numeric($price)) {
            return sprintf('%s VND', number_format($price, 0, '', '.'));
        } else {
            return "Wrong price!";
        }
    }
}