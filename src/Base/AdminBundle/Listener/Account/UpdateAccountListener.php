<?php

namespace Base\AdminBundle\Listener\Account;

use Base\AdminBundle\Entity\Account;
use Base\AdminBundle\Manager\AccountManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Base\AdminBundle\BaseAdminBundleEvents;
use Base\AdminBundle\Event\ControllerPreRenderEvent;

/**
 * Class UpdateAccountListener
 * @package Base\AdminBundle\Listener\Account
 */
class UpdateAccountListener implements EventSubscriberInterface
{
    /**
     * @var AccountManager
     */
    private $accountManager;

    /**
     * UpdateAccountListener constructor.
     * @param AccountManager $accountManager
     */
    public function __construct(AccountManager $accountManager)
    {
        $this->accountManager = $accountManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_ACCOUNT_UPDATE => 'onUpdateAccount',
        ];
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    public function onUpdateAccount(ControllerPreRenderEvent $event)
    {
        /** @var Account $account */
        $accountId = $event->getRequest()->attributes->get('id');
        if ($accountId === null) {
            return;
        }

        $account = $this->accountManager->findOneById($accountId);
        if ($account instanceof Account) {
            $event->setParameter('account', $account);
        }
    }
}