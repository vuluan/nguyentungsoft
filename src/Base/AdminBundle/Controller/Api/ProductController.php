<?php

namespace Base\AdminBundle\Controller\Api;

use Base\AdminBundle\BaseAdminBundleConst;
use Base\AdminBundle\Entity\Product;
use Base\AdminBundle\Manager\ProductManager;
use Base\AdminBundle\Pagination\PaginationHelper;
use Base\AdminBundle\Pagination\Paginator;
use Base\AdminBundle\Service\FileUploader;
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
     * CategoryController constructor.
     * @param ProductManager $productManager
     * @param PaginationHelper $paginationHelper
     * @param FileUploader $fileUploader
     */
    public function __construct(
        ProductManager $productManager,
        PaginationHelper $paginationHelper,
        FileUploader $fileUploader
    ) {
        parent::__construct();
        $this->productManager = $productManager;
        $this->paginationHelper = $paginationHelper;
        $this->fileUploader = $fileUploader;
        $this->fileUploader->setTargetDir('products');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateAction(Request $request)
    {
        $form = $request->request->get('formProduct');
        $files = $request->files->get('formProduct');
        if ($form['id'] === '0') {
            $product = new Product();
            if (isset($form["active"])) {
                $product->setActive($form["active"] === "on" ? true : false);
            } else {
                $product->setActive(false);
            }
            $product->setName($form["name"] ?? "");
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
                $product->setCategoryId($form["categoryId"] ?? 0);
                if (isset($files["mainImage"])) {
                    if (!is_null($product->getMainImage())) {
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
}