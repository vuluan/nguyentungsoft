<?php

namespace Base\AdminBundle\Session;

use Base\AdminBundle\BaseAdminBundleConst;
use Base\AdminBundle\Entity\Account;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class ShoppingSession
 * @package Base\AdminBundle\Session
 */
class ShoppingSession
{
    /**
     * @var SessionInterface
     */
    private $storage;

    /**
     * ShoppingSession constructor.
     *
     * @param SessionInterface $storage
     */
    public function __construct(SessionInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param Account $account
     */
    public function setAccountLogin(Account $account)
    {
        $this->storage->set(BaseAdminBundleConst::SHOPPING_SESSION_ACCOUNT, $account);
    }

    /**
     * @return Account $account
     */
    public function getAccountLogin()
    {
        return $this->storage->get(BaseAdminBundleConst::SHOPPING_SESSION_ACCOUNT);
    }

    /**
     * @return Account $account
     */
    public function removeAccountLogin()
    {
        return $this->storage->remove(BaseAdminBundleConst::SHOPPING_SESSION_ACCOUNT);
    }
}
