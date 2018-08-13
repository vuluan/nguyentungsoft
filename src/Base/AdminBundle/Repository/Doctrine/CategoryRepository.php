<?php

namespace Base\AdminBundle\Repository\Doctrine;

use Base\AdminBundle\Entity\Category;
use Base\AdminBundle\Repository\CategoryRepositoryInterface;

/**
 * Class CategoryRepository
 * @package Base\AdminBundle\Repository\Doctrine
 */
class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    /**
     * @param Category $category
     * @return bool
     */
    public function save(Category $category)
    {
        try {
            $this->entityManager->persist($category);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param array $criteria
     * @param string $sort
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function buildQueryByCriteria(array $criteria, string $sort = '')
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('c')
            ->from(Category::class, 'c');
        if (!empty($criteria['active'])) {
            $queryBuilder->andWhere('c.active = :active')
                ->setParameter('active', $criteria['active'] == "true" ? 1 : 0);
        }

        if (isset($criteria['removedRecord'])) {
            $queryBuilder->andWhere('c.removedRecord = :removedRecord')
                ->setParameter('removedRecord', (int)$criteria['removedRecord']);
        }

        if (!empty($criteria['name'])) {
            $queryBuilder->andWhere('c.name like :name')
                ->setParameter('name', '%' . $criteria['name'] . '%');
        }

        if (isset($criteria['parentId'])) {
            $queryBuilder->andWhere('c.parentId = :parentId')
                ->setParameter('parentId', $criteria['parentId']);
        }

        if (!empty($criteria['exceptId'])) {
            $queryBuilder->andWhere('c.id != :exceptId')
                ->setParameter('exceptId', $criteria['exceptId']);
        }

        if (!empty($criteria['fromCreatedDate'])) {
            $fromCreatedDate = \DateTime::createFromFormat('d/m/Y H:i', $criteria['fromCreatedDate']." 00:00");
            $queryBuilder->andWhere('c.createdDate >= :fromCreatedDate')
                ->setParameter('fromCreatedDate', $fromCreatedDate->format('Y-m-d H:i'));
        }

        if (!empty($criteria['toCreatedDate'])) {
            $toCreatedDate = \DateTime::createFromFormat('d/m/Y H:i', $criteria['toCreatedDate']." 23:59");
            $queryBuilder->andWhere('c.createdDate <= :toCreatedDate')
                ->setParameter('toCreatedDate', $toCreatedDate->format('Y-m-d H:i'));
        }

        if (!empty($criteria['fromUpdatedDate'])) {
            $fromUpdatedDate = \DateTime::createFromFormat('d/m/Y H:i', $criteria['fromUpdatedDate']." 00:00");
            $queryBuilder->andWhere('c.updatedDate >= :fromUpdatedDate')
                ->setParameter('fromUpdatedDate', $fromUpdatedDate->format('Y-m-d H:i'));
        }

        if (!empty($criteria['toUpdatedDate'])) {
            $toUpdatedDate = \DateTime::createFromFormat('d/m/Y H:i', $criteria['toUpdatedDate']." 23:59");
            $queryBuilder->andWhere('c.updatedDate <= :toUpdatedDate')
                ->setParameter('toUpdatedDate', $toUpdatedDate->format('Y-m-d H:i'));
        }

        // sort
        $sortField = 'createdDate';
        $sortDir = 'DESC';

        if ($sort) {
            list($sortField, $sortDir) = explode(' ', $sort);
            $sortField = in_array($sortField, ['name', 'createdDate']) ? $sortField : 'createdDate';
            $sortDir = strtoupper($sortDir) == 'DESC' ? 'DESC' : 'ASC';
        }
        $queryBuilder->orderBy('c.' . $sortField, $sortDir);
        return $queryBuilder;
    }

    /**
     * @param array $criteria
     * @param int $page
     * @param int $itemPerPage
     * @param string $sort
     * @return array
     */
    public function findBy(array $criteria, int $page, int $itemPerPage, string $sort)
    {
        $queryBuilder = $this->buildQueryByCriteria($criteria, $sort);
        return $this->paginate($queryBuilder, 'c.id', $page, $itemPerPage);
    }

    /**
     * @param string $id
     * @return mixed|null
     */
    public function findOneById(string $id)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('c')
            ->from(Category::class, 'c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id);
        try {
            return $queryBuilder->getQuery()->getSingleResult();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param array $criteria
     * @param string $sort
     * @return mixed|null
     */
    public function findOneBy(array $criteria, string $sort)
    {
        $queryBuilder = $this->buildQueryByCriteria($criteria, $sort);
        try {
            return $queryBuilder->getQuery()->getSingleResult();
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param array $criteria
     * @param string $sort
     * @return array
     */
    public function findByNotPaging(array $criteria, string $sort)
    {
        $queryBuilder = $this->buildQueryByCriteria($criteria, $sort);
        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('c')
            ->from(Category::class, 'c');
        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param Category $category
     * @return bool
     */
    public function delete(Category $category)
    {
        try {
            $category->setRemovedRecord(true);
            $this->entityManager->persist($category);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}