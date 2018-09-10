<?php

namespace Base\AdminBundle\Controller\Api;

use Base\AdminBundle\BaseAdminBundleConst;
use Base\AdminBundle\Entity\Product;
use Base\AdminBundle\Manager\ProductManager;
use Base\AdminBundle\Pagination\PaginationHelper;
use Base\AdminBundle\Pagination\Paginator;
use Base\AdminBundle\Service\FileUploader;
use Base\AdminBundle\Service\SlugGenerator;
use Base\AdminBundle\Util\RequestHelper;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 * @package Base\AdminBundle\Controller\Api
 */
class ProductController extends BaseController
{

    /**
     * @var ProductManager
     */
    private $productManager;

    /**
     * @var PaginationHelper
     */
    private $paginationHelper;

    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * @var SlugGenerator
     */
    private $slugGenerator;

    /**
     * CategoryController constructor.
     * @param ProductManager $productManager
     * @param PaginationHelper $paginationHelper
     * @param FileUploader $fileUploader
     * @param SlugGenerator $slugGenerator
     */
    public function __construct(
        ProductManager $productManager,
        PaginationHelper $paginationHelper,
        FileUploader $fileUploader,
        SlugGenerator $slugGenerator
    ) {
        parent::__construct();
        $this->productManager = $productManager;
        $this->paginationHelper = $paginationHelper;
        $this->fileUploader = $fileUploader;
        $this->slugGenerator = $slugGenerator;
    }

    /**
     * @param string $fileURL
     */
    public function setFileURL(string $fileURL)
    {
        $this->fileUploader->setTargetDir($fileURL);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateAction(Request $request)
    {
        $form = $request->request->get('formProduct');
        $files = $request->files->get('formProduct');

        $slug = $this->slugGenerator->generate($form["name"]);
        if ($this->checkSlugExist($form['id'], $slug)) {
            return $this->responseWithError('Product slug is exist in other product!');
        }

        if ($form['id'] === '0') {
            $product = new Product();
            if (isset($form["active"])) {
                $product->setActive($form["active"] === "on" ? true : false);
            } else {
                $product->setActive(false);
            }
            $product->setName($form["name"] ?? "");
            $product->setSlug($slug);
            $product->setCategoryId($form["categoryId"] ?? 0);
            if (isset($files["mainImage"])) {
                $fileName = $this->fileUploader->upload($files["mainImage"]);
                if ($fileName !== false) {
                    $product->setMainImage($fileName);
                }
            }
            $product->setDescription($form["description"] ?? "");
            $product->setPrice($form["price"] ? (float)$form["price"] : 0);
            $product->setSalePrice($form["salePrice"] ? (float)$form["salePrice"] : 0);
            $product->setSeoTitle($form["seoTitle"] ?? "");
            $product->setSeoDescription($form["seoDescription"] ?? "");
            $product->setSeoKeyword($form["seoKeyword"] ?? "");
            $result = $this->productManager->save($product);
        } else {
            $product = $this->productManager->findOneById($form['id']);
            if ($product instanceof Product) {
                if (isset($form["active"])) {
                    $product->setActive($form["active"] === "on" ? true : false);
                } else {
                    $product->setActive(false);
                }
                $product->setName($form["name"] ?? "");
                $product->setSlug($slug);
                $product->setCategoryId($form["categoryId"] ?? 0);
                if (isset($files["mainImage"])) {
                    if (!is_null($product->getMainImage()) && $product->getMainImage() != "") {
                        $this->fileUploader->removeFile($product->getMainImage());
                    }
                    $fileName = $this->fileUploader->upload($files["mainImage"]);
                    if ($fileName !== false) {
                        $product->setMainImage($fileName);
                    }
                }
                $product->setDescription($form["description"] ?? "");
                $product->setPrice($form["price"] ? (float)$form["price"] : 0);
                $product->setSalePrice($form["salePrice"] ? (float)$form["salePrice"] : 0);
                $product->setSeoTitle($form["seoTitle"] ?? "");
                $product->setSeoDescription($form["seoDescription"] ?? "");
                $product->setSeoKeyword($form["seoKeyword"] ?? "");
                $result = $this->productManager->save($product);
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
        $products = $this->productManager->findByNotPaging($criteria, '');
        if (count($products) > 0) {
            return true;
        }
        return false;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getListProduct(Request $request) {
        $page = $request->query->get('page') ?? 1;
        $itemPerPage = BaseAdminBundleConst::PRODUCT_LIST_ITEM_PER_PAGE;
        $criteria = [
            'removedRecord' => false,
            'name' => $request->request->get('searchName'),
            'fromCreatedDate' => $request->request->get('fromCreatedDate'),
            'toCreatedDate' => $request->request->get('toCreatedDate'),
            'fromUpdateDate' => $request->request->get('fromUpdateDate'),
            'toUpdateDate' => $request->request->get('toUpdateDate'),
            'active' => $request->request->get('searchStatus') == "" ? '' : $request->request->get('searchStatus'),
        ];

        $products = $this->productManager->findBy($criteria, $page, $itemPerPage, '');

        $paginationView = null;
        if ($products['total']) {
            $paginator = new Paginator(
                $products['items'],
                $products['total'],
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

        return $this->render('BaseAdminBundle:Product:list.html.twig', [
            'products' => $products,
            'paginationView' => $paginationView
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function removeProduct(Request $request) {
        $id = $request->request->get('id');
        $product = $this->productManager->findOneById($id);
        if ($product instanceof Product) {
            $this->productManager->delete($product);
            return $this->responseWithSuccess();
        } else {
            return $this->responseWithError();
        }
    }
}