<?php

namespace Base\FrontendBundle\Listener;

use Base\AdminBundle\Service\GetCategoryTree;
use Base\FrontendBundle\BaseFrontendBundleEvents;
use Base\FrontendBundle\Event\ControllerPreRenderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
/**
 * Class NavigationListener
 * @package Base\FrontendBundle\Listener
 */
class NavigationListener implements EventSubscriberInterface
{
    /**
     * @var GetCategoryTree
     */
    private $getCategoryTree;

    /**
     * NavigationListener constructor.
     * @param GetCategoryTree $getCategoryTree
     */
    public function __construct(GetCategoryTree $getCategoryTree)
    {
        $this->getCategoryTree = $getCategoryTree;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BaseFrontendBundleEvents::CONTROLLER_RENDER_PRE => 'onGetCategoryTree'
        ];
    }

    /**
     * @param ControllerPreRenderEvent $event
     */
    public function onGetCategoryTree(ControllerPreRenderEvent $event)
    {
        $categoryTree = $this->getCategoryTree->buildTree();
        $event->setParameter('categoryTree', $categoryTree);
    }
}