<?php

namespace Base\FrontendBundle\Controller;

use Base\FrontendBundle\BaseFrontendBundleEvents;
use Base\FrontendBundle\Event\ControllerPostRenderEvent;
use Base\FrontendBundle\Event\ControllerPreRenderEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractController
 *
 * @package Base\FrontendBundle\Controller
 */
abstract class AbstractController extends Controller
{
    /**
     * @inheritDoc
     */
    protected function render($view, array $parameters = array(), Response $response = null)
    {
        $dispatcher = $this->container->get('event_dispatcher');
        $request = $this->container->get('request_stack')->getCurrentRequest();

        $event = new ControllerPreRenderEvent($request, $view, $parameters, $response);
        $dispatcher->dispatch(BaseFrontendBundleEvents::CONTROLLER_RENDER_PRE, $event);
        $dispatcher->dispatch($this->getPreRenderEventName(), $event);

        if (null === $response = $event->getResponse()) {
            $response = parent::render($event->getView(), $event->getParameters(), $event->getResponse());
        }

        $event = new ControllerPostRenderEvent($request, $event->getView(), $event->getParameters(), $response);
        $dispatcher->dispatch($this->getPostRenderEventName(), $event);
        $dispatcher->dispatch(BaseFrontendBundleEvents::CONTROLLER_RENDER_POST, $event);

        return $event->getResponse();
    }

    /**
     * @return string
     */
    abstract public function getPreRenderEventName();

    /**
     * @return string
     */
    abstract public function getPostRenderEventName();
}
