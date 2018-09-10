<?php

namespace Base\AdminBundle\Controller\Api;

use Base\AdminBundle\BaseAdminBundleConst;
use Base\AdminBundle\Entity\Category;
use Base\AdminBundle\Manager\CategoryManager;
use Base\AdminBundle\Pagination\PaginationHelper;
use Base\AdminBundle\Pagination\Paginator;
use Base\AdminBundle\Service\SlugGenerator;
use Base\AdminBundle\Util\RequestHelper;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CategoryController
 * @package Base\AdminBundle\Controller\Api
 */
class CategoryController extends BaseController
{

    /**
     * @var CategoryManager
     */
    private $categoryManager;

    /**
     * @var PaginationHelper
     */
    private $paginationHelper;

    /**
     * @var SlugGenerator
     */
    private $slugGenerator;

    /**
     * CategoryController constructor.
     * @param CategoryManager $categoryManager
     * @param PaginationHelper $paginationHelper
     * @param SlugGenerator $slugGenerator
     */
    public function __construct(
        CategoryManager $categoryManager,
        PaginationHelper $paginationHelper,
        SlugGenerator $slugGenerator
    ) {
        parent::__construct();
        $this->categoryManager = $categoryManager;
        $this->paginationHelper = $paginationHelper;
        $this->slugGenerator = $slugGenerator;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateAction(Request $request)
    {
        $form = $request->request->get('formCategory');

        $slug = $this->slugGenerator->generate($form["name"]);
        if ($this->checkSlugExist($form['id'], $slug)) {
            return $this->responseWithError('Category slug is exist in other category!');
        }

        if ($form['id'] === '0') {
            $category = new Category();
            if (isset($form["active"])) {
                $category->setActive($form["active"] === "on" ? true : false);
            } else {
                $category->setActive(false);
            }
            $category->setName($form["name"] ?? "");
            $category->setSeoTitle($form["seoTitle"] ?? "");
            $category->setSeoDescription($form["seoDescription"] ?? "");
            $category->setSeoKeyword($form["seoKeyword"] ?? "");
            $category->setSeoTitle($form["seoTitle"] ?? "");
            $category->setSlug($slug);
            $category->setParentId($form["parentId"] ?? 0);
            $result = $this->categoryManager->save($category);
        } else {
            $category = $this->categoryManager->findOneById($form['id']);
            if ($category instanceof Category) {
                if (isset($form["active"])) {
                    $category->setActive($form["active"] === "on" ? true : false);
                } else {
                    $category->setActive(false);
                }
                $category->setName($form["name"] ?? "");
                $category->setSeoTitle($form["seoTitle"] ?? "");
                $category->setSeoDescription($form["seoDescription"] ?? "");
                $category->setSeoKeyword($form["seoKeyword"] ?? "");
                $category->setSlug($slug);
                $category->setParentId($form["parentId"] ?? 0);
                $result = $this->categoryManager->save($category);
            } else {
                $result = false;
            }
        }

        if ($result) {
            return $this->responseWithSuccess();
        } else {
            return $this->responseWithError();
        }
    }

    /**
     * @param string $id
     * @param string $slug
     * @return bool
     */
    public function checkSlugExist(string $id, string $slug) {
        $criteria = [
            'slug' => $slug,
            'exceptId' => $id
        ];
        $categories = $this->categoryManager->findByNotPaging($criteria, '');
        if (count($categories) > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getListCategory(Request $request) {
        $page = $request->query->get('page') ?? 1;
        $itemPerPage = BaseAdminBundleConst::CATEGORY_LIST_ITEM_PER_PAGE;
        $criteria = [
            'removedRecord' => false,
            'name' => $request->request->get('searchName'),
            'fromCreatedDate' => $request->request->get('fromCreatedDate'),
            'toCreatedDate' => $request->request->get('toCreatedDate'),
            'fromUpdateDate' => $request->request->get('fromUpdateDate'),
            'toUpdateDate' => $request->request->get('toUpdateDate'),
            'active' => $request->request->get('searchStatus') == "" ? '' : $request->request->get('searchStatus'),
        ];

        $categories = $this->categoryManager->findBy($criteria, $page, $itemPerPage, '');

        $paginationView = null;
        if ($categories['total']) {
            $paginator = new Paginator(
                $categories['items'],
                $categories['total'],
                $itemPerPage,
                $page,
                []
            );
            $paginator->setPath($request->getPathInfo());
            $queries = (new RequestHelper($request))->extractQueryString([$paginator->getPageName()]);
            foreach ($queries as $query) {
                $paginator->addQuery($query['key'], $query['value']);
            }
            $paginator->setTemplate('BaseAdminBundle:Partial:pagination.html.twig');
            $paginationView = $this->paginationHelper->render($paginator);
        }

        return $this->render('BaseAdminBundle:Category:list.html.twig', [
            'categories' => $categories,
            'paginationView' => $paginationView
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function removeCategory(Request $request) {
        $id = $request->request->get('id');
        $category = $this->categoryManager->findOneById($id);
        if ($category instanceof Category) {
            $this->categoryManager->delete($category);
            return $this->responseWithSuccess();
        } else {
            return $this->responseWithError();
        }
    }
}