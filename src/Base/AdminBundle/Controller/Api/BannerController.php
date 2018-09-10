<?php

namespace Base\AdminBundle\Controller\Api;

use Base\AdminBundle\BaseAdminBundleConst;
use Base\AdminBundle\Entity\Banner;
use Base\AdminBundle\Manager\BannerManager;
use Base\AdminBundle\Pagination\PaginationHelper;
use Base\AdminBundle\Pagination\Paginator;
use Base\AdminBundle\Service\FileUploader;
use Base\AdminBundle\Util\RequestHelper;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BannerController
 * @package Base\AdminBundle\Controller\Api
 */
class BannerController extends BaseController
{

    /**
     * @var BannerManager
     */
    private $bannerManager;

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
     * @param BannerManager $bannerManager
     * @param PaginationHelper $paginationHelper
     * @param FileUploader $fileUploader
     */
    public function __construct(
        BannerManager $bannerManager,
        PaginationHelper $paginationHelper,
        FileUploader $fileUploader
    ) {
        parent::__construct();
        $this->bannerManager = $bannerManager;
        $this->paginationHelper = $paginationHelper;
        $this->fileUploader = $fileUploader;
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
        $form = $request->request->get('formBanner');
        $files = $request->files->get('formBanner');
        if ($form['id'] === '0') {
            $banner = new Banner();
            if (isset($form["active"])) {
                $banner->setActive($form["active"] === "on" ? true : false);
            } else {
                $banner->setActive(false);
            }
            $banner->setName($form["name"] ?? "");
            if (isset($files["image"])) {
                $fileName = $this->fileUploader->upload($files["image"]);
                if ($fileName !== false) {
                    $banner->setImage($fileName);
                }
            }
            $banner->setDescription($form["description"] ?? "");

            $result = $this->bannerManager->save($banner);
        } else {
            $banner = $this->bannerManager->findOneById($form['id']);
            if ($banner instanceof Banner) {
                if (isset($form["active"])) {
                    $banner->setActive($form["active"] === "on" ? true : false);
                } else {
                    $banner->setActive(false);
                }
                $banner->setName($form["name"] ?? "");
                if (isset($files["image"])) {
                    if (!is_null($banner->getImage()) && $banner->getImage() != "") {
                        $this->fileUploader->removeFile($banner->getImage());
                    }
                    $fileName = $this->fileUploader->upload($files["image"]);
                    if ($fileName !== false) {
                        $banner->setImage($fileName);
                    }
                }
                $banner->setDescription($form["description"] ?? "");
                $result = $this->bannerManager->save($banner);
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
    public function getListBanner(Request $request) {
        $page = $request->query->get('page') ?? 1;
        $itemPerPage = BaseAdminBundleConst::BANNER_LIST_ITEM_PER_PAGE;
        $criteria = [
            'removedRecord' => false,
            'name' => $request->request->get('searchName'),
            'fromCreatedDate' => $request->request->get('fromCreatedDate'),
            'toCreatedDate' => $request->request->get('toCreatedDate'),
            'fromUpdateDate' => $request->request->get('fromUpdateDate'),
            'toUpdateDate' => $request->request->get('toUpdateDate'),
            'active' => $request->request->get('searchStatus') == "" ? '' : $request->request->get('searchStatus'),
        ];

        $banners = $this->bannerManager->findBy($criteria, $page, $itemPerPage, '');

        $paginationView = null;
        if ($banners['total']) {
            $paginator = new Paginator(
                $banners['items'],
                $banners['total'],
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

        return $this->render('BaseAdminBundle:Banner:list.html.twig', [
            'banners' => $banners,
            'paginationView' => $paginationView
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function removeBanner(Request $request) {
        $id = $request->request->get('id');
        $banner = $this->bannerManager->findOneById($id);
        if ($banner instanceof Banner) {
            $this->bannerManager->delete($banner);
            return $this->responseWithSuccess();
        } else {
            return $this->responseWithError();
        }
    }
}