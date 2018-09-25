<?php

namespace Base\FrontendBundle\Listener;

use Base\AdminBundle\Entity\Category;
use Base\AdminBundle\Manager\CategoryManager;
use Base\AdminBundle\Manager\ProductManager;
use Base\AdminBundle\Pagination\PaginationHelper;
use Base\AdminBundle\Pagination\Paginator;
use Base\FrontendBundle\BaseFrontendBundleConst;
use Base\FrontendBundle\BaseFrontendBundleEvents;
use Base\FrontendBundle\Event\ControllerPreRenderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Base\AdminBundle\Util\RequestHelper;

/**
 * Class CategoryListener
 * @package Base\FrontendBundle\Listener
 */
class CategoryListener implements EventSubscriberInterface
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
     * @var PaginationHelper
     */
    private $paginationHelper;

    /**
     * HomePageListener constructor.
     * @param ProductManager $productManager
     * @param CategoryManager $categoryManager
     * @param PaginationHelper $paginationHelper
     */
    public function __construct(
        ProductManager $productManager,
        CategoryManager $categoryManager,
        PaginationHelper $paginationHelper
    ) {
        $this->productManager = $productManager;
        $this->categoryManager = $categoryManager;
        $this->paginationHelper = $paginationHelper;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BaseFrontendBundleEvents::CONTROLLER_RENDER_PRE_CATEGORY => 'onGetCategory'
        ];
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    public function onGetCategory(ControllerPreRenderEvent $event)
    {
        $request = $event->getRequest();
        $categorySlug = $request->attributes->get('slug');
        /** @var Category $category */
        $criteria['slug'] = $categorySlug;
        $category = $this->categoryManager->findOneBy($criteria, '');

        $page = $request->query->get('page') ?? 1;
        $itemPerPage = BaseFrontendBundleConst::PRODUCT_LIST_ITEM_PER_PAGE;
        $criteria = [
            'removedRecord' => false,
            'active' => true,
            'categoryId' => $category->getId()
        ];

        $products = $this->productManager->findBy($criteria, $page, $itemPerPage, '');

        $paginationView = null;
        if ($products['total']) {
            $paginator = new Paginator(
                $products['items'],
                $products['total'],
                $itemPerPage,
                $page,
                []
            );
            $paginator->setPath($request->getPathInfo());
            $queries = (new RequestHelper($request))->extractQueryString([$paginator->getPageName()]);
            foreach ($queries as $query) {
                $paginator->addQuery($query['key'], $query['value']);
            }
            $paginator->setTemplate('BaseFrontendBundle:Widget:pagination.html.twig');
            $paginationView = $this->paginationHelper->render($paginator);
        }

        $event->setParameter('selectedCategory', $category);
        $event->setParameter('products', $products);
        $event->setParameter('paginationView', $paginationView);
    }
}