<?php

namespace Base\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('BaseAdminBundle:Dashboard:index.html.twig');
    }

    public function loginAction()
    {
        return $this->render('BaseAdminBundle:Dashboard:login.html.twig');
    }

    public function registerAction(Request $request)
    {
        if ($request->isMethod('POST')) {

        }
        return $this->render('BaseAdminBundle:Dashboard:register.html.twig');
    }
}
