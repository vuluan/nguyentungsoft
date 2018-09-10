<?php

namespace Base\FrontendBundle\Listener;

use Base\AdminBundle\Entity\Category;
use Base\AdminBundle\Entity\Product;
use Base\AdminBundle\Manager\CategoryManager;
use Base\AdminBundle\Manager\ProductManager;
use Base\FrontendBundle\BaseFrontendBundleEvents;
use Base\FrontendBundle\Event\ControllerPreRenderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class ProductDetailListener
 * @package Base\FrontendBundle\Listener
 */
class ProductDetailListener implements EventSubscriberInterface
{
    /**
     * @var ProductManager
     */
    private $productManager;

    /**
     * @var CategoryManager
     */
    private $categoryManager;

    /**
     * HomePageListener constructor.
     * @param ProductManager $productManager
     * @param CategoryManager $categoryManager
     */
    public function __construct(
        ProductManager $productManager,
        CategoryManager $categoryManager
    ) {
        $this->productManager = $productManager;
        $this->categoryManager = $categoryManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BaseFrontendBundleEvents::CONTROLLER_RENDER_PRE_PRODUCT_DETAIL => 'onGetProductDetail'
        ];
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    public function onGetProductDetail(ControllerPreRenderEvent $event)
    {
        $productSlug = $event->getRequest()->attributes->get('slug');
        $productSlugArr = explode("-", $productSlug);
        $productId = $productSlugArr[0] ?? 0;
        /** @var Product $product */
        $product = $this->productManager->findOneById($productId);
        /** @var Category $category */
        $category = $this->categoryManager->findOneById($product->getCategoryId());
        $product->setCategory($category);

        $criteria = [
            'removedRecord' => false,
            'active' => true,
        ];
        $moreProducts = $this->productManager->findBy($criteria, 1, 3,'');

        $event->setParameter('productDetail', $product);
        $event->setParameter('moreProducts', $moreProducts);
    }
}