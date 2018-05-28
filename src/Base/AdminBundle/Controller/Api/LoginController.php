<?php

namespace Base\AdminBundle\Controller\Api;

use Base\AdminBundle\Manager\AccountManager;
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

    public function __construct(
        AccountManager $accountManager
    ) {
        parent::__construct();
        $this->accountManager = $accountManager;
    }

    public function checkLoginAction(Request $request)
    {
        $form = $request->request->get('LoginForm');

    }
}