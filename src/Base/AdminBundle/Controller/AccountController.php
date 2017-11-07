<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\Entity\TableAccount;
use Base\AdminBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Base\AdminBundle\Utils\PageUtility;
use Symfony\Component\HttpFoundation\Response;
use Base\AdminBundle\BaseAdminBundleConst;
/**
 * AccountController.
 *
 */
class AccountController extends Controller
{
    /**
     * @param Request $request
     * @return Response
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
     * @return Response
     */
    public function createAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $account = new TableAccount();
            $fileUploader = new FileUploader('avatar_directory');
            $account->setName($request->request->get('name'));
            $account->setEmail($request->request->get('email'));
            $file = $request->files->get('avatar');
            // check upload file
            if (!empty($file)) {
                $fileName = $fileUploader->upload($file);
                $account->setAvatar($fileName);
            }
            $account->setPermission($request->request->get('permission'));
            $account->setPhone($request->request->get('phone'));
            $account->setUsername($request->request->get('username'));
            $account->setPassword($request->request->get('password'));
            $account->setStatus($request->request->get('status') == 1 ? true : false);
            $account->setVisible(true);
            $account->setCreateDate(new \DateTime());
            $account->setUpdateDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($account);
            $em->flush();
            return $this->redirectToRoute('base_admin_account_index');
        }

        return $this->render('BaseAdminBundle:Account:create.html.twig', array(
            'listPermission' => BaseAdminBundleConst::$LIST_PERMISSION
        ));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
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
                $account->setPassword($request->request->get('password'));
            }
            $file = $request->files->get('avatar');
            if (!empty($file)) {
                $fileUploader = new FileUploader('avatar_directory');
                $fileUploader->removeFile($account->getAvatar());
                $fileName = $fileUploader->upload($file);
                $account->setAvatar($fileName);
            }
            $account->setPermission($request->request->get('permission'));
            $account->setStatus($request->request->get('status') == 1 ? true : false);
            $em->flush();
            return $this->redirectToRoute('base_admin_account_index');
        }
        return $this->render('BaseAdminBundle:Account:edit.html.twig', array(
            'account' => $account,
            'listPermission' => BaseAdminBundleConst::$LIST_PERMISSION
        ));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
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
