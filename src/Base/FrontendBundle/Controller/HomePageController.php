<?php

namespace Base\FrontendBundle\Controller;

use Base\FrontendBundle\BaseFrontendBundleEvents;
/**
 * Class HomePageController
 * @package Base\FrontendBundle\Controller
 */
class HomePageController extends AbstractController
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
        $this->preRenderEventName = BaseFrontendBundleEvents::CONTROLLER_RENDER_PRE_HOMEPAGE;
        $this->postRenderEventName = BaseFrontendBundleEvents::CONTROLLER_RENDER_POST_HOMEPAGE;

        return $this->render('BaseFrontendBundle:HomePage:index.html.twig');
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
