<?php

namespace Base\AdminBundle\Listener\Product;

use Base\AdminBundle\Entity\Product;
use Base\AdminBundle\Manager\CategoryManager;
use Base\AdminBundle\Manager\ProductManager;
use Base\AdminBundle\Service\GetCategoryTree;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Base\AdminBundle\BaseAdminBundleEvents;
use Base\AdminBundle\Event\ControllerPreRenderEvent;

/**
 * Class UpdateProductListener
 * @package Base\AdminBundle\Listener\Product
 */
class UpdateProductListener implements EventSubscriberInterface
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
     * @var GetCategoryTree
     */
    private $getCategoryTree;

    /**
     * UpdateProductListener constructor.
     * @param ProductManager $productManager
     * @param CategoryManager $categoryManager
     * @param GetCategoryTree $getCategoryTree
     */
    public function __construct(
        ProductManager $productManager,
        CategoryManager $categoryManager,
        GetCategoryTree $getCategoryTree
    ){
        $this->productManager = $productManager;
        $this->categoryManager = $categoryManager;
        $this->getCategoryTree = $getCategoryTree;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_PRODUCT_UPDATE => 'onUpdateProduct',
        ];
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    public function onUpdateProduct(ControllerPreRenderEvent $event)
    {
        /** @var Product $category */
        $productId = $event->getRequest()->attributes->get('id');

        if ($productId === null) {
            return;
        }

        $categories = $this->getCategoryTree->buildTree();

        $event->setParameter('categories', $categories);

        $product = $this->productManager->findOneById($productId);
        if ($product instanceof Product) {
            $event->setParameter('product', $product);
        }
    }
}