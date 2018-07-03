<?php

namespace Base\AdminBundle\Controller\Api;

use Base\AdminBundle\BaseAdminBundleConst;
use Base\AdminBundle\Entity\Account;
use Base\AdminBundle\Manager\AccountManager;
use Base\AdminBundle\Pagination\PaginationHelper;
use Base\AdminBundle\Pagination\Paginator;
use Base\AdminBundle\Util\RequestHelper;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AccountController
 * @package Base\AdminBundle\Controller\Api
 */
class AccountController extends BaseController
{

    /**
     * @var AccountManager
     */
    private $accountManager;

    /**
     * @var PaginationHelper
     */
    private $paginationHelper;

    /**
     * AccountController constructor.
     * @param AccountManager $accountManager
     * @param PaginationHelper $paginationHelper
     */
    public function __construct(
        AccountManager $accountManager,
        PaginationHelper $paginationHelper
    ) {
        parent::__construct();
        $this->accountManager = $accountManager;
        $this->paginationHelper = $paginationHelper;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateAction(Request $request)
    {
        $form = $request->request->get('formAccount');
        if ($form['id'] === '0') {
            $account = new Account();
            if (isset($form["active"])) {
                $account->setActive($form["active"] === "on" ? true : false);
            } else {
                $account->setActive(false);
            }
            $account->setName($form["name"] ?? "");
            $account->setEmail($form["email"] ?? "");
            $account->setUsername($form["username"] ?? "");
            $account->setPassword($form["password"] ? md5($form["password"]) : "");
            $result = $this->accountManager->save($account);
        } else {
            $account = $this->accountManager->findOneById($form['id']);
            if ($account instanceof Account) {
                if (isset($form["active"])) {
                    $account->setActive($form["active"] === "on" ? true : false);
                } else {
                    $account->setActive(false);
                }
                $account->setName($form["name"] ?? "");
                $account->setEmail($form["email"] ?? "");
                $account->setUsername($form["username"] ?? "");
                $account->setPassword($form["password"] ? md5($form["password"]) : $account->getPassword());
                $result = $this->accountManager->save($account);
            } else {
                $result = false;
            }
        }

        if ($result) {
            return $this->responseWithSuccess();
        } else {
            return $this->responseWithError();
        }
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getListAccount(Request $request) {
        $page = $request->query->get('page') ?? 1;
        $itemPerPage = BaseAdminBundleConst::ACCOUNT_LIST_ITEM_PER_PAGE;
        $criteria = [
            'removedRecord' => false,
            'name' => $request->request->get('searchName'),
            'email' => $request->request->get('searchEmail'),
            'username' => $request->request->get('searchUsername'),
            'fromCreatedDate' => $request->request->get('fromCreatedDate'),
            'toCreatedDate' => $request->request->get('toCreatedDate'),
            'fromUpdateDate' => $request->request->get('fromUpdateDate'),
            'toUpdateDate' => $request->request->get('toUpdateDate'),
            'active' => $request->request->get('searchStatus') == "" ? '' : $request->request->get('searchStatus'),
        ];

        $accounts = $this->accountManager->findBy($criteria, $page, $itemPerPage, '');

        $paginationView = null;
        if ($accounts['total']) {
            $paginator = new Paginator(
                $accounts['items'],
                $accounts['total'],
                $itemPerPage,
                $page,
                []
            );
            $paginator->setPath($request->getPathInfo());
            $queries = (new RequestHelper($request))->extractQueryString([$paginator->getPageName()]);
            foreach ($queries as $query) {
                $paginator->addQuery($query['key'], $query['value']);
            }
            $paginator->setTemplate('BaseAdminBundle:Partial:pagination.html.twig');
            $paginationView = $this->paginationHelper->render($paginator);
        }

        return $this->render('BaseAdminBundle:Account:list.html.twig', [
            'accounts' => $accounts,
            'paginationView' => $paginationView
        ]);
    }
}