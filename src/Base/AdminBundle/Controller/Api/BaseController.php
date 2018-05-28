<?php

namespace Base\AdminBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;

/**
 * Class BaseController
 * @package Shopmacher\Sabu\FrontendBundle\Controller\Api
 */
class BaseController extends Controller
{
    /**
     * @var bool
     */
    protected $error;

    /**
     * @var array
     */
    protected $data;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->error = false;
        $this->data = [];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param string $description
     * @param int $code
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function responseWithError($description = '', $code = 200)
    {
        return $this->json(
            [
                'error' => true,
                'description' => $description,
                'data' => $this->data
            ],
            $code
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function responseWithSuccess()
    {
        return $this->json(
            [
                'error' => false,
                'data' => $this->data,
            ]
        );
    }

    /**
     * @param Form $form
     * @return array
     */
    public function getErrorMessages(Form $form) {
        $errors = [];

        foreach ($form->getErrors() as $key => $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }

    /**
     * @param array $errors
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function responseWithErrorForm(array $errors)
    {
        return $this->json(
            [
                'error' => true,
                'errorMessages' => $errors,
            ]
        );
    }
}