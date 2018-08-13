<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\BaseAdminBundleEvents;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 * @package Base\AdminBundle\Controller
 */
class ProductController extends AbstractController
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
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_PRODUCT;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_PRODUCT;

        return $this->render('BaseAdminBundle:Product:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction()
    {
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_PRODUCT_UPDATE;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_PRODUCT_UPDATE;

        return $this->render('BaseAdminBundle:Product:update.html.twig');
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
