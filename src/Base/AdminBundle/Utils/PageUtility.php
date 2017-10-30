<?php
namespace Base\AdminBundle\Utils;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class PageUtility
{
    // Request
    private $request;
    // EntityManager
    private $em;
    // Entity name of the database table
    private $entityName;
    // Number of records per page
    private $pageSize;
    // Current page number
    private $currentPage;
    // Total number of pages
    private $totalPages;
    // Total records
    private $totalRecords;
    // Offset of the current page for db table
    private $offset;
    // Sort field
    private $sortField;

    public function __construct(Request $request, EntityManager $em, $entity_name = null, $page_size = 20, $default_sort_field = null) {
        $this->request = $request;
        $this->em = $em;
        $this->entityName = $entity_name;
        $this->pageSize = $page_size;
        $this->sortField = $default_sort_field;
        $this->totalRecords = $this->getTotal();
        $this->setCurrentPage();
    }

    /**
     * Get the total number of records
     */
    private function getTotal() {
        $total = $this->em->getRepository($this->entityName)
            ->createQueryBuilder('t')
            ->select('count(t.id)')
            ->getQuery()
            ->getSingleScalarResult();
        return $total;
    }

    /**
     * Set the current page and total number of pages
     */
    private function setCurrentPage() {
        $this->currentPage = $this->request->get('page');
        if(empty($this->currentPage)) {
            $this->currentPage = 1;
        }
        $this->totalPages = ceil($this->totalRecords/$this->pageSize);
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
     * Get the records for the current page
     */
    public function getRecords() {
        $records = $this->em->getRepository($this->entityName)
            ->createQueryBuilder('t')
            ->orderBy('t.' . $this->sortField, 'ASC')
            ->setFirstResult($this->offset)
            ->setMaxResults($this->pageSize)
            ->getQuery()
            ->getResult();
        return $records;
    }

    /**
     * Get the parameters for the page display
     */
    public function getDisplayParameters() {
        $return = array(
            'current_page' => $this->currentPage,
            'total_pages' => $this->totalPages,
        );
        return $return;
    }
}