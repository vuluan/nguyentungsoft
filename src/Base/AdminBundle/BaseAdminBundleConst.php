<?php

namespace Base\AdminBundle;

/**
 * Class BaseAdminBundleConst
 * @package Base\AdminBundle
 */
/**
 * Class BaseAdminBundleConst
 * @package Base\AdminBundle
 */
class BaseAdminBundleConst
{
    const PERMISSION_MANAGE_ACCOUNT = 'manage_account';

    const PERMISSION_MANAGE_CUSTOMER = 'manage_customer';

    public static $LIST_PERMISSION = [
        self::PERMISSION_MANAGE_ACCOUNT => 'Quản lý tài khoản',
        self::PERMISSION_MANAGE_CUSTOMER => 'Quản lý khách hàng'
    ];
}
