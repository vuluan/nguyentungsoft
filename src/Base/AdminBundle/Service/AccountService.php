<?php

namespace Base\AdminBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AccountService
 * @package Base\AdminBundle\Service
 */
class AccountService
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var FileUploader $fileUploader
     */
    private $fileUploader;


    /**
     * @var PaginationService
     */
    private $paginationService;

    /**
     * AccountService constructor.
     * @param ContainerInterface $container
     * @param FileUploader $fileUploader
     * @param PaginationService $paginationService
     */
    public function __construct(ContainerInterface $container, FileUploader $fileUploader, PaginationService $paginationService)
    {
        $this->container = $container;
        $this->fileUploader = $fileUploader;
        $this->fileUploader->setTargetDir('avatar_directory');
        $this->paginationService = $paginationService;
        $this->paginationService->initPagination('BaseAdminBundle:TableAccount', 10);
    }


    public function getListAccount() {
        $request = $this->container->get('request');
        $this->paginationService->setPagination($request->get('page'));
        $pagingView = $this->paginationService->renderPagination();
        return array(
            'accounts' => $this->paginationService->getRecords(),
            'pagination' => $pagingView
        );
    }
}