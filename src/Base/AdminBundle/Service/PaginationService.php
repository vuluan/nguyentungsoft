<?php

namespace Base\AdminBundle\Service;
use Doctrine\ORM\EntityManager;

/**
 * Class PaginationService
 * @package Base\AdminBundle\Service
 */
class PaginationService
{

    /**
     * @var EntityManager $entityManager
     */
    private $entityManager;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @var int
     */
    private $pageSize;

    /**
     * @var int
     */
    private $currentPage;

    /**
     * @varint int
     */
    private $totalPages;

    /**
     * @var int
     */
    private $totalRecords;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * PaginationService constructor.
     * @param EntityManager $entityManager
     * @param \Twig_Environment $twig
     */
    public function __construct(EntityManager $entityManager, \Twig_Environment $twig)
    {
        $this->entityManager = $entityManager;
        $this->twig = $twig;
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * @param string $entityName
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @return mixed
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @param mixed $totalPages
     */
    public function setTotalPages($totalPages)
    {
        $this->totalPages = $totalPages;
    }

    /**
     * @return int
     */
    public function getTotalRecords()
    {
        return $this->totalRecords;
    }

    /**
     * @param int $totalRecords
     */
    public function setTotalRecords($totalRecords)
    {
        $this->totalRecords = $totalRecords;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @param $entityName
     * @param $pageSize
     */
    public function initPagination($entityName, $pageSize) {
        $this->entityName = $entityName;
        $this->pageSize = $pageSize;
        $this->totalRecords = $this->getTotal();
    }

    /**
     * @param $page
     */
    public function setPagination($page) {
        $this->currentPage = $page;
        if(empty($this->currentPage)) {
            $this->currentPage = 1;
        }
        $this->totalPages = ceil($this->totalRecords / $this->pageSize);
        if(($this->currentPage * $this->pageSize) > $this->totalRecords) {
            $this->currentPage = $this->totalPages;
        }
        // Offset for db table
        if($this->currentPage > 1) {
            $this->offset = ($this->currentPage - 1) * $this->pageSize;
        } else {
            $this->offset = 0;
        }
    }

    /**
     * Get the total number of records
     */
    private function getTotal() {
        $total = $this->entityManager->getRepository($this->entityName)
            ->createQueryBuilder('t')
            ->select('count(t.id)')
            ->where('t.visible = :visible')
            ->setParameter('visible', true)
            ->getQuery()
            ->getSingleScalarResult();
        return $total;
    }

    /**
     * Get the records for the current page
     */
    public function getRecords() {
        $records = $this->entityManager->getRepository($this->entityName)
            ->createQueryBuilder('t')
            ->where('t.visible = :visible')
            ->setParameter('visible', true)
            ->orderBy('t.id', 'DESC')
            ->setFirstResult($this->offset)
            ->setMaxResults($this->pageSize)
            ->getQuery()
            ->getResult();
        return $records;
    }

    /**
     * Get the parameters for the page display
     */
    private function getDisplayParameters() {
        $return = array(
            'current_page' => $this->currentPage,
            'total_pages' => $this->totalPages,
        );
        return $return;
    }

    /**
     * Render view paging
     */
    public function renderPagination() {
        return $this->twig->render(
            'BaseAdminBundle:Partial:admin-paging.html.twig',
            [
                'pager' => $this->getDisplayParameters()
            ]
        );
    }
}