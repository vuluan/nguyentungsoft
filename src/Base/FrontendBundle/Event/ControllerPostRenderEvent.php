<?php

namespace Base\FrontendBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ControllerPostRenderEvent
 *
 * @package Base\FrontendBundle\Event
 */
class ControllerPostRenderEvent extends Event
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var string
     */
    private $view;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var Response
     */
    private $response;

    /**
     * ControllerPostRenderEvent constructor.
     *
     * @param Request $request
     * @param string $view
     * @param array $parameters
     * @param Response $response
     */
    public function __construct(Request $request, string $view, array $parameters = [], Response $response = null)
    {
        $this->request = $request;
        $this->view = $view;
        $this->parameters = $parameters;
        $this->response = $response;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Check for a parameter name
     *
     * @param string $name Parameter name
     *
     * @return bool
     */
    public function hasParameter(string $name)
    {
        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters);
    }

    /**
     * @param string $name
     * @param null|mixed $default If no value found provide this value
     *
     * @return null|mixed
     */
    public function getParameter(string $name, $default = null)
    {
        return $this->hasParameter($name) ? $this->parameters[$name] : $default;
    }
}
