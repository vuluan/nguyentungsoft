<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\Entity\TableAccount;
use Base\AdminBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Base\AdminBundle\Utils\PageUtility;
use Symfony\Component\HttpFoundation\Response;
use Base\AdminBundle\BaseAdminBundleConst;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * AccountController.
 *
 */
class AccountController extends Controller
{
    /**
     * @var FileUploader $fileUploader
     */
    private $fileUploader;

    /**
     * AccountController constructor.
     * @param FileUploader $fileUploader
     */
    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
        $this->fileUploader->setTargetDir('avatar_directory');
    }

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
     * @param int $id
     * @return Response
     */
    public function createAction($id, Request $request)
    {
        if ($id == 0) { // create
            if ($request->isMethod('POST')) {
                $account = new TableAccount();
                $account->setName($request->request->get('name'));
                $account->setEmail($request->request->get('email'));
                $file = $request->files->get('avatar');
                // check upload file
                if (!empty($file)) {
                    $fileName = $this->fileUploader->upload($file);
                    $account->setAvatar($fileName);
                }
                $account->setPermission($request->request->get('permission'));
                $account->setPhone($request->request->get('phone'));
                $account->setIdentityCard($request->request->get('identityCard'));
                $account->setHomeTown($request->request->get('homeTown'));
                $account->setExperience($request->request->get('experience'));
                $account->setPosition($request->request->get('position'));
                $account->setPermanentResidence($request->request->get('permanentResidence'));
                $account->setDayOfBirth(new \DateTime($request->request->get('dayOfBirth')));
                $account->setStartWorkingDate(new \DateTime($request->request->get('startWorkingDate')));
                $account->setContractDuration(new \DateTime($request->request->get('contractDuration')));
                $account->setBasicSalary($request->request->get('basicSalary'));
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
                'account' => null,
                'listPermission' => BaseAdminBundleConst::$LIST_PERMISSION
            ));
        } else { // update
            $em = $this->getDoctrine()->getManager();
            $account = $em->getRepository('BaseAdminBundle:TableAccount')->find($id);
            if ($request->isMethod('POST')) {
                $account->setName($request->request->get('name'));
                $account->setEmail($request->request->get('email'));
                $file = $request->files->get('avatar');
                if (!empty($file)) {
                    $this->fileUploader->removeFile($account->getAvatar());
                    $fileName = $this->fileUploader->upload($file);
                    $account->setAvatar($fileName);
                }
                $account->setPermission($request->request->get('permission'));
                $account->setPhone($request->request->get('phone'));
                $account->setIdentityCard($request->request->get('identityCard'));
                $account->setHomeTown($request->request->get('homeTown'));
                $account->setExperience($request->request->get('experience'));
                $account->setPosition($request->request->get('position'));
                $account->setPermanentResidence($request->request->get('permanentResidence'));
                $account->setDayOfBirth(new \DateTime($request->request->get('dayOfBirth')));
                $account->setStartWorkingDate(new \DateTime($request->request->get('startWorkingDate')));
                $account->setContractDuration(new \DateTime($request->request->get('contractDuration')));
                $account->setBasicSalary($request->request->get('basicSalary'));
                $account->setUsername($request->request->get('username'));
                if (!empty($request->request->get('password'))) {
                    $account->setPassword($request->request->get('password'));
                }
                $account->setStatus($request->request->get('status') == 1 ? true : false);
                $account->setUpdateDate(new \DateTime());
                $em->flush();
                return $this->redirectToRoute('base_admin_account_index');
            }
            return $this->render('BaseAdminBundle:Account:create.html.twig', array(
                'account' => $account,
                'listPermission' => BaseAdminBundleConst::$LIST_PERMISSION
            ));
        }
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
                $this->fileUploader->removeFile($account->getAvatar());
                $fileName = $this->fileUploader->upload($file);
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
