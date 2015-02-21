<?php

namespace GFire\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GFire\CoreBundle\Entity\Bank;
use GFire\CoreBundle\Form\BankType;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Bank controller.
 *
 */
class BankController extends Controller
{

    /**
     * Lists all Bank entities.
     *
     */
    public function indexAction()
    {
        $request = $this->get("request");
        $sort_fields = array('code' 		=> 'b.code',
            'createdat'		=> 'b.createdAt',
            'name' 		=> 'b.name',
            'updatedat'		=> 'b.updatedAt');


        $params                            = array();
        $default_sortfield	               = 'createdat';
        $sort_field 					   = $request->get('sort_field') == '' ? $default_sortfield : $request->get('sort_field');
        $params['sort_field']              = isset($sort_fields[$sort_field]) ?  $sort_fields[$sort_field] : $sort_field;

        if($request->get('sort')){
            $params['sort_order'] = $sort_order = $request->get('sort_order') == 'desc' ? 'asc' : 'desc';
        }else{
            $params['sort_order'] = $sort_order = $request->get('sort_order') ? $request->get('sort_order') : 'desc';
        }

        $manager  =  $this->get("gfire_core.manager.bank");
        $pager    =  $manager->findAllPager($request->get('page'),10,$params);

        if($request->isXmlHttpRequest()){

            $html =  $this->renderView('GFireCoreBundle:Bank:list.html.twig', array(
                'pager' 		    => $pager,
                'sort_field' 		=> $sort_field,
                'sort_order' 		=> $params['sort_order']
            ));

            return new JsonResponse(array('html' => $html));
        }


        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Bank");


        return $this->render('GFireCoreBundle:Bank:index.html.twig',array('pager' => $pager,'sort_field'=> $sort_field, 'sort_order' => $sort_order));

    }
    /**
     * Creates a new Bank entity.
     *
     */
    public function createAction(Request $request)
    {
        $manager  =  $this->get("gfire_core.manager.bank");
        $entity   = $manager->create();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager->update($entity);
            $this->get('session')->getFlashBag()->set('success', '"' . $entity->getName() . '" Successfully Created.');
            return $this->redirect($this->generateUrl('bank_edit', array('id' => $entity->getId())));
        }

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Bank",$this->generateUrl('bank'));
        $breadcrumbs->addItem("New");

        return $this->render('GFireCoreBundle:Bank.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Bank entity.
     *
     * @param Bank $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Bank $entity)
    {
        $form = $this->createForm(new BankType(), $entity, array(
            'action' => $this->generateUrl('bank_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Bank entity.
     *
     */
    public function newAction()
    {
        $entity = new Bank();
        $form   = $this->createCreateForm($entity);

        return $this->render('GFireCoreBundle:Bank:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing Bank entity.
     *
     */
    public function editAction($id)
    {
        $manager  =  $this->get("gfire_core.manager.book");
        $entity   = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bank entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Book",$this->generateUrl('book'));
        $breadcrumbs->addItem("Edit");

        return $this->render('GFireCoreBundle:Book:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Bank entity.
    *
    * @param Bank $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bank $entity)
    {
        $form = $this->createForm(new BankType(), $entity, array(
            'action' => $this->generateUrl('bank_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing Bank entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GFireCoreBundle:Bank')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bank entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bank_edit', array('id' => $id)));
        }

        return $this->render('GFireCoreBundle:Bank:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Bank entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GFireCoreBundle:Bank')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bank entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bank'));
    }

    /**
     * Creates a form to delete a Bank entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bank_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
