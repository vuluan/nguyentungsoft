<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\BaseAdminBundleEvents;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CategoryController
 * @package Base\AdminBundle\Controller
 */
class CategoryController extends AbstractController
{
    /**
     * @var string
     */
    private $preRenderEventName;

    /**
     * @var string
     */
    private $postRenderEventName;

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_CATEGORY;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_CATEGORY;

        return $this->render('BaseAdminBundle:Category:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_CATEGORY_UPDATE;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_CATEGORY_UPDATE;

        return $this->render('BaseAdminBundle:Category:update.html.twig');
    }

    /**
     * @return string
     */
    public function getPreRenderEventName(): string
    {
        return $this->preRenderEventName;
    }

    /**
     * @return string
     */
    public function getPostRenderEventName(): string
    {
        return $this->postRenderEventName;
    }

}
