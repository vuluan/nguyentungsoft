<?php

namespace Base\AdminBundle\Manager;

use Base\AdminBundle\Entity\Banner;
use Base\AdminBundle\Repository\BannerRepositoryInterface;

/**
 * Class BannerManager
 * @package Base\AdminBundle\Manager
 */
class BannerManager
{
    /**
     * @var BannerRepositoryInterface
     */
    private $repository;

    /**
     * BannerManager constructor.
     * @param BannerRepositoryInterface $repository
     */
    public function __construct(BannerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Banner $banner
     *
     * @return bool
     */
    public function save(Banner $banner)
    {
        return $this->repository->save($banner);
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
     * @return Banner | null
     */
    public function findOneById(string $id)
    {
        return $this->repository->findOneById($id);
    }

    /**
     * @param array  $criteria
     * @param string $sort
     *
     * @return Banner | null
     */
    public function findOneBy(array $criteria, string $sort)
    {
        return $this->repository->findOneBy($criteria, $sort);
    }

    /**
     * @param Banner $banner
     * @return bool
     */
    public function delete(Banner $banner) {
        return $this->repository->delete($banner);
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
