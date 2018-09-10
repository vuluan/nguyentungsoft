<?php

namespace Base\AdminBundle\Service;

use Base\AdminBundle\Entity\Category;
use Base\AdminBundle\Manager\CategoryManager;

/**
 * Class GetCategoryTree
 * @package Base\AdminBundle\Service
 */
class GetCategoryTree
{
    /**
     * @var CategoryManager
     */
    private $categoryManager;

    /**
     * GetCategoryTree constructor.
     * @param CategoryManager $categoryManager
     */
    public function __construct(CategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }

    /**
     * @return array
     */
    public function buildTree()
    {
        $criteria = [
            'removedRecord' => false,
            'active' => true,
        ];
        $sort = "parentId ASC";
        $allCategory = $this->categoryManager->findByNotPaging($criteria, $sort);
        $criteria['parentId'] = "0";
        $roots = $this->categoryManager->findByNotPaging($criteria, $sort);
        $categoryTree = [];
        /** @var Category $root */
        foreach ($roots as $root) {
            /** @var Category $child */
            $arrChild = [];
            foreach ($allCategory as $child) {
                if ($child->getParentId() == $root->getId()) {
                    $arrChild[] = $child;
                }
            }
            $root->setChildren($arrChild);
            $categoryTree[] = $root;
        }

        return $categoryTree;
    }
}