<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\BaseAdminBundleEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class LoginController
 * @package Base\AdminBundle\Controller
 */
class LoginController extends Controller
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
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_LOGIN;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_LOGIN;

        return $this->render('BaseAdminBundle:Dashboard:login.html.twig');
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
