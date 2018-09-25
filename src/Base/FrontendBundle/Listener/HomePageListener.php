<?php

namespace Base\FrontendBundle\Listener;

use Base\AdminBundle\Manager\BannerManager;
use Base\AdminBundle\Manager\ProductManager;
use Base\FrontendBundle\BaseFrontendBundleEvents;
use Base\FrontendBundle\Event\ControllerPreRenderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class HomePageListener
 * @package Base\FrontendBundle\Listener
 */
class HomePageListener implements EventSubscriberInterface
{
    /**
     * @var BannerManager
     */
    private $bannerManager;

    /**
     * @var ProductManager
     */
    private $productManager;

    /**
     * HomePageListener constructor.
     * @param BannerManager $bannerManager
     * @param ProductManager $productManager
     */
    public function __construct(
        BannerManager $bannerManager,
        ProductManager $productManager
    ) {
        $this->bannerManager = $bannerManager;
        $this->productManager = $productManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BaseFrontendBundleEvents::CONTROLLER_RENDER_PRE_HOMEPAGE => 'onGetDataHomePage'
        ];
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    public function onGetDataHomePage(ControllerPreRenderEvent $event)
    {
        $criteria = [
            'removedRecord' => false,
            'active' => true,
        ];
        $banners = $this->bannerManager->findBy($criteria, 1, 5,'');

        $criteria = [
            'removedRecord' => false,
            'active' => true,
        ];
        $products = $this->productManager->findBy($criteria, 1, 20,'');

        $event->setParameter('banners', $banners);
        $event->setParameter('products', $products);
    }
}