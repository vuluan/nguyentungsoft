<?php

namespace Base\AdminBundle\Controller;

use Base\AdminBundle\Entity\TableAccount;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tableaccount controller.
 *
 */
class TableAccountController extends Controller
{
    /**
     * Lists all tableAccount entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tableAccounts = $em->getRepository('BaseAdminBundle:TableAccount')->findAll();

        return $this->render('tableaccount/index.html.twig', array(
            'tableAccounts' => $tableAccounts,
        ));
    }

    /**
     * Creates a new tableAccount entity.
     *
     */
    public function newAction(Request $request)
    {
        $tableAccount = new Tableaccount();
        $form = $this->createForm('Base\AdminBundle\Form\TableAccountType', $tableAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tableAccount);
            $em->flush();

            return $this->redirectToRoute('tableaccount_show', array('id' => $tableAccount->getId()));
        }

        return $this->render('tableaccount/new.html.twig', array(
            'tableAccount' => $tableAccount,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tableAccount entity.
     *
     */
    public function showAction(TableAccount $tableAccount)
    {
        $deleteForm = $this->createDeleteForm($tableAccount);

        return $this->render('tableaccount/show.html.twig', array(
            'tableAccount' => $tableAccount,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tableAccount entity.
     *
     */
    public function editAction(Request $request, TableAccount $tableAccount)
    {
        $deleteForm = $this->createDeleteForm($tableAccount);
        $editForm = $this->createForm('Base\AdminBundle\Form\TableAccountType', $tableAccount);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tableaccount_edit', array('id' => $tableAccount->getId()));
        }

        return $this->render('tableaccount/edit.html.twig', array(
            'tableAccount' => $tableAccount,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tableAccount entity.
     *
     */
    public function deleteAction(Request $request, TableAccount $tableAccount)
    {
        $form = $this->createDeleteForm($tableAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tableAccount);
            $em->flush();
        }

        return $this->redirectToRoute('tableaccount_index');
    }

    /**
     * Creates a form to delete a tableAccount entity.
     *
     * @param TableAccount $tableAccount The tableAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TableAccount $tableAccount)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tableaccount_delete', array('id' => $tableAccount->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
