<?php

namespace Base\AdminBundle\Repository;

use Base\AdminBundle\Entity\Account;

/**
 * Interface AccountRepositoryInterface
 * @package Base\AdminBundle\Repository
 */
interface AccountRepositoryInterface
{
    /**
     * @param Account $account
     * @return mixed
     */
    public function save(Account $account);

    /**
     * @param array $criteria
     * @param int $page
     * @param int $itemPerPage
     * @param string $sort
     * @return mixed
     */
    public function findBy(array $criteria, int $page, int $itemPerPage, string $sort);

    /**
     * @param string $id
     * @return mixed
     */
    public function findOneById(string $id);

    /**
     * @param array $criteria
     * @param string $sort
     * @return mixed
     */
    public function findOneBy(array $criteria, string $sort);

    /**
     * @param array $criteria
     * @param string $sort
     * @return mixed
     */
    public function findByNotPaging(array $criteria, string $sort);

    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param Account $account
     * @return mixed
     */
    public function delete(Account $account);
}
