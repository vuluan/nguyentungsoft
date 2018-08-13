<?php

namespace Base\AdminBundle\Listener\Banner;

use Base\AdminBundle\Entity\Banner;
use Base\AdminBundle\Entity\Product;
use Base\AdminBundle\Manager\BannerManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Base\AdminBundle\BaseAdminBundleEvents;
use Base\AdminBundle\Event\ControllerPreRenderEvent;

/**
 * Class UpdateBannerListener
 * @package Base\AdminBundle\Listener\Banner
 */
class UpdateBannerListener implements EventSubscriberInterface
{
    /**
     * @var BannerManager
     */
    private $bannerManager;

    /**
     * UpdateBannerListener constructor.
     * @param BannerManager $bannerManager
     */
    public function __construct(
        BannerManager $bannerManager
    ){
        $this->bannerManager = $bannerManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_BANNER_UPDATE => 'onUpdateBanner',
        ];
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    public function onUpdateBanner(ControllerPreRenderEvent $event)
    {
        /** @var Product $category */
        $bannerId = $event->getRequest()->attributes->get('id');

        if ($bannerId === null) {
            return;
        }

        $banner = $this->bannerManager->findOneById($bannerId);
        if ($banner instanceof Banner) {
            $event->setParameter('banner', $banner);
        }
    }
}