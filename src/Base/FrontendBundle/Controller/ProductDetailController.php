<?php

namespace Base\FrontendBundle\Controller;

use Base\FrontendBundle\BaseFrontendBundleEvents;
/**
 * Class ProductDetailController
 * @package Base\FrontendBundle\Controller
 */
class ProductDetailController extends AbstractController
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
        $this->preRenderEventName = BaseFrontendBundleEvents::CONTROLLER_RENDER_PRE_PRODUCT_DETAIL;
        $this->postRenderEventName = BaseFrontendBundleEvents::CONTROLLER_RENDER_POST_PRODUCT_DETAIL;

        return $this->render('BaseFrontendBundle:ProductDetail:index.html.twig');
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
