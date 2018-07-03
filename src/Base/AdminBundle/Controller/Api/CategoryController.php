<?php

namespace Base\AdminBundle\Controller\Api;

use Base\AdminBundle\BaseAdminBundleConst;
use Base\AdminBundle\Entity\Category;
use Base\AdminBundle\Manager\CategoryManager;
use Base\AdminBundle\Pagination\PaginationHelper;
use Base\AdminBundle\Pagination\Paginator;
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
     * CategoryController constructor.
     * @param CategoryManager $categoryManager
     * @param PaginationHelper $paginationHelper
     */
    public function __construct(
        CategoryManager $categoryManager,
        PaginationHelper $paginationHelper
    ) {
        parent::__construct();
        $this->categoryManager = $categoryManager;
        $this->paginationHelper = $paginationHelper;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateAction(Request $request)
    {
        $form = $request->request->get('formCategory');
        if ($form['id'] === '0') {
            $category = new Category();
            if (isset($form["active"])) {
                $category->setActive($form["active"] === "on" ? true : false);
            } else {
                $category->setActive(false);
            }
            $category->setName($form["name"] ?? "");
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
}