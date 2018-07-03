<?php

namespace Base\AdminBundle\Pagination;

/**
 * Class Paginator
 * @package Base\AdminBundle\Pagination
 */
class Paginator extends BasePaginator
{
    /**
     * @var string
     */
    protected $template = '';

    /**
     * Paginator constructor.
     *
     * @param array $items
     * @param int $total
     * @param int $perPage
     * @param int $currentPage
     * @param array $params
     */
    public function __construct(array $items, int $total, int $perPage, int $currentPage, array $params = [])
    {
        $this->appendArray($params);

        $this->items = $items;
        $this->total = $total;
        $this->perPage = $perPage;
        $this->currentPage = $this->isValidPageNumber($currentPage) ? $currentPage : 1;
    }

    /**
     * @param string $template
     *
     * @return $this
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @inheritDoc
     */
    public function addQuery(string $key, string $value)
    {
        $this->query[] = [
            'key' => $key,
            'value' => $value
        ];

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function url(int $page)
    {
        if ($page <= 0) {
            $page = 1;
        }
        return $this->path
            . (strpos($this->path, '?') ? '&' : '?')
            . $this->buildQuery($page)
            . $this->buildFragment();
    }

    /**
     * @param int $page
     *
     * @return string
     */
    private function buildQuery(int $page)
    {
        $combinedQueries = [];
        foreach ($this->query as $item) {
            $combinedQueries[] = $item['key'] . '=' . urlencode($item['value']);
        }

        $queryString = implode('&', $combinedQueries);
        if ($queryString === '') {
            return $this->pageName . '=' . $page;
        }

        return $queryString . '&' . $this->pageName . '=' . $page;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'total' => $this->total,
            'perPage' => $this->perPage,
            'currentPage' => $this->currentPage,
            'lastPage' => $this->totalPage(),
            'nextPageUrl' => $this->nextPageUrl(),
            'prevPageUrl' => $this->previousPageUrl(),
            'from' => $this->firstItem(),
            'to' => $this->lastItem(),
            'items' => $this->items
        ];
    }
}
