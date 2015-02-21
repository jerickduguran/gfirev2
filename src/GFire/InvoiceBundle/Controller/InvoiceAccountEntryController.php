<?php

namespace GFire\InvoiceBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GFire\InvoiceBundle\Entity\InvoiceAccountEntry;
use GFire\InvoiceBundle\Form\InvoiceAccountEntryType;

/**
 * InvoiceAccountEntry controller.
 *
 */
class InvoiceAccountEntryController extends Controller
{

    /**
     * Creates a new InvoiceAccountEntry entity.
     *
     */
    public function createAction($invoice_id, Request $request)
    {
        $manager               =  $this->get("gfire_invoice.manager.invoice_account_entry");
        $invoice_account_entry = $manager->create();

        $invoice               =  $this->getInvoice($invoice_id);
        $invoice_account_entry->setInvoice($invoice);

        $form     = $this->createCreateForm($invoice_account_entry,$invoice_id);
        $response = array('success' => false);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager->update($invoice_account_entry);
            $pager                  = $manager->findAllByInvoicePager($invoice_id,$request->get('page'));
            $response['success']    = true;
            $response['list']       = $this->renderView("GFireInvoiceBundle:InvoiceAccountEntry:Renderer/accountEntries.html.twig", array('pager'   => $pager,
                                                                                                                                          'invoice' => $invoice,
                                                                                                                                          'total'   => $invoice->getTotalAccountDebitCredit()));
        }
        $response['add_new']    = $this->renderView("GFireInvoiceBundle:InvoiceAccountEntry:Renderer/addAccountEntry.html.twig", array('form' => $form->createView()));

        return new JsonResponse($response);
    }

    /**
     * Creates a form to create a InvoiceAccountEntry entity.
     *
     * @param InvoiceAccountEntry $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(InvoiceAccountEntry $entity,$invoice_id)
    {
        $form = $this->createForm(new InvoiceAccountEntryType(), $entity, array(
            'action' => $this->generateUrl('invoice_accountentry_create',array('invoice_id' => $invoice_id)),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new InvoiceAccountEntry entity.
     *
     */
    public function newAction($invoice_id)
    {
        $response              = array();
        $response['success']   = true;

        $invoice               =  $this->getInvoice($invoice_id);
        $manager               =  $this->get("gfire_invoice.manager.invoice_account_entry");
        $invoice_account_entry = $manager->create();
        $invoice_account_entry->setInvoice($invoice);
        $invoice_account_entry->setGeneralLibrary($invoice->getGeneralLibrary());

        $form                  = $this->createCreateForm($invoice_account_entry,$invoice_id);
        $response['html']      = $this->renderView("GFireInvoiceBundle:InvoiceAccountEntry:Renderer/addAccountEntry.html.twig",array('form' => $form->createView()));

        return new JsonResponse($response);
    }

    /**
     * Displays a form to edit an existing InvoiceAccountEntry entity.
     *
     */
    public function editAction($id,$invoice_id)
    {
        $response              = array();
        $response['success']   = true;

        $manager               =  $this->get("gfire_invoice.manager.invoice_account_entry");

        $invoice_account_entry = $manager->find($id);

        if (!$invoice_account_entry) {
            throw $this->createNotFoundException('Unable to find InvoiceAccountEntry entity.');
        }

        if ($invoice_account_entry->getInvoice()->getId() != $invoice_id) {
            throw $this->createNotFoundException('Invalid Invoice.');
        }

        $form                  = $this->createEditForm($invoice_account_entry,$invoice_id);
        $response['html']      = $this->renderView("GFireInvoiceBundle:InvoiceAccountEntry:Renderer/editAccountEntry.html.twig",array('form' => $form->createView()));

        return new JsonResponse($response);

    }

    /**
    * Creates a form to edit a InvoiceAccountEntry entity.
    *
    * @param InvoiceAccountEntry $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(InvoiceAccountEntry $entity,$invoice_id)
    {
        $form = $this->createForm(new InvoiceAccountEntryType(), $entity, array(
            'action' => $this->generateUrl('invoice_accountentry_update', array('id' => $entity->getId(),'invoice_id' => $invoice_id)),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing InvoiceAccountEntry entity.
     *
     */
    public function updateAction(Request $request, $id,$invoice_id)
    {
        $manager               =  $this->get("gfire_invoice.manager.invoice_account_entry");
        $invoice_account_entry =  $manager->find($id);

        if (!$invoice_account_entry) {
            throw $this->createNotFoundException('Unable to find Invoice AccountEntry entity.');
        }

        if ($invoice_account_entry->getInvoice()->getId() != $invoice_id){
            throw $this->createNotFoundException('Invalid Invoice.');
        }

        $form     = $this->createEditForm($invoice_account_entry,$invoice_id);
        $response = array('success' => false);

        $invoice =  $this->getInvoice($invoice_id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager->update($invoice_account_entry);
            $pager                  = $manager->findAllByInvoicePager($invoice_id,$request->get('page'));
            $response['success']    = true;
            $response['list']       = $this->renderView("GFireInvoiceBundle:InvoiceAccountEntry:Renderer/accountEntries.html.twig", array('pager'   => $pager,
                                                                                                 'invoice' => $invoice,
                                                                                                 'total'   => $invoice->getTotalAccountDebitCredit()));
        }
        $response['edit_form']    = $this->renderView("GFireInvoiceBundle:InvoiceAccountEntry:Renderer/addAccountEntry.html.twig", array('form' => $form->createView()));

        return new JsonResponse($response);
    }
    /**
     * Deletes a InvoiceAccountEntry entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireInvoiceBundle:InvoiceAccountEntry')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InvoiceAccountEntry entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('invoice_accountentry'));
    }

    /**
     * Creates a form to delete a InvoiceAccountEntry entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invoice_accountentry_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    /**
     * Lists all InvoiceAccountEntry entities by Invoice.
     *
     */
    public function listAction($invoice_id)
    {
        $request          =  $this->get('request');
        $manager          =  $this->get("gfire_invoice.manager.invoice_account_entry");
        $invoice          =  $this->getInvoice($invoice_id);

        $pager            =  $manager->findAllByInvoicePager($invoice_id,$request->get('page'));

        return $this->render('GFireInvoiceBundle:InvoiceAccountEntry/Renderer:accountEntries.html.twig', array(
            'pager'   => $pager,
            'total'   => $invoice->getTotalAccountDebitCredit(),
            'invoice' => $invoice,
        ));
    }

    public function indexAction($invoice_id)
    {
        $request          =  $this->get('request');
        $manager          =  $this->get("gfire_invoice.manager.invoice_account_entry");
        $invoice          =  $this->getInvoice($invoice_id);

        $pager            =  $manager->findAllByInvoicePager($invoice_id,$request->get('page'));

        return $this->render('GFireInvoiceBundle:InvoiceAccountEntry:list.html.twig', array(
            'pager'   => $pager,
            'total'   => $invoice->getTotalAccountDebitCredit(),
            'invoice' => $invoice,
        ));
    }

    protected function getInvoice($invoice_id)
    {

        $invoice_manager  =  $this->get("gfire_invoice.manager.invoice");
        $invoice          =   $invoice_manager->findOneById($invoice_id);

        return $invoice;
    }

}
