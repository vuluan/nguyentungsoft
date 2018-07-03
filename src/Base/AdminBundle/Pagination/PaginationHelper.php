<?php

namespace Base\AdminBundle\Pagination;

use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Templating\Helper\Helper;

/**
 * Class PaginationHelper
 * @package Base\AdminBundle\Pagination
 */
class PaginationHelper extends Helper
{
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * PaginationHelper constructor.
     *
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @param BasePaginator $paginator
     * @param string $view
     *
     * @return false|string
     * @throws \RuntimeException
     */
    public function render(BasePaginator $paginator, string $view = null)
    {
        return $this->templating->render($view ?? $paginator->getTemplate(), ['paginator' => $paginator]);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'admin_pagination';
    }
}
