<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\BaseAdminBundleEvents;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AccountController
 * @package Base\AdminBundle\Controller
 */
class AccountController extends AbstractController
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
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_ACCOUNT;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_ACCOUNT;

        return $this->render('BaseAdminBundle:Account:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        $this->preRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_PRE_ACCOUNT_UPDATE;
        $this->postRenderEventName = BaseAdminBundleEvents::CONTROLLER_RENDER_POST_ACCOUNT_UPDATE;

        return $this->render('BaseAdminBundle:Account:update.html.twig');
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
