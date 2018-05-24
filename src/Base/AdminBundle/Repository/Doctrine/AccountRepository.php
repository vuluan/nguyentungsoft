<?php

namespace Base\AdminBundle\Repository\Doctrine;

use Base\AdminBundle\Entity\Account;
use Base\AdminBundle\Repository\AccountRepositoryInterface;

class AccountRepository extends Repository implements AccountRepositoryInterface
{
    public function save(Account $account)
    {
        try {
            $this->entityManager->persist($account);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function buildQueryByCriteria(array $criteria, string $sort = '')
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('c')
            ->from(Account::class, 'c');

        if (isset($criteria['enable'])) {
            $queryBuilder->andWhere('c.enable = :enable')
                ->setParameter('enable', (int)$criteria['enable']);
        }

        if (!empty($criteria['name'])) {
            $queryBuilder->andWhere('c.name like :name')
                ->setParameter('name', '%' . $criteria['name'] . '%');
        }

        // sort
        $sortField = 'createdDate';
        $sortDir = 'DESC';

        if ($sort) {
            list($sortField, $sortDir) = explode(' ', $sort);
            $sortField = in_array($sortField, ['name', 'central', 'createdDate']) ? $sortField : 'createdDate';
            $sortDir = strtoupper($sortDir) == 'DESC' ? 'DESC' : 'ASC';
        }
        $queryBuilder->orderBy('c.' . $sortField, $sortDir);
        return $queryBuilder;
    }

    public function findBy(array $criteria, int $page, int $itemPerPage, string $sort)
    {
        $queryBuilder = $this->buildQueryByCriteria($criteria, $sort);
        return $this->paginate($queryBuilder, 'c.id', $page, $itemPerPage);
    }

    public function findOneById(string $id)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('c')
            ->from(Account::class, 'c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id);
        try {
            return $queryBuilder->getQuery()->getSingleResult();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function findOneBy(array $criteria, string $sort)
    {
        $queryBuilder = $this->buildQueryByCriteria($criteria, $sort);
        try {
            return $queryBuilder->getQuery()->getSingleResult();
        } catch (\Exception $e) {
            return null;
        }
    }

    public function findByNotPaging(array $criteria, string $sort)
    {
        $queryBuilder = $this->buildQueryByCriteria($criteria, $sort);
        return $queryBuilder->getQuery()->getResult();
    }

    public function findAll()
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('c')
            ->from(Account::class, 'c');
        return $queryBuilder->getQuery()->getResult();
    }

    public function delete(Account $account)
    {
        try {
            $this->entityManager->remove($account);
            $this->entityManager->flush();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}