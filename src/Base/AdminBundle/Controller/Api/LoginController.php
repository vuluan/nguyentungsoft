<?php

namespace Base\AdminBundle\Controller\Api;

use Base\AdminBundle\Entity\Account;
use Base\AdminBundle\Manager\AccountManager;
use Base\AdminBundle\Session\ShoppingSession;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LoginController
 * @package Base\AdminBundle\Controller\Api
 */
class LoginController extends BaseController
{

    /**
     * @var AccountManager
     */
    private $accountManager;

    /**
     * @var ShoppingSession
     */
    private $shoppingSession;

    public function __construct(
        AccountManager $accountManager,
        ShoppingSession $shoppingSession
    ) {
        parent::__construct();
        $this->accountManager = $accountManager;
        $this->shoppingSession = $shoppingSession;
    }

    public function checkLoginAction(Request $request)
    {
        $form = $request->request->get('LoginForm');
        $username = $form['username'];
        $password = md5($form['password']);
        $criteria = [
            'removedRecord' => false,
            'active' => true,
            'loginUsername' => $username,
            'loginPassword' => $password
        ];
        $account = $this->accountManager->findOneBy($criteria, '');
        if ($account instanceof Account) {
            $this->shoppingSession->setAccountLogin($account);
            return $this->responseWithSuccess();
        }
        return $this->responseWithError();
    }
}