<?php

namespace Base\FrontendBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ControllerPreRenderEvent
 * @package Base\FrontendBundle\Event
 */
class ControllerPreRenderEvent extends Event
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
     * ControllerPreRenderEvent constructor.
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
     * The current template name
     *
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * You can overwrite the template name
     *
     * @param string $view
     */
    public function setView(string $view)
    {
        $this->view = $view;
    }

    /**
     * Get all template variables
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
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

    /**
     * This merge all parameters, if arguments already exists, its overwritten
     *
     * @param array $parameters
     */
    public function addParameters(array $parameters)
    {
        $this->parameters = array_merge($this->parameters, $parameters);
    }

    /**
     * @param string $parameter Template variable to
     * @param mixed $value
     */
    public function setParameter(string $parameter, $value)
    {
        $this->parameters[$parameter] = $value;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Template engine can extend a response object, you can provide one here
     *
     * @param Response $response
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * The request of the current controller context
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
