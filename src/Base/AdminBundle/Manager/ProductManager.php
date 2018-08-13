<?php

namespace Base\AdminBundle\Manager;

use Base\AdminBundle\Entity\Product;
use Base\AdminBundle\Repository\ProductRepositoryInterface;

/**
 * Class ProductManager
 * @package Base\AdminBundle\Manager
 */
class ProductManager
{
    /**
     * @var ProductRepositoryInterface
     */
    private $repository;

    /**
     * ProductManager constructor.
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Product $product
     *
     * @return bool
     */
    public function save(Product $product)
    {
        return $this->repository->save($product);
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
     * @return Product | null
     */
    public function findOneById(string $id)
    {
        return $this->repository->findOneById($id);
    }

    /**
     * @param array  $criteria
     * @param string $sort
     *
     * @return Product | null
     */
    public function findOneBy(array $criteria, string $sort)
    {
        return $this->repository->findOneBy($criteria, $sort);
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function delete(Product $product) {
        return $this->repository->delete($product);
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
