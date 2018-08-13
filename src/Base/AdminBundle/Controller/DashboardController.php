<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\BaseAdminBundleEvents;
/**
 * Class DashboardController
 * @package Base\AdminBundle\Controller
 */
class DashboardController extends AbstractController
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
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_DASHBOARD;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_DASHBOARD;

        return $this->render('BaseAdminBundle:Dashboard:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profileAction()
    {
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_PROFILE;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_PROFILE;

        return $this->render('BaseAdminBundle:Dashboard:profile.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function logoutAction()
    {
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_LOGOUT;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_LOGOUT;

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
