<?php

namespace Base\AdminBundle\Listener\Dashboard;

use Base\AdminBundle\Entity\Account;
use Base\AdminBundle\Session\ShoppingSession;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Base\AdminBundle\BaseAdminBundleEvents;
use Base\AdminBundle\Event\ControllerPreRenderEvent;

/**
 * Class UpdateProfileListener
 * @package Base\AdminBundle\Listener\Dashboard
 */
class UpdateProfileListener implements EventSubscriberInterface
{
    /**
     * @var ShoppingSession
     */
    private $shoppingSession;

    /**
     * UpdateProfileListener constructor.
     * @param ShoppingSession $shoppingSession
     */
    public function __construct(ShoppingSession $shoppingSession)
    {
        $this->shoppingSession = $shoppingSession;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_PROFILE => 'onUpdateProfile',
        ];
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    public function onUpdateProfile(ControllerPreRenderEvent $event)
    {
        $account = $this->shoppingSession->getAccountLogin();
        if ($account instanceof Account) {
            $event->setParameter('account', $account);
        }
    }
}