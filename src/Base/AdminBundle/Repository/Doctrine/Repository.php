<?php

namespace Base\AdminBundle\Repository\Doctrine;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Repository
 * @package Shopmacher\Sabu\AdminBundle\Repository\Doctrine
 */
class Repository
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * EventCategoryRepository constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $queryBuilder
     * @param $fieldCount
     *
     * @return mixed
     */
    public function getCountResult($queryBuilder, $fieldCount)
    {
        $countQuery = clone $queryBuilder;
        $countQuery->select('count(' . $fieldCount . ')');
        return $countQuery->getQuery()->getSingleScalarResult();
    }

    /**
     * @param $queryBuilder
     * @param $fieldCount
     * @param int $page
     * @param int $itemPerPage
     * @return array
     */
    public function paginate($queryBuilder, $fieldCount, int $page, int $itemPerPage)
    {
        $total = $this->getCountResult($queryBuilder, $fieldCount);
        $offset = ($page - 1) * $itemPerPage;
        $queryBuilder->setMaxResults($itemPerPage)->setFirstResult($offset);
        $items = $queryBuilder->getQuery()->getResult();
        return [
            'items' => $items,
            'total' => $total,
            'page' => $page,
            'itemPerPage' => $itemPerPage
        ];
    }
}