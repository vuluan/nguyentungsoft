<?php

namespace Base\AdminBundle\Pagination;

/**
 * Class BasePaginator
 * @package Base\AdminBundle\Pagination
 */
abstract class BasePaginator
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var int
     */
    protected $total;

    /**
     * @var int
     */
    protected $perPage;

    /**
     * @var int
     */
    protected $currentPage;

    /**
     * @var string
     */
    protected $pageName = 'page';

    /**
     * @var string
     */
    protected $path = '/';

    /**
     * @var array
     */
    protected $query = [];

    /**
     * @var string|null
     */
    protected $fragment;

    /**
     * @return null|string
     */
    public function previousPageUrl()
    {
        if ($this->currentPage > 1) {
            return $this->url($this->currentPage - 1);
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function nextPageUrl()
    {
        if ($this->currentPage < $this->totalPage()) {
            return $this->url($this->currentPage + 1);
        }

        return null;
    }

    /**
     * @return int
     */
    public function totalPage()
    {
        return $this->perPage > 0 ? (int)ceil($this->total / $this->perPage) : 0;
    }

    /**
     * @param int $page
     *
     * @return bool
     */
    public function isValidPageNumber(int $page)
    {
        return $page >= 1 && $page <= $this->totalPage();
    }

    /**
     * @param int $page
     *
     * @return string
     */
    public function url(int $page)
    {
        if ($page <= 0) {
            $page = 1;
        }
        $parameters = [$this->pageName => $page];
        if (count($this->query) > 0) {
            $parameters = array_merge($this->query, $parameters);
        }

        return $this->path
            . (strpos($this->path, '?') ? '&' : '?')
            . http_build_query($parameters, '', '&')
            . $this->buildFragment();
    }

    /**
     * @param null|string $fragment
     *
     * @return $this
     */
    public function fragment(string $fragment = null)
    {
        $this->fragment = $fragment;

        return $this;
    }

    /**
     * @return string
     */
    public function buildFragment()
    {
        return $this->fragment ? '#' . $this->fragment : '';
    }

    /**
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function addQuery(string $key, string $value)
    {
        $this->query[$key] = $value;

        return $this;
    }

    /**
     * @param array $queries
     *
     * @return $this
     */
    public function appendArray(array $queries)
    {
        array_walk($queries, function ($value, $key) {
            $this->addQuery($key, $value);
        });

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return $this
     */
    public function setPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return int|null
     */
    public function firstItem()
    {
        return count($this->items) ? ($this->currentPage - 1) * $this->perPage + 1 : null;
    }

    /**
     * @return int|null
     */
    public function lastItem()
    {
        return count($this->items) ? $this->firstItem() + $this->getItemsCount() - 1 : null;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @return string
     */
    public function getPageName()
    {
        return $this->pageName;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getItemsCount()
    {
        return count($this->items);
    }

    /**
     * @return string
     */
    abstract public function getTemplate();

    /**
     * @return array
     */
    abstract public function toArray();
}
