<?php

namespace Base\AdminBundle\Twig;
use Base\AdminBundle\Entity\Account;
use Base\AdminBundle\Session\ShoppingSession;

/**
 * Class GetAccountLoginExtension
 * @package Base\AdminBundle\Twig
 */

class GetAccountLoginExtension extends \Twig_Extension
{
    /**
     * @var ShoppingSession
     */
    private $shoppingSession;

    /**
     * GetLoginAccountExtension constructor.
     * @param ShoppingSession $shoppingSession
     */
    public function __construct(ShoppingSession $shoppingSession)
    {
        $this->shoppingSession = $shoppingSession;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('getAccountLogin', [$this, 'getAccountLogin']),
        ];
    }

    public function getAccountLogin()
    {
        /** @var Account $account */
        $account = $this->shoppingSession->getAccountLogin();
        if ($account instanceof Account) {
            return $account;
        }
        return null;
    }
}