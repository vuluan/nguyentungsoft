<?php

namespace Base\AdminBundle\Manager;

use Base\AdminBundle\Entity\Account;
use Base\AdminBundle\Repository\AccountRepositoryInterface;

/**
 * Class AccountManager
 * @package Base\AdminBundle\Manager
 */
class AccountManager
{
    /**
     * @var AccountRepositoryInterface
     */
    private $repository;

    /**
     * AccountManager constructor.
     * @param AccountRepositoryInterface $repository
     */
    public function __construct(AccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Account $account
     *
     * @return bool
     */
    public function save(Account $account)
    {
        return $this->repository->save($account);
    }

    /**
     * @param array  $criteria
     * @param int    $page
     * @param int    $itemPerPage
     * @param string $sort
     *
     * @return array
     */
    public function findBy(array $criteria, int $page, int $itemPerPage, string $sort)
    {
        return $this->repository->findBy($criteria, $page, $itemPerPage, $sort);
    }

    /**
     * @param string $id
     *
     * @return Account | null
     */
    public function findOneById(string $id)
    {
        return $this->repository->findOneById($id);
    }

    /**
     * @param array  $criteria
     * @param string $sort
     *
     * @return Account | null
     */
    public function findOneBy(array $criteria, string $sort)
    {
        return $this->repository->findOneBy($criteria, $sort);
    }

    /**
     * @param Account $account
     * @return bool
     */
    public function delete(Account $account) {
        return $this->repository->delete($account);
    }

    /**
     * @param array  $criteria
     * @param string $sort
     *
     * @return array
     */
    public function findByNotPaging(array $criteria, string $sort) {
        return $this->repository->findByNotPaging($criteria, $sort);
    }

    /**
     * @return array
     */
    public function findAll() {
        return $this->repository->findAll();
    }
}
