<?php

namespace Base\AdminBundle\Controller\Api;

use Base\AdminBundle\Entity\Account;
use Base\AdminBundle\Manager\AccountManager;
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

    public function __construct(
        AccountManager $accountManager
    ) {
        parent::__construct();
        $this->accountManager = $accountManager;
    }

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
}