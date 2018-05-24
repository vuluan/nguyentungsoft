<?php

namespace Base\AdminBundle;

/**
 * Class BaseAdminBundleEvents
 *
 * @package Base\AdminBundle;
 */
final class BaseAdminBundleEvents
{
    /**
     * This event is fired on every controller before rendering is started.
     */
    const CONTROLLER_RENDER_PRE = 'base.controller_render_pre';

    /**
     * This event is fired on every controller after rendering is finished.
     */
    const CONTROLLER_RENDER_POST = 'base.controller_render_post';

    /**
     * This event is fired on every controller before rendering is started.
     */
    const CONTROLLER_RENDER_PRE_DASHBOARD = 'base.controller_render_pre_dashboard';

    /**
     * This event is fired on every controller after rendering is finished.
     */
    const CONTROLLER_RENDER_POST_DASHBOARD = 'base.controller_render_post_dashboard';

    /**
     * This event is fired on every controller before rendering is started.
     */
    const CONTROLLER_RENDER_PRE_LOGIN = 'base.controller_render_pre_login';

    /**
     * This event is fired on every controller after rendering is finished.
     */
    const CONTROLLER_RENDER_POST_LOGIN = 'base.controller_render_post_login';
}
