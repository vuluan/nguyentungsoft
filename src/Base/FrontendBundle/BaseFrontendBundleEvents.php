<?php

namespace Base\FrontendBundle;

/**
 * Class BaseFrontendBundleEvents
 *
 * @package Base\AdminBundle;
 */
final class BaseFrontendBundleEvents
{
    /**
     * This event is fired on every controller before rendering is started.
     */
    const CONTROLLER_RENDER_PRE = 'base_frontend.controller_render_pre';

    /**
     * This event is fired on every controller after rendering is finished.
     */
    const CONTROLLER_RENDER_POST = 'base_frontend.controller_render_post';

    /**
     * This event is fired on every controller before rendering is started.
     */
    const CONTROLLER_RENDER_PRE_HOMEPAGE = 'base_frontend.controller_render_pre_homepage';

    /**
     * This event is fired on every controller after rendering is finished.
     */
    const CONTROLLER_RENDER_POST_HOMEPAGE = 'base_frontend.controller_render_post_homepage';

    /**
     * This event is fired on every controller before rendering is started.
     */
    const CONTROLLER_RENDER_PRE_PRODUCT_DETAIL = 'base_frontend.controller_render_pre_product_detail';

    /**
     * This event is fired on every controller after rendering is finished.
     */
    const CONTROLLER_RENDER_POST_PRODUCT_DETAIL = 'base_frontend.controller_render_post_product_detail';
}
