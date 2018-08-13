<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\BaseAdminBundleEvents;

/**
 * Class BannerController
 * @package Base\AdminBundle\Controller
 */
class BannerController extends AbstractController
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
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_BANNER;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_BANNER;

        return $this->render('BaseAdminBundle:Banner:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction()
    {
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_BANNER_UPDATE;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_BANNER_UPDATE;

        return $this->render('BaseAdminBundle:Banner:update.html.twig');
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
