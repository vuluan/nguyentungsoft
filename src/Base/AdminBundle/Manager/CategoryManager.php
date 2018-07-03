<?php

namespace Base\AdminBundle\Manager;

use Base\AdminBundle\Entity\Category;
use Base\AdminBundle\Repository\CategoryRepositoryInterface;

/**
 * Class CategoryManager
 * @package Base\AdminBundle\Manager
 */
class CategoryManager
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;

    /**
     * CategoryManager constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Category $category
     *
     * @return bool
     */
    public function save(Category $category)
    {
        return $this->repository->save($category);
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
     * @return Category | null
     */
    public function findOneById(string $id)
    {
        return $this->repository->findOneById($id);
    }

    /**
     * @param array  $criteria
     * @param string $sort
     *
     * @return Category | null
     */
    public function findOneBy(array $criteria, string $sort)
    {
        return $this->repository->findOneBy($criteria, $sort);
    }

    /**
     * @param Category $category
     * @return bool
     */
    public function delete(Category $category) {
        return $this->repository->delete($category);
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
