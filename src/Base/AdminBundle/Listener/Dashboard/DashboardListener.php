<?php

namespace Base\AdminBundle\Listener\Dashboard;

use Base\AdminBundle\Manager\AccountManager;
use Base\AdminBundle\Manager\BannerManager;
use Base\AdminBundle\Manager\CategoryManager;
use Base\AdminBundle\Manager\ProductManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Base\AdminBundle\BaseAdminBundleEvents;
use Base\AdminBundle\Event\ControllerPreRenderEvent;

/**
 * Class DashboardListener
 * @package Base\AdminBundle\Listener\Dashboard
 */
class DashboardListener implements EventSubscriberInterface
{
    /**
     * @var AccountManager
     */
    private $accountManager;

    /**
     * @var CategoryManager
     */
    private $categoryManager;

    /**
     * @var ProductManager
     */
    private $productManager;

    /**
     * @var BannerManager
     */
    private $bannerManager;

    /**
     * DashboardListener constructor.
     * @param AccountManager $accountManager
     * @param CategoryManager $categoryManager
     * @param ProductManager $productManager
     * @param BannerManager $bannerManager
     */
    public function __construct(
        AccountManager $accountManager,
        CategoryManager $categoryManager,
        ProductManager $productManager,
        BannerManager $bannerManager
    ) {
        $this->accountManager = $accountManager;
        $this->categoryManager = $categoryManager;
        $this->productManager = $productManager;
        $this->bannerManager = $bannerManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_DASHBOARD => 'onGetInformation',
        ];
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    public function onGetInformation(ControllerPreRenderEvent $event)
    {
        $criteria = [
            'active' => true,
            'removedRecord' => false
        ];
        $allAccount = $this->accountManager->findByNotPaging($criteria, '');
        $allCategory = $this->categoryManager->findByNotPaging($criteria, '');
        $allProduct = $this->productManager->findByNotPaging($criteria, '');
        $allBanner = $this->bannerManager->findByNotPaging($criteria, '');
        $event->setParameter('countAccount', count($allAccount));
        $event->setParameter('countCategory', count($allCategory));
        $event->setParameter('countProduct', count($allProduct));
        $event->setParameter('countBanner', count($allBanner));
    }
}