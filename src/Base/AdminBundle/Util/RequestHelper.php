<?php

namespace Base\AdminBundle\Util;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestHelper
 * @package Base\AdminBundle\Util
 */
class RequestHelper
{
    /**
     * @var Request
     */
    private $request;

    /**
     * RequestHelper constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param array $excepts
     *
     * @return array
     */
    public function extractQueryString(array $excepts = [])
    {
        $queryString = $this->request->getQueryString();
        $queries = $queryString ? explode('&', $queryString) : array();
        $result = [];
        foreach ($queries as $query) {
            $query = explode('=', $query);
            if (in_array($query[0], $excepts, true)) {
                continue;
            }
            $result[] = [
                'key' => $query[0],
                'value' => isset($query[1]) ? urldecode($query[1]) : ''
            ];
        }

        return $result;
    }

    /**
     * @param string $key
     *
     * @return array
     */
    public function get(string $key)
    {
        $result = [];
        $params = $this->extractQueryString();
        foreach ($params as $param) {
            if ($param['key'] === $key) {
                $result[] = $param['value'];
            }
        }

        return $result;
    }
}
