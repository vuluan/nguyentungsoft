<?php

namespace Base\AdminBundle\Listener\Login;

use Base\AdminBundle\Entity\Account;
use Base\AdminBundle\Session\ShoppingSession;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Base\AdminBundle\BaseAdminBundleEvents;
use Base\AdminBundle\Event\ControllerPreRenderEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class LogoutListener
 * @package Base\AdminBundle\Listener\Login
 */
class LogoutListener implements EventSubscriberInterface
{
    /**
     * @var ShoppingSession
     */
    private $shoppingSession;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * CheckLoginListener constructor.
     * @param ShoppingSession $shoppingSession
     */
    public function __construct(
        ShoppingSession $shoppingSession,
        RouterInterface $router
    )
    {
        $this->shoppingSession = $shoppingSession;
        $this->router = $router;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_LOGOUT => 'onLogout',
        ];
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    public function onLogout(ControllerPreRenderEvent $event)
    {
        $account = $this->shoppingSession->getAccountLogin();
        if ($account instanceof Account) {
            $this->shoppingSession->removeAccountLogin();
            $this->redirectToLoginPage($event);
            $event->stopPropagation();
        }
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    private function redirectToLoginPage(ControllerPreRenderEvent $event)
    {
        $url = $this->router->generate('base_admin_login');
        $response = new RedirectResponse($url);
        $event->setResponse($response);
    }
}