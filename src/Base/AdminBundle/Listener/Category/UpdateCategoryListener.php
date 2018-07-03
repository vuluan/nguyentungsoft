<?php

namespace Base\AdminBundle\Listener\Category;

use Base\AdminBundle\Entity\Category;
use Base\AdminBundle\Manager\CategoryManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Base\AdminBundle\BaseAdminBundleEvents;
use Base\AdminBundle\Event\ControllerPreRenderEvent;

/**
 * Class UpdateCategoryListener
 * @package Base\AdminBundle\Listener\Category
 */
class UpdateCategoryListener implements EventSubscriberInterface
{
    /**
     * @var CategoryManager
     */
    private $categoryManager;

    /**
     * UpdateAccountListener constructor.
     * @param CategoryManager $categoryManager
     */
    public function __construct(CategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_CATEGORY_UPDATE => 'onUpdateCategory',
        ];
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    public function onUpdateCategory(ControllerPreRenderEvent $event)
    {
        /** @var Category $category */
        $categoryId = $event->getRequest()->attributes->get('id');

        if ($categoryId === null) {
            return;
        }

        $criteria = [
            'removedRecord' => false,
            'active' => true,
            'parentId' => 0,
            'exceptId' => $categoryId
        ];

        $parents = $this->categoryManager->findByNotPaging($criteria, '');
        $event->setParameter('parents', $parents);

        $category = $this->categoryManager->findOneById($categoryId);
        if ($category instanceof Category) {
            $event->setParameter('category', $category);
        }
    }
}