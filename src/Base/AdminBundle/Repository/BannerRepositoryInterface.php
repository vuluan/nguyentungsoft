<?php

namespace Base\AdminBundle\Repository;

use Base\AdminBundle\Entity\Banner;

/**
 * Interface BannerRepositoryInterface
 * @package Base\AdminBundle\Repository
 */
interface BannerRepositoryInterface
{
    /**
     * @param Banner $banner
     * @return mixed
     */
    public function save(Banner $banner);

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
     * @param Banner $banner
     * @return mixed
     */
    public function delete(Banner $banner);
}
