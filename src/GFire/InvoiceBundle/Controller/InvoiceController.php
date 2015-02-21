<?php

namespace GFire\InvoiceBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GFire\InvoiceBundle\Entity\Invoice;
use GFire\InvoiceBundle\Form\InvoiceType;

/**
 * Invoice controller.
 *
 */
class InvoiceController extends Controller
{

    /**
     * Lists all Invoice entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('book' 		=> 'b',
                            'createdat'		=> 'i.createdAt',
                            'number'	    => 'i.invoiceNumber',
                            'duedate'	    => 'i.dueDate',
                            'status'	    => 'i.status',
                            'currency'	    => 'c.currency',
                            'total'	        => 'i.totalAmount',
                            'updatedat'		=> 'i.updatedAt');


        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $manager  =  $this->get("gfire_invoice.manager.invoice");
        $pager    =  $manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireInvoiceBundle:Invoice:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Invoices");


        return $this->render('GFireInvoiceBundle:Invoice:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));
    }
    /**
     * Creates a new Invoice entity.
     *
     */
    public function createAction(Request $request)
    {
        $manager  =  $this->get("gfire_invoice.manager.invoice");
        $particular_entry_manager  =  $this->get("gfire_invoice.manager.invoice_particular_entry");

        $entity                   = $manager->create();
      /*  $invoiceParticularEntry   = $particular_entry_manager->create();

        $entity->addInvoiceParticularEntry($invoiceParticularEntry);*/

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager->update($entity);
            $this->get('session')->getFlashBag()->set('success', '"' . $entity->getInvoiceNumber() . '" Successfully Created.');
            return $this->redirect($this->generateUrl('invoice_edit', array('id' => $entity->getId())));
        }

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Invoice",$this->generateUrl('invoice'));
        $breadcrumbs->addItem("New");

        return $this->render('GFireInvoiceBundle:Invoice:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Invoice entity.
     *
     * @param Invoice $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Invoice $entity)
    {
        $form = $this->createForm(new InvoiceType(), $entity, array(
            'action' => $this->generateUrl('invoice_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Invoice entity.
     *
     */
    public function newAction()
    {
        $manager  =  $this->get("gfire_invoice.manager.invoice");
        $particular_entry_manager  =  $this->get("gfire_invoice.manager.invoice_particular_entry");

        $entity                   = $manager->create();
        /*$invoiceParticularEntry   = $particular_entry_manager->create();

        $entity->addInvoiceParticularEntry($invoiceParticularEntry);*/
        $form   = $this->createCreateForm($entity);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Invoice",$this->generateUrl('invoice'));
        $breadcrumbs->addItem("New");

        return $this->render('GFireInvoiceBundle:Invoice:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Invoice entity.
     *
     */
    public function editAction($id)
    {
        $manager  =  $this->get("gfire_invoice.manager.invoice");

        $entity   = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invoice entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Invoice",$this->generateUrl('invoice'));
        $breadcrumbs->addItem("Edit");

        return $this->render('GFireInvoiceBundle:Invoice:edit.html.twig', array(
            'invoice'     => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Invoice entity.
    *
    * @param Invoice $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Invoice $entity)
    {
        $form = $this->createForm(new InvoiceType(), $entity, array(
            'action' => $this->generateUrl('invoice_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Invoice entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $manager  =  $this->get("gfire_invoice.manager.invoice");
        $entity   = $manager->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invoice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $manager->update($entity);

            $this->get('session')->getFlashBag()->set('success', ' Invoice "' . $entity->getInvoiceNumber() . '" Successfully Updated.');
            return $this->redirect($this->generateUrl('invoice_edit', array('id' => $id)));
        }

        return $this->render('GFireInvoiceBundle:Invoice:edit.html.twig', array(
            'invoice'     => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));

    }
    /**
     * Deletes a Invoice entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireInvoiceBundle:Invoice')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Invoice entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('invoice'));
    }

    /**
     * Creates a form to delete a Invoice entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invoice_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
