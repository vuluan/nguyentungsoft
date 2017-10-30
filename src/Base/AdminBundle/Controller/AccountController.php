<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\Entity\TableAccount;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Base\AdminBundle\Utils\PageUtility;

/**
 * AccountController.
 *
 */
class AccountController extends Controller
{
    /**
     * Lists all tableAccount entities.
     * @param Request $request
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $pu = new PageUtility($request, $em, 'BaseAdminBundle:TableAccount', 10, 'name');
        return $this->render('BaseAdminBundle:Account:index.html.twig',[
            'accounts' => $pu->getRecords(),
            'pager' => $pu->getDisplayParameters(),
        ]);
    }

    /**
     * @param Request $request
     */
    public function createAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $account = new TableAccount();
            $account->setName($request->request->get('name'));
            $account->setEmail($request->request->get('email'));
            $account->setPhone($request->request->get('phone'));
            $account->setUsername($request->request->get('username'));
            $account->setPassword(md5($request->request->get('password')));
            $account->setStatus($request->request->get('status') == 1 ? true : false);
            $account->setCreateDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($account);
            $em->flush();
            return $this->redirectToRoute('base_admin_account_index');
        }

        return $this->render('BaseAdminBundle:Account:create.html.twig');
    }

    /**
     * @param int $id
     * @param Request $request
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $account = $em->getRepository('BaseAdminBundle:TableAccount')->find($id);
        if ($request->isMethod('POST')) {
            $account->setName($request->request->get('name'));
            $account->setEmail($request->request->get('email'));
            $account->setPhone($request->request->get('phone'));
            $account->setUsername($request->request->get('username'));
            if (!empty($request->request->get('password'))) {
                $account->setPassword(md5($request->request->get('password')));
            }
            $account->setStatus($request->request->get('status') == 1 ? true : false);
            $em->flush();
            return $this->redirectToRoute('base_admin_account_index');
        }
        return $this->render('BaseAdminBundle:Account:edit.html.twig', array(
            'account' => $account
        ));
    }

    /**
     * @param int $id
     * @param Request $request
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $account = $em->getRepository('BaseAdminBundle:TableAccount')->find($id);
        if ($request->isMethod('POST')) {
            $account->setDelete(true);
            $em->flush();
            return $this->redirectToRoute('base_admin_account_index');
        }
        return $this->render('BaseAdminBundle:Account:delete.html.twig', array(
            'account' => $account
        ));
    }
}
